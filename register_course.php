<?php
include 'db_connect.php';


// Flutterwave payment success redirect handler
if (isset($_GET['status']) && $_GET['status'] == 'paid' && isset($_GET['form_data'])) {
    $decoded = json_decode(base64_decode($_GET['form_data']), true);

    if ($decoded) {
        extract($decoded);

        $course_id = $_GET["id"];

        $image_path = ''; // You may enhance this by storing the image before payment

        // Check if email exists
        $check_stmt = $conn->prepare("SELECT id FROM academy WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $sql = "UPDATE academy SET 
                        name=?, gender=?, mobile=?, state=?, city=?, address=?, course_id=?, duration=?, year_enrolled=?, 
                        qualification=?, computer_literacy=?, nkin_name=?, nkin_mobile=?, nkin_email=?, 
                        spn_name=?, spn_mobile=?, spn_email=?, password=? WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssisssssssssss", 
                $name, $gender, $mobile, $state, $city, $address, $course_id, $duration, $year_enrolled, 
                $qualification, $literacy, $kin_name, $kin_mobile, $kin_email, 
                $sponsor_name, $sponsor_mobile, $sponsor_email, $password, $email
            );
        } else {
            $stmt = $conn->prepare("INSERT INTO academy 
                (name, gender, email, mobile, state, city, address, course_id, duration, year_enrolled, 
                qualification, computer_literacy, nkin_name, nkin_mobile, nkin_email, 
                spn_name, spn_mobile, spn_email, image_path, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssissssssssssss", 
                $name, $gender, $email, $mobile, $state, $city, $address, $course_id, $duration, $year_enrolled, 
                $qualification, $literacy, $kin_name, $kin_mobile, $kin_email, 
                $sponsor_name, $sponsor_mobile, $sponsor_email, $image_path, $password
            );
        }

        if ($stmt->execute()) {
            echo "<script>alert('Payment successful and data saved.'); window.location.href = 'academy.php';</script>";
        } else {
            echo "Error saving data: " . $stmt->error;
        }

        $stmt->close();
        $check_stmt->close();
        exit();
    }
}

$course_id = $_GET["id"] ?? "";
if ($course_id == "") {
    header("Location: academy.php");
    exit();
}

$sql = "SELECT * FROM courses WHERE id = $course_id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "Course not found";
    exit();
}
$course = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Registration form</title>
    <?php include('components/head.php'); ?>
</head>

<body>
<?php include('components/topbar.php'); ?>
<?php include('components/navbar.php'); ?>

<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
    <div class="row py-5">
        <div class="col-12 pt-lg-5 mt-lg-5 text-center">
            <h1 class="display-4 text-white animated zoomIn"><?php echo $course['course_name']; ?></h1>
        </div>
    </div>
</div>

<div class="container-fluid py-1 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-1">
        <form id="registrationForm" enctype="multipart/form-data">
            <div class="row g-3">
                                 <div class="col-md-6">
                        <input type="text" name="name" class="form-control" style="border-radius: 10px;" placeholder="Name (Surname First)" required>
                    </div>

                    <div class="col-md-2">
                        <select style="border-radius: 10px;" name="gender" id="" class="form-control form-select" required>
                            <option value="" selected disabled>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <input style="border-radius: 10px;" type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-2">
                        <input style="border-radius: 10px;" type="text" name="mobile" class="form-control" placeholder="Mobile" required>
                    </div>
                    <div class="col-md-2">
                        <input style="border-radius: 10px;" type="text" name="state" class="form-control" placeholder="State of residence" required>
                    </div>
                    <div class="col-md-2">
                        <input style="border-radius: 10px;" type="text" name="city" class="form-control" placeholder="City" required>
                    </div>
                    <div class="col-md-6">
                        <input style="border-radius: 10px;" type="text" name="address" class="form-control" placeholder="Home Address" required>
                    </div>


                    <b><span>Course Selection</span></b>
                    <div class="col-md-2">
                        <Label for="course">Preferred Course</Label>
                        <input style="border-radius: 10px;" type="text" name="course" readonly id="course" value="<?= $course['course_name'] ?>" class="form-control" placeholder="Course" required>
                    </div>

                    <div class="col-md-2">
                        <small><i>Price</i></small>
                        <input style="border-radius: 10px;" type="text" name="price" readonly id="price" value="<?= $course['price'] ?>" class="form-control" placeholder="Price" required>
                    </div>

                    <div class="col-md-2">
                        <small><i>Duration</i></small>
                        <input style="border-radius: 10px;" type="text" name="duration" readonly id="duration" value="<?= $course['duration'] ?>" class="form-control" placeholder="Duration" required>
                    </div>

                    <div class="col-md-2">
                        <small><i>Year Enrolled</i></small>
                        <input style="border-radius: 10px;" type="text" name="year_enrolled" readonly id="year_enrolled" value="<?= date('Y') ?>" class="form-control" placeholder="Year Enrolled" required>
                    </div>
                    <div class="col-md-2">
                        <i><small>Preferred Password</small></i>
                        <input style="border-radius: 10px;" type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <b><span>Educational Information <small><i>(Please select where appropriate)</i></small></span></b>

                    <div class="col-md-4">
                        <select style="border-radius: 10px;" name="qualification" id="" class="form-control form-select" required>
                            <option value="" disabled selected>Highest Qualification Obtained</option>
                            <option value="Senior School Certificate">Senior School Certificate</option>
                            <option value="National Diploma">National Diploma</option>
                            <option value="Higher National Diploma">Higher National Diploma</option>
                            <option value="Bachelor`s Degree">Bachelor`s Degree</option>
                            <option value="Masters Degree">Master's Degree</option>
                            <option value="Doctorate">Doctorate</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select style="border-radius: 10px;" name="literacy" id="" class="form-control form-select">
                            <option value="" disabled selected>Computer Literacy</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Basic">Basic</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>

                    <b><Label> Next of Kin Information</Label></b>
                    <div class="col-md-4">
                        <input style="border-radius: 10px;" type="text" name="kin_name" class="form-control" placeholder="Next of Kin Name" required>
                    </div>
                    <div class="col-md-4">
                        <input style="border-radius: 10px;" type="text" name="kin_mobile" class="form-control" placeholder="Next of Kin Mobile" required>
                    </div>
                    <div class="col-md-4">
                        <input style="border-radius: 10px;" type="email" name="kin_email" class="form-control" placeholder="Next of Kin Email" required>
                    </div>

                    <b><label for="">Sponsor Informaion</label><i><small> - Sponsor Information must be completed (if self sponsored, input personal details)</small></i></b>
                    <div class="col-md-4">
                        <input style="border-radius: 10px;" type="text" name="sponsor_name" class="form-control" placeholder="Sponsor Name" required>
                    </div>
                    <div class="col-md-4">
                        <input style="border-radius: 10px;" type="text" name="sponsor_mobile" class="form-control" placeholder="Sponsor Mobile" required>
                    </div>
                    <div class="col-md-4">
                        <input style="border-radius: 10px;" type="email" name="sponsor_email" class="form-control" placeholder="Sponsor Email" required>
                    </div>
                    <b><label for="passport" class="d-none"> Upload Passport</label></b>
                    <div class="col-md-4 d-none">
                        <input type="file" name="passport">
                    </div>

                <input type="hidden" id="form_data_json" name="form_data_json">
                <div class="col-md-2">
                    <button class="btn btn-primary w-100 py-2 px-3 mt-5" id="registerBtn" style="border-radius: 10px;">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('components/footer.php'); ?>
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>
<?php include('components/scripts.php'); ?>

<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
document.getElementById('registerBtn').addEventListener('click', function(event) {
    event.preventDefault();

    const form = document.getElementById('registrationForm');
    const formData = new FormData(form);
    const jsonData = {};

    formData.forEach((value, key) => {
        jsonData[key] = value;
    });

    document.getElementById('form_data_json').value = JSON.stringify(jsonData);

    const txRef = "ACADEMY_" + Date.now();

    FlutterwaveCheckout({
        public_key: "FLWPUBK-3b4554a666b54d38f291bad092ec7e1b-X", // replace with your key
        tx_ref: txRef,
        amount: parseFloat(jsonData.price),
        currency: "NGN",
        customer: {
            email: jsonData.email,
            phone_number: jsonData.mobile,
            name: jsonData.name
        },
        customizations: {
            title: "Course Registration",
            description: jsonData.course,
            logo: "https://dinolabstech.com/img/logo.png"
        },
        callback: function (response) {
            if (response.status === "successful") {
                const url = new URL(window.location.href);
                url.searchParams.set("tx_ref", txRef);
                url.searchParams.set("status", "paid");
                url.searchParams.set("form_data", btoa(JSON.stringify(jsonData)));
                window.location.href = url.toString();
            } else {
                alert("Payment failed or was cancelled.");
            }
        },
        onclose: function () {
            // Optional: alert or re-enable UI
        }
    });
});
</script>

</body>
</html>
