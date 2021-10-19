<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="Bierblog">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>Bierblog - Feinkost für Feinschmecker</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-login">
        <?php
        if (isset($_SESSION['userId'])) {
            echo '<form action="includes/logout.inc.php" method="post">
                            <button type="submit" name="logout-submit">Logout</button>
                        </form>';
        }
        else {
            echo '<form action="includes/login.inc.php" method="post">
                             <input type="text" name="mailuid" placeholder="Username/E-mail...">
                             <input type="password" name="pwd" placeholder="Password...">
                             <button type="submit" name="login-submit">Login</button>
                         </form>
                         <a href="signup.php" class="header-signup">Signup</a>';
        }
        ?>


    </div>
</header>
</html>