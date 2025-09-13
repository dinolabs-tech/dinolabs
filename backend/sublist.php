<?php 
// Start the session and enable error reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Database connection
require_once '../db_connect.php';



$loginid = $_SESSION['user_id']; // Get the student ID
$course = $_SESSION['course']; // Get the student class


// Check if the candidate has been authorized for any questions
$stmt1 = $conn->prepare("SELECT * FROM question WHERE course = ?");
$stmt1->bind_param("s", $course);
$stmt1->execute();
$stmt1->store_result(); // Store the result set

if ($stmt1->num_rows == 0) {
    echo '<script type="text/javascript">
    alert("You have not been authorized for any questions yet. Kindly wait for your time");
    window.location="student_dashboard.php";
    </script>';
    exit();
}

$stmt1->close();

// Fetch the scheduled test date for this student’s class and arm from the cbtadmin table
$stmt_date = $conn->prepare("SELECT testdate FROM cbtadmin WHERE course = ? LIMIT 1");
$stmt_date->bind_param("s", $course);
$stmt_date->execute();
$stmt_date->bind_result($testdate);
$stmt_date->fetch();
$stmt_date->close();

?>

<!DOCTYPE html>
<html lang="en">
 <?php include('components/head.php'); ?>
  <title>Take Exam</title>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <?php include('components/sidebar.php');?>
      <!-- End Sidebar -->

      <div class="main-panel">
         <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <?php include('components/logo_header.php'); ?>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <?php include('components/navbar.php'); ?>
        <!-- End Navbar -->
      </div>

        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Take Exam</h3>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="students.php">Home</a></li>
                  <li class="breadcrumb-item active">CBT</li>
                  <li class="breadcrumb-item active">Take Exam</li>
              </ol>
              </div>
           
            </div>

         
              
          
            <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="card-title"> Select Your Course </h4>   
                  </div>
                  <div class="card-body">
                      <div class="list-group">
                          <?php
                          $query = "SELECT q.course, c.course_name FROM question q JOIN courses c ON q.course = c.id where q.course = $course GROUP BY q.course, c.course_name";
                          $result = $conn->query($query);
                          $today = date("Y-m-d");

                          while ($row = $result->fetch_assoc()) {
                              $course_id = $row['course'];
                              $course_name = $row['course_name'];

                              // Check if the student has already taken this subject
                              $stmt_check = $conn->prepare("SELECT * FROM mst_result WHERE login = ? AND course = ?");
                              $stmt_check->bind_param("ss", $loginid, $course);
                              $stmt_check->execute();
                              $stmt_check->store_result();
                              $already_taken = $stmt_check->num_rows > 0;
                              $stmt_check->close();

                              if ($already_taken) {
                                  // If the subject has been taken, create a disabled link with an alert
                                  echo "<a href='#' class='list-group-item list-group-item-action fs-5 text-muted' 
                                        onclick=\"alert('You have already taken the " . htmlspecialchars($course_name) . " exam.'); return false;\">" 
                                      . htmlspecialchars($course_name) . " (Already Taken)</a>";
                              } elseif ($testdate < $today) {
                                  // If the test date has passed, show a missed test notification
                                  echo "<a href='#' class='list-group-item list-group-item-action fs-5 text-muted' 
                                        onclick=\"alert('Sorry, you missed your test date on " . htmlspecialchars((string)$testdate) . "'); return false;\">" 
                                      . htmlspecialchars($course_name) . " (Missed Test Date)</a>";
                              } elseif ($testdate > $today) {
                                  // If the scheduled test date is in the future, show notification with the test date
                                  echo "<a href='#' class='list-group-item list-group-item-action fs-5 text-muted' 
                                        onclick=\"alert('Sorry, you do not have a test scheduled for today. Please come back on " . htmlspecialchars((string)$testdate) . "'); return false;\">" 
                                      . htmlspecialchars($course_name) . " (Test Not Today)</a>";
                              } else {
                                  // If test is scheduled for today and exam not yet taken, allow navigation to quiz.php
                                  echo "<a href='quiz.php?subid=" . urlencode($course_id) . "' class='list-group-item list-group-item-action fs-5'>" 
                                      . htmlspecialchars($course_name) . "</a>";
                              }
                          }
                          ?>
                      </div>
                  </div>
              </div>
          </div>

        </div>
     
        <?php include('components/footer.php');?>
      </div>

   
    </div>
   <?php include('components/scripts.php');?>
  </body>
</html>
