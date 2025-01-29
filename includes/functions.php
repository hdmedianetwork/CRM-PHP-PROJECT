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


function escape_string($string)
{

    global $db_conn;

    return mysqli_real_escape_string($db_conn, $string);
}


function fetch_array($result)
{

    return mysqli_fetch_array($result);
}




function IsLoggedIn()
{
    if (isset($_SESSION['username'])) {

        return true;
    } else {

        return false;
    }
}





function get_user_name()
{
    if (isset($_SESSION['username'])) {

        return $_SESSION['username'];
    }
}




function get_user_id()
{
    if (isset($_SESSION['id'])) {

        return $_SESSION['id'];
    }
}




/***************************************** END HELPER FUNCTIONS ******************************************/

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


        $registerQuery = "INSERT INTO users(username, email, city, state, usertype, password) VALUES('{$username}', '{$email}', '{$city}', '{$state}', '{$usertype}' , '{$hashed_password}') ";
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

    if (isset($_POST['login'])) {

        // CSRF token validation
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            setMessage("Invalid CSRF token.");
            redirect("login");
            exit();
        }


        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $username = mysqli_real_escape_string($db_conn, $username);
        $password = mysqli_real_escape_string($db_conn, $password);

        $loginQuery = "SELECT * FROM franchises WHERE username = '$username' ";
        $query = query($loginQuery);
        confirm($query);

        if (mysqli_num_rows($query) > 0) {

            while ($row = mysqli_fetch_array($query)) {

                $db_userid = $row['id'];
                $dbusername = $row['username'];
                $dbpassword = $row['password'];

                if (password_verify($password, $dbpassword)) {
                    $_SESSION['id'] = $db_userid;
                    $_SESSION['username'] = $dbusername;
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

/************************************* END REGISTER/LOGIN FUNCTIONS **************************************/

/************************************** FRANCHISE MODULE FUNCTIONS ***************************************/

// function fetchWalletBalance() is used to fetch balance of the franchise's wallet
function fetchWalletBalance()
{
    global $db_conn;

    $franchise_id = $_SESSION['id'];
    $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

    // $walletBalanceQuery = "SELECT wallet_balance FROM franchises WHERE id = '$franchise_id'";
    $walletBalanceQuery = "SELECT SUM(amount) AS total_amount FROM recharge_requests WHERE status = 'approved' AND franchise_id = $franchise_id ";
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

        $rechargeWalletQuery = "INSERT INTO recharge_requests (franchise_id, amount, upi_reference, attachments, created_at) VALUES ('$franchise_id', '$amount', '$upi_reference_id', '$image', NOW()) ";
        $query = query($rechargeWalletQuery);
        confirm($query);

        if (confirm($query)) {
            echo "Your request has been submitted and is pending for approval";
        } else {
            echo "There was an error submitting your request. Please try again.";
        }
    }
}
