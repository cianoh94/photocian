<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$msgs = $errors = [];

/* Connecting to the database. */
$db_host = "localhost";
$db_name = "photographer";
$db_username = "root";
$db_password = "";
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die("Connection failed with database, host as $db_host, username as $db_username, password as $db_password, database name is $db_name");


/**
 * If you pass a message to the function, it will add it to the array. 
 * If you don't pass a message to the function, it will return the array.
 * 
 * @param msg The message to be displayed.
 * 
 * @return The array of messages.
 */
function msg($msg = ""){
    global $msgs;
    if($msg == ""){
        return $msgs;
    }else{
        array_push($msgs, $msg);
    }
}

/**
 * If you pass it a string, it adds it to the  array. If you don't pass it a string, it returns
 * the  array.
 * 
 * @param error The error message to be displayed. If no error message is given, the function will
 * return the array of errors.
 * 
 * @return the global variable .
 */
function error($error = ""){
    global $errors;
    if($error == ""){
        return $errors;
    }else{
        array_push($errors, $error);
    }
}

/**
 * If the user_id session variable is set, return true, otherwise return false.
 * 
 * @return a boolean value.
 */
function loggedin($type = NULL){
    if(isset($_SESSION["user_id"])){
        if($type !== NULL){
            if($_SESSION["user_type"] == $type){
                return true;
            }else{
                return false;
            }
        }
        return true;
    }else{
        return false;
    }
}

function logout(){
    unset($_SESSION["user_id"]);
    unset($_SESSION["user_type"]);
    header("Location: index.php");
}

/**
 * It returns the value of a column in a table, given the table name, column name, and user id.
 * 
 * @param table The table you want to get the information from.
 * @param info The information you want to get from the database.
 * @param user_id The user id of the user you want to get the information of. If you don't specify a
 * user id, it will get the information of the logged in user.
 * 
 * @return The user's information.
 */
function user_info($info, $user_id = 0){
    if(!loggedin()){
        return false;
    }
    global $conn;

    if($user_id == 0){
        $user_id = $_SESSION["user_id"];
    }

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_array($sql);
        return $row[$info];
    }
}

function redirect($location){
    header("location: $location");
}


// ACTIONS
if(isset($_GET["error"])){
    error($_GET["error"]);
}
if(isset($_GET["msg"])){
    msg($_GET["msg"]);
}


// Login required
if(isset($login_required)){
    if(loggedin()){
        if(!in_array($_SESSION["user_type"], $login_required)){
            header("location: index.php");    
        }
    }else{
        header("location: login.php");
    }
}
if(isset($login_page) && loggedin()){
    redirect("account.php");
}

if(isset($_POST["login"])){
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if(empty($email) || empty($password)){
        error("All fields are required!");
    }else{
        $login_sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($login_sql) > 0){
            $login_row = mysqli_fetch_array($login_sql);
            if(!password_verify($password, $login_row["password"])){
                error("Username/Password is incorrect!");
            }else{
                $_SESSION["user_id"] = $login_row["id"];
                $_SESSION["user_type"] = $login_row["role"];
                if($login_row["role"] == "customer"){
                    redirect("account.php");
                }else{
                    redirect("admin-users.php");
                }
            }
        }else{
            error("Username/Password is incorrect!");
        }
    }
}


// ADMIN ACTIONS
if(loggedin("admin")){

    // ADD USER 
    if(isset($_POST["add_user"])){
        $role = mysqli_real_escape_string($conn, $_POST["role"]);
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $c_password = mysqli_real_escape_string($conn, $_POST["c_password"]);

        if(empty($role) || empty($name) || empty($email) || empty($password) || empty($c_password)){
            error("All fields are required!");
        }elseif($password !== $c_password){
            error("Passwords don't matches!");
        }else{
            $check_sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
            if(mysqli_num_rows($check_sql) > 0){
                error("User with that email already exists.");
            }else{
                $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
                $insert_sql = mysqli_query($conn, "INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `created_at`) VALUES (NULL, '$role', '$name', '$email', '$hashed_pwd', current_timestamp())");
                if($insert_sql){
                    msg("User Registered!");
                }
            }
        }
    }

    // Edit User
    if(isset($_GET["edit"])){
        $edit_id = mysqli_real_escape_string($conn, $_GET["edit"]);
        $edit_sql = mysqli_query($conn, "SELECT * FROM users WHERE id = $edit_id");
        if(mysqli_num_rows($edit_sql) > 0){
            $edit_row = mysqli_fetch_array($edit_sql);

            if(isset($_POST["update_user"])){
                $role = mysqli_real_escape_string($conn, $_POST["role"]);
                $name = mysqli_real_escape_string($conn, $_POST["name"]);
                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                $password = mysqli_real_escape_string($conn, $_POST["password"]);
                $c_password = mysqli_real_escape_string($conn, $_POST["c_password"]);
                $current_email = $edit_row["email"];

                if((!empty($password) || !empty($c_password)) && ($password !== $c_password)){
                    error("Passwords don't matches!");
                }else{
                    $check_sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND email != '$current_email'");
                    if(mysqli_num_rows($check_sql) > 0){
                        error("User with that email already exists.");
                    }else{
                        if(empty($password)){
                            $hashed_pwd = $edit_row["password"];
                        }else{
                            $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
                        }
                        $insert_sql = mysqli_query($conn, "UPDATE `users` SET `role` = '$role', `name` = '$name', `email` = '$email', `password` = '$hashed_pwd' WHERE `users`.`id` = $edit_id;");
                        if($insert_sql){
                            msg("User Updated!");
                        }else{
                            error("Something went wrong in SQL");
                        }
                    }
                }
            }

        }else{
            redirect("admin-users.php");
        }

    }

    // Deleting Users
    if(isset($_GET["delete_user"])){
        $del_user = mysqli_real_escape_string($conn, $_GET["delete_user"]);
        if(user_info("role", $del_user) == "admin"){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE role = 'admin'");
            if(mysqli_num_rows($sql) > 1){
                $del_sql = mysqli_query($conn, "DELETE FROM `users` WHERE `users`.`id` = $del_user");
                if($del_sql){
                    redirect("admin-users.php?msg=Admin Deleted!");
                }
            }else{
                redirect("admin-users.php?error=There is must at least one admin");
            }
        }else{
            $del_sql = mysqli_query($conn, "DELETE FROM `users` WHERE `users`.`id` = $del_user");
            if($del_sql){
                redirect("admin-users.php?msg=Customer Deleted!");
            }
        }
    }

    //Add image
    if(isset($_POST["add_image"])){
        $customer = mysqli_real_escape_string($conn, $_POST["customer"]);
        $caption = mysqli_real_escape_string($conn, $_POST["caption"]);

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        // Allow certain file formats
        if($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg"
        && $imageFileType !== "gif" && $imageFileType !== "webp"  && $imageFileType !== "avif"  ) {
            error("Sorry, only JPG, JPEG, PNG, AVIF & GIF files are allowed.");
            $everything_ok = false;
        }

        $new_file_name = md5("$target_file".time()).".".$imageFileType;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$new_file_name)) {
            if(empty($customer)){
                $insert_sql = mysqli_query($conn, "INSERT INTO `gallery` (`id`, `caption`, `image`, `customer`, `created_at`) VALUES (NULL, '$caption', '$new_file_name', NULL, current_timestamp())");
            }else{
                $insert_sql = mysqli_query($conn, "INSERT INTO `gallery` (`id`, `caption`, `image`, `customer`, `created_at`) VALUES (NULL, '$caption', '$new_file_name', '$customer', current_timestamp())");
            }
            if($insert_sql){
                msg("Image added!");
            }
        }
    }

    //DELETE IMAGE
    if(isset($_GET["delete_image"])){
        $del_id = mysqli_real_escape_string($conn, $_GET["delete_image"]);
        $check_sql = mysqli_query($conn, "SELECT * FROM gallery WHERE id = $del_id");
        if(mysqli_num_rows($check_sql) > 0){
            $del_sql = mysqli_query($conn, "DELETE FROM `gallery` WHERE `gallery`.`id` = $del_id");
            if($del_sql){
                msg("Image Deleted!");
            }
        }else{
            redirect("admin-images.php");
        }
    }
    //DELETE ENTRY
    if(isset($_GET["delete_entry"])){
        $del_id = mysqli_real_escape_string($conn, $_GET["delete_entry"]);
        $check_sql = mysqli_query($conn, "SELECT * FROM bookings WHERE id = $del_id");
        if(mysqli_num_rows($check_sql) > 0){
            $del_sql = mysqli_query($conn, "DELETE FROM `bookings` WHERE `bookings`.`id` = $del_id");
            if($del_sql){
                msg("Entry Deleted!");
            }
        }else{
            redirect("admin-entries.php");
        }
    }
}

// CUSTOMER ACTIONS
if(loggedin("customer")){
    if(isset($_POST["update_customer"])){
        $user_id = user_info("id");
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $c_password = mysqli_real_escape_string($conn, $_POST["c_password"]);
        $current_email = user_info("email");

        if((!empty($password) || !empty($c_password)) && ($password !== $c_password)){
            error("Passwords don't matches!");
        }else{
            $check_sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND email != '$current_email'");
            if(mysqli_num_rows($check_sql) > 0){
                error("User with that email already exists.");
            }else{
                if(empty($password)){
                    $hashed_pwd = user_info("password");
                }else{
                    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
                }
                $insert_sql = mysqli_query($conn, "UPDATE `users` SET `name` = '$name', `email` = '$email', `password` = '$hashed_pwd' WHERE `users`.`id` = $user_id;");
                if($insert_sql){
                    msg("User Updated!");
                }else{
                    error("Something went wrong in SQL");
                }
            }
        }
    }
}

// ADD BOOKING
if(isset($_POST["add_booking"])){
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $subject = mysqli_real_escape_string($conn, $_POST["subject"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    if(empty($name) || empty($email) || empty($subject) || empty($message)){
        error("All fields are required!");
    }else{
        $insert_sql = mysqli_query($conn, "INSERT INTO `bookings` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES (NULL, '$name', '$email', '$subject', '$message', current_timestamp())");
        if($insert_sql){
            msg("Thanks for getting in touch with us! We'll respond within 24 hours!");
        }
    }
}

?>