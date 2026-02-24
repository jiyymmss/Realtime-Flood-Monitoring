<?php
session_start();
    include("secur.php");
    include("includes/connect.php");

    if(isset($_POST['submit'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $sql = "SELECT * FROM admin WHERE user = '$user' and pass ='$pass'";
        $result = mysqli_query($conn, $sql);

        if($result){
            $_SESSION['user'] = "$user";
            header("Location:admin_view.php");
        }
        else{
            echo '<script>
            window.location.href="login.php";
            alert("Login failed. Invalid username or password")
            </script>';
        }
    }
    
?>