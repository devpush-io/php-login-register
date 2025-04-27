
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form fields
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Do validation checks
    $errors = [];

    if (empty($name)) {
        $errors[] = 'Name is required';
        $nameInvalid = true;
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
        $emailInvalid = true;
    }
    if (empty($password)) {
        $errors[] = 'Password is required';
        $passwordInvalid = true;
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $errors[] = 'Email address is invalid';
        $emailInvalid = true;
    }
    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters';
        $passwordInvalid = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Form</title>
        <!-- 
            Pico CSS faremwork
            https://picocss.com
        -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
    </head>
    <body>
        <main>
            <h1>Register Form</h1>
            <div>
                <?php
                if (empty($errors) == false) {
                    foreach ($errors as $error) { ?>
                        <span><?= $error ?></span>
                    <?php
                    }
                } ?>
            </div>
            <form action="/register.php" method="post" style="max-width: 400px">
                <div>
                    <label for="name">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= $name ?? '' ?>"
                        aria-invalid="<?= $nameInvalid ? 'true' : 'false' ?>"
                        required />
                </div>
                <div>
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= $email ?? '' ?>"
                        aria-invalid="<?= $emailInvalid ? 'true' : 'false' ?>"
                        required />
                </div>
                <div>
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        value="<?= $password ?? '' ?>"
                        aria-invalid="<?= $passwordInvalid ? 'true' : 'false' ?>"
                        required />
                </div>
                <input type="submit" value="Submit" />
            </form>
            <div">
                <a href="/">Go back</a>
            </div>
        </main>
    </body>
</html>
