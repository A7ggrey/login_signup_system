<?php
    session_start();
    
    include('db.php');

    if (isset($_POST['login_btn'])) {
        
        # declare variables from the login form

        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);

        #sql query to select username from database

        $sql_query = "SELECT * FROM users WHERE username = '$username'";
        $sql_result = mysqli_query($connect, $sql_query);

        # check if the username exists or not

        if (mysqli_num_rows($sql_result) > 0) {
            
            # if exists, go on with the password check

            $rows = mysqli_fetch_assoc($sql_result);

        # declare the userid(PRIMARY KEY), username and password selected form the database
            $selected_user_id = $rows['userid'];
            $selected_username = $rows['username'];
            $selected_password = $rows['password'];

        #verify the hashed password from the database and check for a match with the submitted password

            $verified_password = password_verify($password, $selected_password);

        if ($password == $verified_password) {
            
            # if the verified password matches the keyed in password from the form
            # create a login session for the user

            session_regenerate_id();
            
            $_SESSION['user_id'] = $selected_user_id;
            $_SESSION['user_name'] = $selected_username;

            header('location: dashboard.php');
            exit;
        } else {
            
            #if the passwords do no match (Keyed in and selected from the database)
            echo "<script>alert('Wrong username or password!'); history.back(-1);</script>";
        }
        } else {
            
            #if a user doesnot exist in the database
            echo "<script>alert('Wrong username or password!'); history.back(-1);</script>";
        }
    }


?>