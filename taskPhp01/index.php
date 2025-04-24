<?php
$username = "";
$email = "";
$age = null;
$password = "";
$confirm_password = "";
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $age = trim($_POST['age']);
    $email = trim($_POST['email']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($username)) {
        $errors['username'] = "username is required";
    }
    if (empty($email)) {
        $errors['email'] = "email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    if (empty($age)) {
        $errors['age'] = "age is required";
    } elseif (!is_numeric($age)) {
        $errors['age'] = "age must be a number";
    } elseif ($age > 18) {
        $errors['age'] = "age must be a bigger than 18 years";
    }
    if (empty($password)) {
        $errors['password'] = "password is required";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "length password must be a bigger than 6";
    }
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "confirm password is required";
    } elseif ($confirm_password !== $password) {
        $errors['confirm_password'] = "password do not match";
    }
    if (empty($errors)) {
        echo "<h3 style='color:green'>Form Submtion successfully!</h3>";    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>register form</title>
</head>

<body>
    <form action="tableUsers.php" method="post">
        <h2>Register form</h2>
        <div>
            <label for="username">username</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>">
        </div>
        <div>
            <?php if (isset($errors['username'])) : ?>
                <p style="color: red;"><?= $errors['username'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="email">email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>">
        </div>
        <div>
            <?php if (isset($errors['email'])) : ?>
                <p style="color: red;"><?= $errors['email'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="age">age</label>
            <input type="number" name="age" id="age" value="<?= htmlspecialchars($age) ?>">
        </div>
        <?php if (isset($errors['age'])) : ?>
            <p style="color: red;"><?= $errors['age'] ?></p>
        <?php endif; ?>
        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password"> <!-- كلمة المرور ما منحطلها  -->
        </div>
        <div>
            <?php if (isset($errors['password'])) : ?>
                <p style="color: red;"><?= $errors['password'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="confirm_password">confirm_password</label>
            <input type="password" name="confirm_password" id="confirm_password" value="<?= htmlspecialchars($confirm_password) ?>">
        </div>
        <div>
            <?php if (isset($errors['confirm_password'])) : ?>
                <p style="color: red;"><?= $errors['confirm_password'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <input type="submit" value="submit">
        </div>
    </form>

</body>

</html>