<?php

require_once '../db_connect.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// ADD QUESTION ==============================
// Process new question form submission
$insert_message = "";
if (isset($_POST['add_question'])) {
    // Debugging: Log the raw POST data
    error_log("POST Data: " . print_r($_POST, true));

    // Escape and retrieve input values
    $que_desc  = $conn->real_escape_string($_POST['que_desc']);
    $ans1      = $conn->real_escape_string($_POST['ans1']);
    $ans2      = $conn->real_escape_string($_POST['ans2']);
    $ans3      = $conn->real_escape_string($_POST['ans3']);
    $ans4      = $conn->real_escape_string($_POST['ans4']);
    $true_ans  = $conn->real_escape_string($_POST['true_ans']);
    $course     = $conn->real_escape_string($_POST['class']);

    // Convert true answer from letter to number (A=1, B=2, C=3, D=4)
    $true_ans_num = 0;
    switch (strtoupper($true_ans)) {
        case 'A':
            $true_ans_num = 1;
            break;
        case 'B':
            $true_ans_num = 2;
            break;
        case 'C':
            $true_ans_num = 3;
            break;
        case 'D':
            $true_ans_num = 4;
            break;
        default:
            $true_ans_num = 1;
            break;
    }

    // Insert the new question into the database
    $insert_query = "INSERT INTO question 
                    (que_desc, ans1, ans2, ans3, ans4, true_ans, course)
                    VALUES ('$que_desc', '$ans1', '$ans2', '$ans3', '$ans4', '$true_ans_num', '$course')";

    if ($conn->query($insert_query) === TRUE) {
        $insert_message = "Question added successfully!";
    } else {
        $insert_message = "Error adding question: " . $conn->error;
        error_log("SQL Error: " . $conn->error); // Log SQL errors
    }
}

// Retrieve classes, arms, subjects, term, and session (unchanged)
$classes = [];
$result = $conn->query("SELECT * FROM courses");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row;
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>

<!-- Load TinyMCE CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include('components/sidebar.php'); ?>
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
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Add Question</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">CBT</li>
                                <li class="breadcrumb-item active">Add Question</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Enter New Question</div>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="mb-4 mt-2">
                                        <?php
                                        if (!empty($insert_message)) {
                                            echo '<div class="alert alert-info">' . htmlspecialchars($insert_message) . '</div>';
                                        }
                                        ?>
                                        <form method="POST" action="" class="row g-3">
                                            <div class="mb-3">
                                                <label for="que_desc" class="form-label">Question</label>
                                                <textarea class="form-control" name="que_desc" id="que_desc" rows="3" required></textarea>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label for="ans1" class="form-label">Option A</label>
                                                <textarea class="form-control" name="ans1" id="ans1" required></textarea>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label for="ans2" class="form-label">Option B</label>
                                                <textarea class="form-control" name="ans2" id="ans2" required></textarea>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label for="ans3" class="form-label">Option C</label>
                                                <textarea class="form-control" name="ans3" id="ans3" required></textarea>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label for="ans4" class="form-label">Option D</label>
                                                <textarea class="form-control" name="ans4" id="ans4" required></textarea>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="true_ans" class="form-label"><small>Correct Answer (Enter A, B, C, or D)</small></label>
                                                <select class="form-select" name="true_ans" id="true_ans" required>
                                                    <option value="" selected disabled>Select Correct Answer</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <select class="form-select mt-4" name="class" id="class" required>
                                                    <option value="" selected disabled>Select Course</option>
                                                    <?php foreach ($classes as $cls): ?>
                                                        <option value="<?php echo htmlspecialchars($cls['id']); ?>">
                                                            <?php echo htmlspecialchars($cls['course_name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>



                                            <div class="d-grid gap-2">
                                                <input type="submit" name="add_question" class="btn btn-success" value="Add Question">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('components/footer.php'); ?>
        </div>
    </div>
    <?php include('components/scripts.php'); ?>

    <!-- TinyMCE Initialization -->
    <script>
        tinymce.init({
            selector: '#que_desc, #ans1, #ans2, #ans3, #ans4',
            menubar: false,
            toolbar: 'undo redo | formatselect | bold italic underline superscript subscript | alignleft aligncenter alignright | bullist numlist outdent indent | table | tableprops tablecellprops tableinsertrowbefore tableinsertrowafter tabledeleterow tableinsertcolbefore tableinsertcolafter tabledeletecol',
            plugins: 'lists table',
            branding: false,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        document.querySelector('form').addEventListener('submit', function() {
            tinymce.triggerSave();
            // Debugging: Log TinyMCE content
            console.log("Question: ", tinymce.get('que_desc').getContent());
            console.log("Answer 1: ", tinymce.get('ans1').getContent());
            console.log("Answer 2: ", tinymce.get('ans2').getContent());
            console.log("Answer 3: ", tinymce.get('ans3').getContent());
            console.log("Answer 4: ", tinymce.get('ans4').getContent());
        });
    </script>


</body>

</html>