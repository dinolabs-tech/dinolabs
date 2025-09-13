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


// Query all students
$sql_students = "SELECT academy.*, courses.course_name FROM academy JOIN courses ON academy.course_id = courses.id";
$result_students = $conn->query($sql_students);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Results for All Students</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .identity-header img {
      max-height: 110px;
    }

    .identity-photo img {
      max-height: 110px;
    }

    @media print {
      .no-print {
        display: none;
      }
    }

    .result-slip {
      page-break-after: always;
    }
  </style>
</head>

<body class="bg-light">
  <div class="container my-4">
    <?php
    if ($result_students->num_rows > 0) {
      while ($student = $result_students->fetch_assoc()) {
        $student_id = $student['id'];
        $id    = $student['email'];
        $name  = $student['name'];
        $gender = $student['gender'];
        $course   = $student['course_name'];
        $duration = $student['duration'];

        // Calculate the total score for this student from mst_result
        $sql_score = "SELECT SUM(score) AS total_score FROM mst_result WHERE login = '$student_id'";
        $result_score = $conn->query($sql_score);
        $row_score = $result_score->fetch_assoc();
        $score = ($row_score && $row_score['total_score'] !== null) ? $row_score['total_score'] : 0;

        // Example: multiply total score by 4 (if required by your screening logic)
        $score1 = $score;

        // Define the maximum screening score. Adjust this value as needed.
        $maxScreeningScore = 60;
        $percentage = ($maxScreeningScore > 0) ? round(($score1 / $maxScreeningScore) * 100, 2) : 0;
    ?>
        <!-- Begin Result Slip -->
        <div class="result-slip my-5 p-3 border">
          <table border="0" width="100%">
            <tr>
              <td width="100">
                <img style="border-radius: 10px;" class="img-fluid" src="../img/logo.png" alt="Logo" />
              </td>
              <td valign="top" style="padding:10px; font-size:14px; text-align:center">
                <b style="font-size:17px">DINOLABS TECH SERVICES</b><br>
                <span>5th Floor Wing-B TISCO Building Alagbaka, Akure, Ondo State, Nigeria.</span><br>
                <span>enquiries@dinolabstech.com</span><br>
                <span>+234 704 324 7461</span><br>
                <span style="font-size:15px;">(Computer Based Test)</span><br />
                <b style="font-family:'Times New Roman', Times, serif;">Result Slip</b><br />
                <!-- Course: <b><?php echo htmlspecialchars($course); ?></b> | Gender: <?php echo htmlspecialchars($gender); ?> -->
                Course Name: <b><?php echo $course; ?></b> | Course Duration: <?php echo $duration; ?>
              </td>
              <td width="100"></td>
            </tr>
          </table>
          <hr />
          <!-- Student Details -->
          <div class="row my-3">
            <div class="col-md-12">
              <div style="text-align: center">
                <strong>
                  <h3><?php echo htmlspecialchars($name); ?></h3>
                </strong>
              </div>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-md-4"><strong>ID.:</strong> <?php echo htmlspecialchars($id); ?></div>
            <div class="col-md-4"><strong>GENDER:</strong> <?php echo htmlspecialchars($gender); ?></div>
            <div class="col-md-4"><strong>COURSE:</strong> <?php echo htmlspecialchars($course); ?></div>
          </div>
          <!-- Subjects and Scores -->
          <div class="row my-3">
            <div class="col-12">
              <table class="table table-bordered">
                <thead class="table-light">
                  <tr>
                    <th>SUBJECTS</th>
                    <th>SCORES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Retrieve subject scores for this student
                  $sql_subjects = "SELECT mst_result.*, courses.course_name FROM mst_result JOIN courses ON courses.id = mst_result.course WHERE mst_result.login='$student_id'";
                  $result_subjects = $conn->query($sql_subjects);
                  if ($result_subjects->num_rows > 0) {
                    while ($subject = $result_subjects->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($subject['course_name']) . "</td>";
                      echo "<td>" . htmlspecialchars($subject['score']) . "</td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='2'>No scores available</td></tr>";
                  }
                  ?>
                  <tr class="table-secondary">
                    <td><strong>TOTAL</strong></td>
                    <td><strong><?php echo htmlspecialchars($score); ?></strong></td>
                  </tr>
                  <!-- Optionally, if you want to display the screening percentage: -->
                  <tr class="table-info">
                    <td><strong>PERCENTAGE</strong></td>
                    <td><strong><?php echo $percentage; ?>%</strong></td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
          <!-- Print Button (will hide on printing) -->
          <div class="row my-3">
            <div class="col-md-6">
              <button onclick="window.print()" class="btn btn-primary no-print">Print Result</button>
            </div>
          </div>
        </div>
        <!-- End Result Slip -->
    <?php
      }
    } else {
      echo "<p>No students found.</p>";
    }
    ?>
  </div>
  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
