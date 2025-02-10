<?php

include "db.php";
include "helpers/csrf_token.php";

// This file contains all the functions that are required to perform CRUD operations on the database

/*********************************************** HELPER FUNCTIONS *************************************/

// function setMessage() is used to set messages
function setMessage($msg)
{
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

// function displayMessage() is used to display the messages from setMessage function
function displayMessage()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

// function redirect() is used to redirect the pages
function redirect($location)
{
    header("Location: $location");
}

// function query($sql) used to execute the query
function query($sql)
{
    global $db_conn;
    return mysqli_query($db_conn, $sql);
}

// function confirm() is used to check if the query failed while execution
function confirm($result)
{
    global $db_conn;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($db_conn));
    }
}

// function escape_string() is used to escape the string
function escape_string($string)
{
    global $db_conn;
    return mysqli_real_escape_string($db_conn, $string);
}

// function fetch_array() is used to fetch the array
function fetch_array($result)
{
    return mysqli_fetch_array($result);
}

// function IsLoggedIn() is used to check if the user is logged in or not
function IsLoggedIn()
{
    if (isset($_SESSION['username'])) {
        return true;
    } else {
        return false;
    }
}

// function get_user_name() is used to get the username from the session
function get_user_name()
{
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    }
}

// function get_user_id() is used to get the user id from the session
function get_user_id()
{
    if (isset($_SESSION['id'])) {
        return $_SESSION['id'];
    }
}

/**************************************** END OF HELPER FUNCTIONS ****************************************/
// 
// 
// 
// 
/*************************************** REGISTER/LOGIN FUNCTIONS ****************************************/

// function registerUser() is used to register the user
function registerUser()
{

    if (isset($_POST['register'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $usertype = $_POST['usertype'];

        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));


        $registerQuery = "INSERT INTO users(username, email, city, state, usertype, password) ";
        $registerQuery .= "VALUES('{$username}', '{$email}', '{$city}', '{$state}', '{$usertype}' , '{$hashed_password}') ";
        $query = query($registerQuery);
        confirm($query);

        redirect("login");
        setMessage("User Registered!");
    }
}

// function loginUser() is a login function 
function loginUser()
{
    global $db_conn;

    if (isset($_POST['login_form'])) {
        // CSRF token validation
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            setMessage("Invalid CSRF token.");
            redirect("login");
            exit();
        }

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $email = mysqli_real_escape_string($db_conn, $email);
        $password = mysqli_real_escape_string($db_conn, $password);

        $loginQuery = "SELECT * FROM franchises WHERE email = '$email' ";
        $query = query($loginQuery);
        confirm($query);

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {
                $db_userid = $row['id'];
                $db_email = $row['email'];
                $dbpassword = $row['password'];

                if (password_verify($password, $dbpassword)) {
                    $_SESSION['id'] = $db_userid;
                    $_SESSION['email'] = $db_email;
                    $_SESSION['agency_name'] = $row['agency_name'];
                    setMessage("Valid credentials. You are now logged in.");
                    redirect("index");
                    exit();
                } else {
                    setMessage("Invalid credentials. Please try again.");
                    redirect("login");
                    exit();
                }
            }
        } else {
            setMessage("Invalid credentials. Please try again.");
            redirect("login");
            exit();
        }
    }
}

/************************************ END OF REGISTER/LOGIN FUNCTIONS ************************************/
// 
// 
// 
// 
/************************************** FRANCHISE MODULE FUNCTIONS ***************************************/

// function TestRequestForm() is used to submit the test request form
function TestRequestForm()
{

    global $db_conn;

    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    if (isset($_GET['lab_name'])) {
        $lab_name = $_GET['lab_name'];
    } else {
        $lab_name = "Unknown Lab";
    }

    if (isset($_POST['test_request'])) {

        $franchise_name = $_POST['lab_name'];
        $patient_name = $_POST['name'];
        $patient_age = $_POST['age'];
        $patient_gender = $_POST['gender'];
        $patient_mobile = $_POST['mobile'];
        $patient_city = $_POST['city'];

        // Get the selected tests from POST (you already passed it from URL)
        $selectedTests = $_POST['selectedTests'];

        $patient_dispatch_option = $_POST['dispatchOption'];
        $patient_sample_drawn_date = $_POST['drawnDate'];
        $patient_sample_drawn_time = $_POST['drawnTime'];
        $patient_fasting_status = $_POST['fastingStatus'];
        $patient_reference_doctor = $_POST['referenceDoctor'];

        $image = $_FILES['file']['name'];
        $temp_image = $_FILES['file']['tmp_name'];
        move_uploaded_file($temp_image, "src/images/test_form_images/$image");

        // order amount is calculated based on the selected tests
        // $order_amount = $_POST['orderAmount'];

        if ($patient_age <= 0) {
            echo "Invalid age. Please enter a possitive value.";
            exit();
        }

        $testRequestQuery = "INSERT INTO test_requests (franchise_id, franchise_name, patient_name, age, gender, mobile, city, ";
        $testRequestQuery .= "selected_test, dispatch_option, sample_drawn_date, sample_drawn_time, fasting_status, reference_doctor, ";
        $testRequestQuery .= "attachments, created_at) ";
        $testRequestQuery .= "VALUES ('$franchise_id', '$franchise_name', '$patient_name', '$patient_age', '$patient_gender', ";
        $testRequestQuery .= "'$patient_mobile', '$patient_city', '$selectedTests', '$patient_dispatch_option', '$patient_sample_drawn_date', ";
        $testRequestQuery .= "'$patient_sample_drawn_time', '$patient_fasting_status', '$patient_reference_doctor', '$image', NOW())";

        $query = query($testRequestQuery);
        confirm($query);

        echo "Your request has been submitted successfully!";

        redirect("allbookings");
        exit();
    }
}

// function recentBookings() is used to fetch the recent bookings
function recentBookings()
{
    global $db_conn;

    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    $recentBookingsQuery = "SELECT * FROM test_requests WHERE franchise_id = $franchise_id ORDER BY created_at DESC LIMIT 5";
    $query = query($recentBookingsQuery);
    confirm($query);

    while ($row = mysqli_fetch_array($query)) {

        $sr_no = $row['id'];
        $patient_name = $row['patient_name'];
        $patient_gender = $row['gender'];
        $patient_age = $row['age'];
        $selected_tests = $row['selected_test'];
        $lab_name = $row['franchise_name'];
        $patient_dispatch_option = $row['dispatch_option'];
        $order_amount = $row['order_amount'];

        // date formatting
        $created_at = $row['created_at'];
        $originalDate = $created_at;
        $date = new DateTime($originalDate);
        $formattedDate = $date->format('jS F Y, h:i A');

        echo "<tr>";
        echo "<td><input type='checkbox'></td>";
        echo "<td>{$sr_no}</td>";
        echo "<td>{$patient_name}</td>";
        echo "<td>{$patient_gender}</td>";
        echo "<td>{$patient_age}</td>";
        echo "<td>{$lab_name}</td>";
        echo "<td>{$patient_dispatch_option}</td>";
        echo "<td>{$order_amount}</td>";
        echo "<td>{$selected_tests}</td>";
        echo "<td>{$formattedDate}</td>";
        echo "<td><a href='invoice?sr_no=$sr_no&patient_name=$patient_name' target='_blank'>View Invoice</a></td>";
        echo "<tr>";
    }

    return null;
}

// function fetchWalletBalance() is used to fetch balance of the franchise's wallet
function fetchWalletBalance()
{
    global $db_conn;

    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    $walletBalanceQuery = "SELECT SUM(amount) AS total_amount FROM recharge_requests WHERE status = 'Approved' AND franchise_id = $franchise_id ";
    $query = query($walletBalanceQuery);
    confirm($query);

    $result = mysqli_fetch_assoc($query);
    if ($result) {
        echo $result['total_amount'];
    }

    return null;
}

// function rechargeRequests() is used to submit the franchise's request for wallet recharge 
function rechargeRequests()
{
    global $db_conn;

    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    $upi_reference_id = $_SESSION['id'];
    $upi_reference_id = mysqli_real_escape_string($db_conn, $upi_reference_id);

    if (isset($_POST['wallet_request'])) {

        $amount = $_POST['amount'];
        $upi_reference_id = $_POST['upi_reference'];

        $image = $_FILES['file']['name'];
        $temp_image = $_FILES['file']['tmp_name'];
        move_uploaded_file($temp_image, "src/images/received_images/$image");

        if ($amount <= 0) {
            echo "Invalid amount. Please enter a possitive value.";
            exit();
        }

        $rechargeWalletQuery = "INSERT INTO recharge_requests (franchise_id, amount, upi_reference, attachments, created_at) ";
        $rechargeWalletQuery .= "VALUES ('$franchise_id', '$amount', '$upi_reference_id', '$image', NOW()) ";
        $query = query($rechargeWalletQuery);
        confirm($query);

        // if (confirm($query)) {
        //     echo "Your request has been submitted and is pending for approval";
        // } else {
        //     echo "There was an error submitting your request. Please try again.";
        // }
    }
}

// function totalFranchiseBooking() is used to fetch the total number of bookings
function totalFranchiseBooking()
{

    global $db_conn;

    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    $totalFranchiseBookingQuery = "SELECT COUNT(*) AS total_bookings FROM test_requests WHERE franchise_id = $franchise_id";
    $query = query($totalFranchiseBookingQuery);
    confirm($query);

    $result = mysqli_fetch_assoc($query);
    if ($result) {
        echo $result['total_bookings'];
    }

    return null;
}

// function fetchTestCode used to fetch test details like code, B2C price
// function fetchTestCode($test)
// {
//     $fetchTestDetails = "SELECT * FROM test_details WHERE test_name = '$test' ";
//     $query = query($fetchTestDetails);
//     confirm($query);

//     while ($row = mysqli_fetch_array($query)) {

//         $code = $row['code'];
//         $lab_name = $row['lab_name'];
//         $test_price = $row['B2C'];
//     }
// }

/********************************** END OF FRANCHISE MODULE FUNCTIONS ************************************/
// 
// 
// 
// 
/**************************************** ADMIN MODULE FUNCTIONS *****************************************/

// function viewAllLabs() is used to view all the labs
function viewAllLabs()
{
    // global $db_conn;
    // $franchise_id = $_SESSION['id'];
    // $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    $viewAllLabsQuery = "SELECT * FROM labs";
    $query = query($viewAllLabsQuery);
    confirm($query);

    while ($row = mysqli_fetch_array($query)) {

        $lab_id = $row['id'];
        $lab_name = $row['lab_name'];
        $lab_logo = $row['lab_logo'];

        echo "<tr>";
        echo "<td>{$lab_name}</td>";
        echo "<td><img src='../src/images/$lab_logo' alt='Lab Logo' style='width: 50px; height: 50px;'></td>";
        echo "<td>
                <a class='edit-button' href='lab_update?update=$lab_id'>Edit</a>
                <a class='delete-button' href='#' onclick='confirmDelete($lab_id)'>Delete</a>
            </td>";
        echo "</tr>";
    }
}

// function addLabs() is used to add new labs
function addLabs()
{
    global $db_conn;
    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    if (isset($_POST['addLabs'])) {

        $lab_name = $_POST['labName'];
        $lab_logo = $_FILES['labLogo']['name'];
        $temp_image = $_FILES['labLogo']['tmp_name'];
        move_uploaded_file($temp_image, "src/images/add_lab_images/$lab_logo");

        $addLabsQuery = "INSERT INTO labs (franchise_id, lab_name, lab_logo, created_at) ";
        $addLabsQuery .= "VALUES ('$franchise_id', '$lab_name', '$lab_logo', NOW())";
        $query = query($addLabsQuery);
        confirm($query);

        setMessage("New Lab added!");
        redirect("manageLab");
    }
}

// function readLabData() is used to read particular lab details like name, logo.
function readLabData($lab_id)
{

    $readLabDataQuery = "SELECT * FROM labs WHERE id = '$lab_id'";
    $query = query($readLabDataQuery);
    confirm($query);

    if ($row = mysqli_fetch_assoc($query)) {

        return [
            'id' => $row['id'],
            'lab_name' => $row['lab_name'],
            'lab_logo' => $row['lab_logo'],
        ];
    } else {
        setMessage("No lab found!");
    }
}

// function updateTestPrice() is used to update test details like name, price etc.
function updateLabDetails($lab_id)
{
    if (isset($_POST['updateLab'])) {

        $lab_name_updated = $_POST['labName_updated'];
        $lab_logo_updated = $_FILES['labLogo_updated']['name'];
        $lab_logo_updated_image = $_FILES['labLogo_updated']['tmp_name'];
        move_uploaded_file($lab_logo_updated_image, "src/images/add_lab_images/$lab_logo_updated");

        $updateLabDetailsQuery = "UPDATE labs SET lab_name = '{$lab_name_updated}', lab_logo = '{$lab_logo_updated}' ";
        $updateLabDetailsQuery .= "WHERE id = '{$lab_id}' ";
        $query = query($updateLabDetailsQuery);
        confirm($query);

        setMessage("Lab details updated!");
        redirect("manageLab");
    }
}

// function readAllTestPrice() is used to read all test details like name, price etc.
function readAllTestPrice()
{
    // global $db_conn;

    // $franchise_id = $_SESSION['id'];
    // $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    $readAllTestPriceQuery = "SELECT * FROM test_details";
    $query = query($readAllTestPriceQuery);
    confirm($query);

    while ($row = mysqli_fetch_array($query)) {

        $test_id = $row['id'];
        $name = $row['test_name'];
        $B2B = $row['B2B'];
        $B2C = $row['B2C'];

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$B2B}</td>";
        echo "<td>{$B2C}</td>";
        echo "<td>
                <a class='edit-button' href='test_update?update=$test_id'>Edit</a>
                <a class='delete-button' href='#' onclick='confirmDelete($test_id)'>Delete</a>
            </td>";
        echo "</tr>";
    }
}

// function addTestPrice() is used to add test names, prices.
function addTestPrice()
{
    global $db_conn;

    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    if (isset($_POST['addTestPrice'])) {

        $name = $_POST['test_name'];
        $B2B = $_POST['B2B'];
        $B2C = $_POST['B2C'];

        $addTestPrice = "INSERT INTO test_details (franchise_id, test_name, B2B, B2C, created_at) ";
        $addTestPrice .= "VALUES ('$franchise_id', '$name', '$B2B', '$B2C', NOW())";
        $query = query($addTestPrice);
        confirm($query);

        setMessage("New Test added!");
        redirect("test");
    }
}

// function readTestPrice() is used to read particular test details like name, price etc.
function readTestPrice($test_id)
{
    // global $db_conn;
    // $franchise_id = $_SESSION['id'];
    // $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    $readAllTestPriceQuery = "SELECT * FROM test_details WHERE id = '$test_id'";
    $query = query($readAllTestPriceQuery);
    confirm($query);

    if ($row = mysqli_fetch_assoc($query)) {

        return [
            'id' => $row['id'],
            'test_name' => $row['test_name'],
            'B2B' => $row['B2B'],
            'B2C' => $row['B2C']
        ];
    } else {
        setMessage("No test found!");
    }
}

// function updateTestPrice() is used to update test details like name, price etc.
function updateTestPrice($test_id)
{
    global $db_conn;
    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    if (isset($_POST['updateTestPrice'])) {

        $name = $_POST['name_updated'];
        $B2B = $_POST['B2B_updated'];
        $B2C = $_POST['B2C_updated'];

        $updateTestDetailsQuery = "UPDATE test_details SET test_name = '{$name}', B2B = '{$B2B}', B2C = '{$B2C}' ";
        $updateTestDetailsQuery .= "WHERE id = '{$test_id}' AND franchise_id = '{$franchise_id}' ";
        $query = query($updateTestDetailsQuery);
        confirm($query);

        setMessage("Test details updated!");
        redirect("test");
    }
}

// function addFranchise() is used to add new franchise
function addFranchise()
{
    global $db_conn;
    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    if (isset($_POST['addFranchise'])) {

        $owner_name = $_POST['owner_name'];
        $agency_name = $_POST['agency_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $pin_code = $_POST['pin_code'];
        $package = $_POST['package'];

        $aadhaar_number = $_POST['aadhaar_number'];
        // $aadhaar_upload = $_POST['aadhaar_upload'];
        $aadhaar_upload = $_FILES['aadhaar_upload']['name'];
        $aadhaar_temp_image = $_FILES['aadhaar_upload']['tmp_name'];
        move_uploaded_file($aadhaar_temp_image, "src/images/add_franchise_images/$aadhaar_upload");

        $pan_number = $_POST['pan_number'];
        // $pan_upload = $_POST['pan_upload'];
        $pan_upload = $_FILES['pan_upload']['name'];
        $pan_temp_image = $_FILES['pan_upload']['tmp_name'];
        move_uploaded_file($pan_temp_image, "src/images/test_form_images/$pan_upload");

        // $owner_image_upload = $_POST['owner_image_upload'];
        $owner_image = $_FILES['owner_image']['name'];
        $owner_image_temp = $_FILES['owner_image']['tmp_name'];
        move_uploaded_file($owner_image_temp, "src/images/test_form_images/$owner_image");

        // $owner_signature_upload = $_POST['owner_signature_upload'];
        $owner_signature = $_FILES['owner_signature']['name'];
        $owner_signature_temp = $_FILES['owner_signature']['tmp_name'];
        move_uploaded_file($owner_signature_temp, "src/images/test_form_images/$owner_signature");

        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

        // Check if the email already exists in the database
        $emailCheckQuery = "SELECT * FROM franchises WHERE email = '$email'";
        $emailCheckResult = mysqli_query($db_conn, $emailCheckQuery);

        if (mysqli_num_rows($emailCheckResult) > 0) {
            setMessage("The email address '$email' is already taken. Please choose a different one.");
            redirect("addfranchise");
            exit();
        }

        $addFranchiseQuery = "INSERT INTO franchises(owner_name, agency_name, email, phone, address, pin_code, package, ";
        $addFranchiseQuery .= "aadhaar_number, aadhaar_image, pan_number, pan_image, owner_image, owner_signature, password, ";
        $addFranchiseQuery .= "parent_franchise_id, created_at) VALUES ('$owner_name', '$agency_name', '$email', '$phone', '$address', ";
        $addFranchiseQuery .= "'$pin_code', '$package', '$aadhaar_number', '$aadhaar_upload', '$pan_number', '$pan_upload', ";
        $addFranchiseQuery .= "'$owner_image', '$owner_signature', '$hashed_password', '$franchise_id', NOW())";
        $query = query($addFranchiseQuery);
        confirm($query);

        redirect("index");
        setMessage("User Registered!");
    }
}

// function updateProfile() is used to update the profile of the franchise
function updateProfile()
{
    global $db_conn;
    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    if (isset($_POST['updateProfile'])) {

        $owner_name = $_POST['owner_name'];
        $agency_name = $_POST['agency_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $pin_code = $_POST['pin_code'];
        $aadhaar_number = $_POST['aadhaar_number'];
        $pan_number = $_POST['pan_number'];

        $owner_image = $_FILES['owner_image']['name'];
        $owner_image_temp = $_FILES['owner_image']['tmp_name'];
        move_uploaded_file($owner_image_temp, "src/images/updateProfile/$owner_image");

        $updateProfileQuery = "UPDATE franchises SET owner_name = '{$owner_name}', agency_name = '{$agency_name}', email = '{$email}', ";
        $updateProfileQuery .= "phone = '$phone', address = '$address', pin_code = '$pin_code', aadhaar_number = '$aadhaar_number', ";
        $updateProfileQuery .= "pan_number = '$pan_number', owner_image = '$owner_image' ";
        $updateProfileQuery .= "WHERE id = '$franchise_id' ";
        $query = query($updateProfileQuery);
        confirm($query);

        setMessage("Profile details updated!");
        redirect("profile");
    }
}

/************************************ END OF ADMIN MODULE FUNCTIONS **************************************/
// 
// 
// 
// 
/************************************** ADMIN DASHBOARD FUNCTIONS ****************************************/

// function totalLabs() is used to fetch the total number of labs
function totalFranchise()
{
    $totalFranchisesQuery = "SELECT COUNT(*) AS total_franchise FROM franchises";
    $query = query($totalFranchisesQuery);
    confirm($query);

    $result = mysqli_fetch_assoc($query);
    if ($result) {
        echo $result['total_franchise'];
    }

    return null;
}

// function totalBookings() is used to fetch the total number of bookings
function totalBookings()
{
    $totalBookingsQuery = "SELECT COUNT(*) AS total_bookings FROM test_requests";
    $query = query($totalBookingsQuery);
    confirm($query);

    $result = mysqli_fetch_assoc($query);
    if ($result) {
        echo $result['total_bookings'];
    }

    return null;
}

// function fetchRechargeRequests() used to fetch recharge request details
function fetchRechargeRequests()
{

    $fetchRechargeRequestsQuery = "SELECT * FROM recharge_requests ORDER BY created_at DESC";
    $query = query($fetchRechargeRequestsQuery);
    confirm($query);

    while ($row = mysqli_fetch_array($query)) {

        $recharge_id = $row['id'];
        // $franchise_name = $row['franchise_name'];
        $amount = $row['amount'];
        $upi_reference = $row['upi_reference'];
        $attachments = $row['attachments'];
        $status = $row['status'];

        echo "<tr>";
        echo "<td>franchise_name</td>";
        echo "<td>{$amount}</td>";
        echo "<td>{$upi_reference}</td>";
        echo "<td><a href='../src/images/received_images/{$attachments}' target='_blank'>View Proof</a></td>";
        echo "<td>{$status}</td>";
        echo "<td>
                <a class='btn btn-success' href='requestApproved?id=$recharge_id' style='color: white;'>Approve</a>
                <a class='btn btn-danger' href='requestRejected?id=$recharge_id' style='color: white;'>Reject</a>
            </td>";
        echo "</tr>";
    }
}
