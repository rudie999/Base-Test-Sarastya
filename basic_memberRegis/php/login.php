<?php 
session_start();

if(isset($_POST['uname']) && 
   isset($_POST['pass'])){

    include "../db_conn.php";

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "uname=".$uname;
    
    if(empty($uname)){
    	$em = "User name is required";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    } else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    } else {

    	try {
            $db = new PDO("pgsql:dbname=$db_name;host=$host", $dbuser, $dbpass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $em = "Failed to connect to database: " . $e->getMessage();
            header("Location: ../login.php?error=$em&$data");
            exit;
        }

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$uname]);

        if($stmt->rowCount() == 1){
            $user = $stmt->fetch();

            $username =  $user['username'];
            $password =  $user['password'];
            $fname =  $user['fname'];
            $id =  $user['id'];
            $pp =  $user['pp'];

            if($username === $uname){
                if(password_verify($pass, $password)){
                    $_SESSION['id'] = $id;
                    $_SESSION['fname'] = $fname;
                    $_SESSION['pp'] = $pp;

                    header("Location: ../home.php");
                    exit;
                } else {
                    $em = "Incorrect User name or password";
                    header("Location: ../login.php?error=$em&$data");
                    exit;
                }
            } else {
                $em = "Incorrect User name or password";
                header("Location: ../login.php?error=$em&$data");
                exit;
            }

        } else {
            $em = "Incorrect User name or password";
            header("Location: ../login.php?error=$em&$data");
            exit;
        }
    }
} else {
   
