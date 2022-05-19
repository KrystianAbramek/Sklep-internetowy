<?php

$con = mysqli_connect("localhost", "root", "", "shopee");{

    $try_name = trim($_POST['name']);
    $try_surname = trim($_POST['surname']);
    $try_email_address = trim($_POST['email_address']);
    $try_password = trim($_POST['password']);
    $try_confirmed_password = trim($_POST['confirm_password']);
    $try_phone_number = trim($_POST['phone_number']);
    $try_age = trim($_POST['age']);

    if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email_address']) || empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['phone_number']) || empty($_POST['age']))
        include("../unsuccessful_add_user.php");
    else{

        if($try_password == $try_confirmed_password){

            $add_user=mysqli_query($con, "INSERT INTO user (name, surname, email, password, phone_number, age) VALUES ('$try_name', '$try_surname', '$try_email_address', '$try_password', '$try_phone_number', '$try_age')");

            if($add_user)
                include("../successful_add_user.php");
            else
                include("../unsuccessful_add_user.php");
        }
        else
            include("../unsuccessful_add_user.php");
    }
}

?>