<?php

include "functions.php";
include "helpers/csrf_token.php";

global $db_conn;

$franchise_id = $_SESSION['id'];
$franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

if (isset($_POST['test_request_form'])) {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $selected_test = $_POST['selected_tests'];
    $dispatch_option = $_POST['dispatchOption'];
    $sample_drawn_date = $_POST['drawnDate'];
    $sample_drawn_time = $_POST['drawnTime'];
    $fasting_status = $_POST['fastingStatus'];
    $reference_doctor = $_POST['referenceDoctor'];

    $attachments = $_FILES['file']['name'];
    $temp_file = $_FILES['file']['tmp_name'];
    move_uploaded_file($temp_file, "src/images/test_form_images/$attachments");

    $testRequestForm = "INSERT INTO test_requests (franchise_id, name, age, gender, mobile, city, selected_test, dispatch_option, sample_drawn_date, sample_drawn_time, fasting_status, reference_doctor, attachments, created_at) 
                        VALUES ('$franchise_id', '$name', '$age', '$gender', '$mobile', '$city', '$selected_test', '$dispatch_option', '$sample_drawn_date', '$sample_drawn_time', '$fasting_status', '$reference_doctor', '$attachments')";

    $query = query($testRequestForm);
    confirm($query);

    if (confirm($query)) {
        echo "Your request has been submitted and is pending for approval";
    } else {
        echo "There was an error submitting your request. Please try again.";
    }
}
