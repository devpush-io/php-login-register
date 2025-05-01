<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form fields
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Get user by email
    require __DIR__ . '/dbConnect.php';

    $sql = "SELECT * FROM users WHERE email = ?";
    $pdoStatement = $pdo->prepare($sql);

    $pdoStatement->execute([$email]);
    $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Check password
        $passwordValid = password_verify($password, $result['password']);

        if ($passwordValid) {
            // Setup a session for a logged in user
            session_start();

            $_SESSION['userId'] = $result['id'];
            $_SESSION['userName'] =  $result['name'];

            header('Location: /');
            exit;
        }
    }
    $error = 'User details are invalid';
} ?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
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
            <h1>Login Form</h1>
            <div style="max-width: 600px">
                <?php
                if (empty($error) == false) { ?>
                    <article class="pico-background-red-500 pico-color-white-50">
                        <span><?= $error ?></span>
                    </article>
                    <?php
                } ?>
                <form action="/login.php" method="post">
                    <div>
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= $email ?? '' ?>"
                            required />
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required />
                    </div>
                    <input type="submit" value="Submit" />
                </form>
            </div>
            <div>
                <a href="/">Go back</a>
            </div>
        </main>
    </body>
</html>
