<?php
session_start();

$loggedIn = false;

if (isset($_SESSION['userId'])) {
    $loggedIn = true;
} ?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $loggedIn ? 'User Account' : 'Login / Register Forms' ?></title>
        <!-- 
            Pico CSS faremwork
            https://picocss.com
        -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css" />
    </head>
    <body>
        <main>
            <?php
            if ($loggedIn) { ?>
                <h1>User account</h1>
                <div>You are now logged in as <?= $_SESSION['userName'] ?></div>
                <div>
                    <a href="/logout.php">Logout</a>
                </div>
                <?php
            } else { ?>
                <h1>Login / Register Forms</h1>
                <?php
                if (isset($_GET['msg'])) { ?>
                    <article class="pico-background-green-500 pico-color-white-50">
                        <span><?= $_GET['msg'] ?></span>
                    </article>
                    <?php
                } ?>
                <div>
                    Please <a href="/login.php">Login</a> or <a href="/register.php">Register</a>
                </div>
                <?php
            } ?>
        </main>
    </body>
</html>