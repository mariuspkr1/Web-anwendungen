<?php
require "header.php";
require 'includes/dbh.inc.php';
?>
    <noscript>
        <h3>
            To use this page please activate javascript!
        </h3>
    </noscript>
    <main>
        <div class="wrapper-main">
            <section class="section-default">
                <div id="userliste">
                    <h1>User</h1>
                    <div id="userstream"></div>
                </div>
                <div id="stream"></div>
                    <h1>Willkommen zum Blog</h1>
                    <h1>Kein Bier vor vier</h1>
                    <form class="form-signup" action="includes/login.inc.php" method="post">
                        <input type="text" name="mailuid" placeholder="Username/E-mail...">
                        <input type="password" name="pwd" placeholder="Password...">
                        <button type="submit" name="login-submit">Login</button>
                    </form>
                <div id="response"></div>
            </section>
        </div>
    </main>

<?php
require "footer.php";