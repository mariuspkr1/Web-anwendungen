<?php
if(isset($_POST['signup-submit']))
{

    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gen = $_POST['gender'];
    $bild = $_POST['bild'];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();
    }
    elseif ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordCheck&uid=".$username."&mail=".$email);
        exit();
    }
    else {

        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            }
            else {
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, vkey) VALUES (?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {

                    $haschedPwd = password_hash($password, PASSWORD_DEFAULT);
                    $vkey = md5(time().$username);
                    $username = $conn->real_escape_string($username);
                    $email = $conn->real_escape_string($email);
                    mysqli_stmt_bind_param($stmt,"ssss", $username, $email, $haschedPwd, $vkey);
                    mysqli_stmt_execute($stmt);

                    if(isset($_POST['name']))
                    {
                        $sql = "UPDATE users SET userName =? WHERE uidUsers=?";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("Location: ../index.php?error=sqlerror");
                            exit();
                        }
                        else{
                            $name = mysqli_real_escape_string($conn, htmlentities($name));
                            mysqli_stmt_bind_param($stmt,"ss", $name, $username);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                    if(isset($_POST['age']))
                    {
                        $sql = "UPDATE users SET userAge =? WHERE uidUsers=?";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("Location: ../index.php?error=sqlerror");
                            exit();
                        }
                        else{
                            $age = mysqli_real_escape_string($conn, htmlentities($age));
                            mysqli_stmt_bind_param($stmt,"ss", $age, $username);
                            mysqli_stmt_execute($stmt);
                        }

                    }
                    if(isset($_POST['gender']))
                    {
                        $sql = "UPDATE users SET userGen =? WHERE uidUsers=?";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("Location: ../index.php?error=sqlerror");
                            exit();
                        }
                        else{
                            $gen = mysqli_real_escape_string($conn, htmlentities($gen));
                            mysqli_stmt_bind_param($stmt,"ss", $gen, $username);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                    header("Location: ../fakeverification.php?vkey=$vkey");
                    exit();
                }
            }

        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else {
    header("Location: ../signup.php");
    exit();
}