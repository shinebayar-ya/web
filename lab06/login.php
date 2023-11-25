<?php
include("menu.php");
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["button_login"])) {
    include("db.php");
    session_start();
    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection error:" . $conn->connect_error);
    }
    $email = $_POST["input_email"];
    $pass = $_POST["input_pass"];
    // Sanitize data
    $email = mysqli_real_escape_string($conn, $email);
    $pass = mysqli_real_escape_string($conn, $pass);
    $email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if ($email === '') {
        $email_empty = 'email field is empty. Server';
    } else if ($pass === '') {
        $pass_empty = 'pass field is empty. Server';
    } else if (preg_match($email_regex, $email)) {
        $query = "SELECT * FROM employee WHERE email = '$email' AND pass = '$pass';";

        // $pdo = new PDO("mysql:host=".$host.";dbname=".$dbname, $user, $password);
        // $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND pass = :pass");
        // $stmt->bindParam(':email', $email);
        // $stmt->bindParam(':pass', $pass);
        // $stmt->execute();

        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // $found = $stmt->rowCount() > 0;

        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $_SESSION["logged_in"] = true;
            header('location:list.php');
        } else {
            $err_msg = 'Нэвтрэх эрхгүй хэрэглэгч байна! Server';
        }
        $conn->close();
    } else {
        $email_format_err = "И-мэйл буруу байна! Server";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-dark">
    <div class="container mt-5 bg-light border rounded p-5">
        <form action="login.php" method="POST" id="form_login" onsubmit="return validate()">
            <h1>Login</h1>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label for="input_email">Email</label>
                    <input type="text" class="form-control" name="input_email" id="input_email" placeholder="Email">
                    <span id="desc_email" class="text-danger">
                        <?php
                        echo (isset($email_empty) ? $email_empty : '');
                        echo (isset($email_format_err) ? $email_format_err : '');
                        ?>
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="input_pass">Password</label>
                    <input type="password" class="form-control" name="input_pass" id="input_pass" placeholder="Password">
                    <span id="desc_pass" class="text-danger"> <?php
                        echo (isset($pass_empty) ? $pass_empty : '');
                        ?></span>
                </div>
            </div>
            <input type="submit" class="btn btn-success" name="button_login" id="button_login" value="Login">
            <br>
            <?php
            if (isset($err_msg)) {
                echo "<p class='text-danger'>" . $err_msg . "</p>";
            }
            ?>
        </form>
    </div>
    <script src="login_validation.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>