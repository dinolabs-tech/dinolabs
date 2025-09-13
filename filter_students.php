<?php
/**
 * filter_students.php
 *
 * This file provides an administrative interface to filter and display student records
 * based on their class and arm (e.g., A, B, C). It fetches available classes and arms
 * from the database to populate dropdowns. Upon form submission, it queries the database
 * for students matching the selected criteria and displays them in a table.
 * The page includes various components for layout and functionality, such as admin_logic,
 * head, adminnav, logo_header, navbar, footer, and scripts.
 */

// Include the admin_logic component, which likely handles session management,
// user authentication, and database connection setup for the admin panel.
include('components/admin_logic.php');

// Initialize empty arrays to store fetched classes and arms.
$classes = [];
$arms = [];

// --- Fetch Classes and Arms from Database ---
// Use a try-catch block to handle potential database query errors gracefully.
try {
    // SQL query to select all unique class names from the 'class' table.
    $class_result = $conn->query("SELECT class FROM class");
    // Check if the query executed successfully.
    if ($class_result) {
        // Loop through each row of the result set and add the class name to the $classes array.
        while ($row = $class_result->fetch_assoc()) {
            $classes[] = $row['class'];
        }
    } else {
        // If the query failed, throw an exception with a detailed error message.
        throw new Exception("Error fetching classes: " . $conn->error);
    }

    // SQL query to select all unique arm names from the 'arm' table.
    $arm_result = $conn->query("SELECT arm FROM arm");
    // Check if the query executed successfully.
    if ($arm_result) {
        // Loop through each row of the result set and add the arm name to the $arms array.
        while ($row = $arm_result->fetch_assoc()) {
            $arms[] = $row['arm'];
        }
    } else {
        // If the query failed, throw an exception with a detailed error message.
        throw new Exception("Error fetching arms: " . $conn->error);
    }
} catch (Exception $e) {
    // Catch any exceptions thrown during database operations and terminate the script
    // with a user-friendly error message.
    die("Database query failed: " . $e->getMessage());
}

// Initialize an empty array to store student search results.
$students = [];

// --- Handle Form Submission for Filtering Students ---
// Check if the current request method is POST, indicating a form submission.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // --- Input Validation and Sanitization ---
    // The commented-out lines below show how to sanitize input for a web portal
    // using filter_input, which is a more secure method.
    //$selected_class = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_STRING);
    //$selected_arm = filter_input(INPUT_POST, 'arm', FILTER_SANITIZE_STRING);

    // For offline use or simpler setups, direct access to $_POST is used.
    // Use the null coalescing operator (??) to provide an empty string default if the POST variable is not set.
    $selected_class = $_POST['class'] ?? '';
    $selected_arm = $_POST['arm'] ?? '';

    // Check if both class and arm were selected.
    if ($selected_class && $selected_arm) {
        try {
            // Prepare a SQL statement to fetch student details based on the selected class and arm.
            // Using prepared statements helps prevent SQL injection.
            $stmt = $conn->prepare("SELECT id, name, class, arm FROM students WHERE class = ? AND arm = ?");
            // Check if the statement was successfully prepared.
            if ($stmt) {
                // Bind the parameters (selected class and arm) to the prepared statement.
                // "ss" indicates that both parameters are strings.
                $stmt->bind_param("ss", $selected_class, $selected_arm);
                // Execute the prepared statement.
                $stmt->execute();

                // Bind the result columns to PHP variables.
                $stmt->bind_result($id, $name, $class, $arm);
                // Fetch results row by row and store them in the $students array.
                while ($stmt->fetch()) {
                    $students[] = [
                        'id' => $id,
                        'name' => $name,
                        'class' => $class,
                        'arm' => $arm,
                    ];
                }
                // Close the prepared statement.
                $stmt->close();
            } else {
                // If statement preparation failed, throw an exception.
                throw new Exception("Error preparing statement: " . $conn->error);
            }
        } catch (Exception $e) {
            // Catch any exceptions during query execution and terminate the script.
            die("Query failed: " . $e->getMessage());
        }
    } else {
        // If either class or arm was not selected, display a message to the user.
        echo "<p>Please select both Class and Arm.</p>";
    }
}

// Close the main database connection.
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<?php
// Include the head component, which likely contains meta tags, stylesheets, and other head-related elements.
include('head.php'); ?>

<body>
    <!-- Main Wrapper for the Admin Panel -->
    <div class="wrapper">
        <!-- Sidebar Component -->
        <!-- This section includes the sidebar navigation menu for the admin panel. -->
        <?php include('adminnav.php'); ?>
        <!-- End Sidebar -->

        <!-- Main Panel (Content Area) -->
        <div class="main-panel">
            <!-- Main Header (Top Bar) -->
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header Component -->
                    <?php include('logo_header.php'); ?>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header Component -->
                <?php include('navbar.php'); ?>
                <!-- End Navbar -->
            </div>

            <!-- Main Container for Page Content -->
            <div class="container">
                <div class="page-inner">
                    <!-- Page Header and Breadcrumbs -->
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Filter Students</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Students</li>
                                <li class="breadcrumb-item active">Filter Students</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Filter Students Card Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Filter Students Registered</div>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="mb-4 mt-2">
                                        <!-- Form for filtering students by class and arm. -->
                                        <form method="post">
                                            <!-- Dropdown for selecting a class. -->
                                            <select name="class" id="class" class="form-control form-select mb-3" required>
                                                <option value="" disabled selected>-- Select Class --</option>
                                                <?php
                                                // Populate class options from the $classes array.
                                                foreach ($classes as $class): ?>
                                                    <option value="<?= htmlspecialchars($class, ENT_QUOTES) ?>">
                                                        <?= htmlspecialchars($class, ENT_QUOTES) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>

                                            <!-- Dropdown for selecting an arm. -->
                                            <select name="arm" id="arm" class="form-control form-select mb-3" required>
                                                <option value="" disabled selected>-- Select Arm --</option>
                                                <?php
                                                // Populate arm options from the $arms array.
                                                foreach ($arms as $arm): ?>
                                                    <option value="<?= htmlspecialchars($arm, ENT_QUOTES) ?>">
                                                        <?= htmlspecialchars($arm, ENT_QUOTES) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>

                                            <!-- Submit button for the filter form. -->
                                            <div class="text-start mt-3">
                                                <button type="submit" class="btn btn-success">
                                                    <span class="btn-label">
                                                        <i class="fa fa-filter"></i>
                                                    </span>
                                                    Filter
                                                </button>
                                            </div>
                                        </form>

                                        <p></p>

                                        <?php
                                        // Display student records in a table if any students were found.
                                        if (!empty($students)): ?>
                                            <div class="table-responsive">
                                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Class</th>
                                                            <th>Arm</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Loop through each student and display their details in a table row.
                                                        foreach ($students as $student): ?>
                                                            <tr>
                                                                <td><?= htmlspecialchars($student['id'], ENT_QUOTES) ?></td>
                                                                <td><?= htmlspecialchars($student['name'], ENT_QUOTES) ?></td>
                                                                <td><?= htmlspecialchars($student['class'], ENT_QUOTES) ?></td>
                                                                <td><?= htmlspecialchars($student['arm'], ENT_QUOTES) ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php else: ?>
                                            <!-- Message displayed if no student records are found after filtering. -->
                                            <p>No records found.</p>
                                        <?php endif; ?>

                                        <!-- Student Profile Modal (Hidden by default, activated by JavaScript) -->
                                        <!-- This modal is designed to display a detailed profile card for a selected student. -->
                                        <div class="modal fade" id="studentModal" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Student Profile Card</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <img id="studentImage" src="" alt="Student Image" class="profile-img">
                                                            <h4 id="studentName"></h4>
                                                        </div>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td><strong>ID:</strong></td>
                                                                <td id="studentId"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Gender:</strong></td>
                                                                <td id="studentGender"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Date of Birth:</strong></td>
                                                                <td id="studentDob"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Place of Birth:</strong></td>
                                                                <td id="studentPlaceOb"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Religion:</strong></td>
                                                                <td id="studentReligion"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>State:</strong></td>
                                                                <td id="studentState"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>LGA:</strong></td>
                                                                <td id="studentLga"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Class:</strong></td>
                                                                <td id="studentClass"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Arm:</strong></td>
                                                                <td id="studentArm"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Hostel:</strong></td>
                                                                <td id="studentHostel"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Blood Type:</strong></td>
                                                                <td id="studentBloodType"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Blood Group:</strong></td>
                                                                <td id="studentBloodGroup"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Height:</strong></td>
                                                                <td id="studentHeight"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Weight:</strong></td>
                                                                <td id="studentWeight"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Guardian Name:</strong></td>
                                                                <td id="studentGname"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Guardian Occupation:</strong></td>
                                                                <td id="studentGoccupation"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="200px"><strong>Guardian Mobile:</strong></td>
                                                                <td id="studentMobile"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"><strong>Address:</strong> <span
                                                                        id="studentAddress"></span></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Component -->
            <?php include('footer.php'); ?>
        </div>

        <!-- Custom Color Template Component -->
        <!-- This component likely allows for customization of the admin panel's color scheme. -->
        <?php include('cust-color.php'); ?>
        <!-- End Custom template -->
    </div>
    <?php
    // Include the scripts component, which likely contains JavaScript files for interactivity.
    include('scripts.php'); ?>
</body>

</html>
