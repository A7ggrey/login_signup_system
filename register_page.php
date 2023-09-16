<?php
    session_start();
    
    include('db.php');

    if (isset($_POST['register_btn'])) {
        
        # declare variables from the registration form

        $firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $password = mysqli_real_escape_string($connect, password_hash($_POST['password'], PASSWORD_DEFAULT));

        # select user details to check if username already exists

        $sql_select = "SELECT * FROM users WHERE username = '$username'";
        $sql_select_result = mysqli_query($connect, $sql_select);

        if(mysqli_num_rows($sql_select_result) > 0) {

            # message to display if username already exists
            echo "<script>alert('username already taken, try another username!'); history.back(-1);</script>";
        } else {

            #insert user details into the user table

            $insert_query = "INSERT INTO users(firstname, lastname, username, email, password) VALUES('$firstname', '$lastname', '$username', '$email', '$password')";
            $insert_result = mysqli_query($connect, $insert_query);

            if ($insert_result) {
                
                # if the data is inserted successfully
                echo "<script>alert('User Register Successfully. You Can Login now!'); location.replace('./');</script>";
            } else {
                
                # if the data is not inserted successfully
                echo "<script>alert('User not Register Successfully. Try again!'); history.back(-1);</script>";
            }
        }
    }


?>