<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <div>
        <h2>RegisterForm</h2>
        <p>Please fill out this form to register</p>
        <div>
        <?php
        if (isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if (!preg_match('/^[A-Z](?=.*\d)/', $password)) {
                echo 'Passwords must be at least 6 characters long, the first letter capitalized, include number';
            } elseif ($password != $confirm_password) {
                echo '<br>Passwords do not match';
            } else {
                echo 'You are Registered';
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = 'INSERT INTO users (first_name, last_name, email, password) VALUES(?, ?, ? ,?)';
                $stmt = $db->prepare($query);
                $result = $stmt->execute([$first_name, $last_name, $email, $password]);
                if ($result) {
                    echo 'Register Success';
                } else {
                    echo 'Error';
                }
            }
        }
        ?>
        </div>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="first_name">First Name:
                    <sup>*</sup>
                </label>
                <input type="text" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:
                    <sup>*</sup>
                </label>
                <input type="text" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:
                    <sup>*</sup>
                </label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:
                    <sup>*</sup>
                </label>
                <input type="password" name="password" required minlength="6"> 
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:
                    <sup>*</sup>
                </label>
                <input type="password" name="confirm_password" required minlength="6">
            </div>

            <div class="row">
                <div class="col">
                    <input type="submit" name="submit" value="Register" class="btn">
                </div>
            </div>
        </form>
    </div>
</head>

<body>

</body>

</html>