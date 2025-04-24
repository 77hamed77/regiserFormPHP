<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $age = trim($_POST['age']);
    $email = trim($_POST['email']);

    $errors = [];
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    if (empty($age)) {
        $errors['age'] = "Age is required";
    } elseif (!is_numeric($age)) {
        $errors['age'] = "Age must be a number";
    } elseif ($age < 18) {
        $errors['age'] = "Age must be greater than or equal to 18";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long";
    }

    if (!empty($errors)) {
        // عرض الأخطاء في حالة وجودها
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    } else {
        // البيانات سليمة وتُعرض
        echo "<h3 style='color:green'>Form submitted successfully!</h3>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>users table</title>
</head>

<body>
    <?php
    if (empty($errors)) {
        // عرض الجدول فقط إذا لم تكن هناك أخطاء
        echo "
        <table>
            <tr>
                <th>Username</th>
                <th>Age</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            <tr>
                <td>$username</td>
                <td>$age</td>
                <td>$email</td>
                <td>$password</td>
            </tr>
        </table>";
    } ?>
</body>

</html>