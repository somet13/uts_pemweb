<?php
        //login
        if(isset($_POST['submit'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            if($email == 'admin@email.com' && $password == 'admin') {
                header('Location:./../../profile.php');
            } else {
                echo "email atau password salah";
            }
        }
?>