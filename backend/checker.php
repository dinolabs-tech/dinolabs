<?php
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

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['checksubmit'])) {
  $check1 = "done";
  $check = $_POST['check'];

  // Fetch student details including the actual student ID
  $stmt = $conn->prepare("SELECT academy.id, academy.email, academy.name, academy.gender, courses.course_name, academy.duration FROM academy JOIN courses ON academy.course_id = courses.id WHERE academy.email = ?");
  $stmt->bind_param("s", $check);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows === 0) {
    echo "<script>
                alert('The Registration Number does not exist. No such Registration Number in this DATABASE');
                window.location='checkcbt.php';
              </script>";
  } else {
    $stmt->bind_result($student_id, $id, $name, $gender, $course, $duration);
    $stmt->fetch();


    // Retrieve the sum of scores for the given student ID
    $sk = mysqli_query($conn, "SELECT SUM(score) AS total_score FROM mst_result WHERE login='$student_id'");
    $appostk = mysqli_fetch_assoc($sk);


    // Check if there are results
    // Assuming this code block is executed after your score calculation:
    if ($appostk && $appostk['total_score'] !== null) {
      $score = $appostk['total_score']; // Sum of all scores from mst_result
      $score1 = $score * 4;             // Multiply the total by 4 for screening score
    } else {
      $score = 0;   // Default to 0 if no results
      $score1 = 0;  // Corresponding multiplied value
    }

    // Define the maximum possible screening score.
    // For example, if there are 25 questions each worth 4 points, the max is 100.
    $maxScreeningScore = 100;

    // Calculate the percentage. Make sure $maxScreeningScore is not zero.
    if ($maxScreeningScore > 0) {
      $percentage = ($score1 / $maxScreeningScore) * 100;
    } else {
      $percentage = 0;
    }

    // Optionally, round the result to a desired number of decimals.
    $percentage = round($percentage, 2);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo htmlspecialchars($name); ?></title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .identity-header img {
      max-height: 110px;
    }

    .identity-photo img {
      max-height: 110px;
    }
  </style>
  <style>
    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>

<body class="bg-light">
  <div class="container my-5">


    <!-- Second table (kept unchanged) -->
    <table border="0" width="100%">
      <tr>
        <td width="100">
          <img style="border-radius: 10px;" class="img-fluid" src="../img/logo.png" alt="Logo" />
        </td>
        <td valign="top" style="padding:10px; font-size:14px; text-align:center">
          <b style="font-size:17px">DINOLABS TECH SERVICES</b><br>
          <span>5th Floor Wing-B TISCO Building Alagbaka, Akure, Ondo State, Nigeria.</span><br>
          <span>enquiries@dinolabstech.com</span><br>
          <span>+234 704 324 7461</span>
          <span style="font-size:15px;">(Computer Based Test)</span><br />
          <b style="font-family:'Times New Roman', Times, serif;">Result Slip</b><br />
          Course Name: <b><?php echo $course; ?></b> | Course Duration: <?php echo $duration; ?>
        </td>
        <td width="100">

        </td>
      </tr>
    </table>
    <hr />

    <!-- Name Details -->
    <div class="row my-3">
      <div class="col-md-12">
        <div style="text-align: center"><strong>
            <h3><?php echo $name; ?></h3>
          </strong> </div>
      </div>
    </div>

    <!-- Student Registration Details -->
    <div class="row my-3">
      <div class="col-md-4">
        <div><strong>ID:</strong> <?php echo $id; ?></div>
      </div>
      <div class="col-md-4">
        <div><strong>Course:</strong> <?php echo $course; ?></div>
      </div>
      <div class="col-md-4">
        <div><strong>Duration:</strong> <?php echo $duration; ?></div>
      </div>

    </div>



    <!-- Subjects and Scores -->
    <div class="row my-3">
      <div class="col-12">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>COURSE</th>
              <th>SCORES</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Retrieve and loop through all courses scores from mst_result
            $sql = mysqli_query($conn, "SELECT mst_result.*, courses.course_name FROM mst_result JOIN courses ON courses.id = mst_result.course WHERE mst_result.login='$student_id'");
            while ($appost = mysqli_fetch_assoc($sql)) {
              $course = $appost['course_name'];
              $individual_score = $appost['score'];
              echo "<tr>";
              echo "<td>$course</td>";
              echo "<td>$individual_score</td>";
              echo "</tr>";
            }
            ?>
            <tr class="table-secondary">
              <td><strong>TOTAL</strong></td>
              <td><strong><?php echo $score; ?></strong></td>
            </tr>
             <tr class="table-info">
              <td><strong>PERCENTAGE</strong></td>
              <td><strong><?php echo $percentage; ?>%</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>


    <hr />

    <!-- Action Buttons -->
    <div class="row my-3">
      <div class="col-md-6">
        <a href="javascript:window.print()" class="btn btn-primary no-print">Print Result</a>
      </div>
      <div class="col-md-6 text-end">
        <a href="checkcbt.php" class="btn btn-danger no-print">Close Window</a>
      </div>
    </div>
  </div>

  <!-- Latest Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
