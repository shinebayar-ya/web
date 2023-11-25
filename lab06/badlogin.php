<?php
include("menu.php");
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["login"])) {
    include("db.php");
    session_start();
    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection error:" . $conn->connect_error);
    }
    $email = $_POST["input_email"];
    $pass = $_POST["input_pass"];
    $query = "SELECT * FROM employee WHERE email = '$email' AND pass = '$pass';";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $_SESSION["logged_in"] = true;
        header('location:list.php');
    } else {
        $conn_err_msg = 'Check again email or password.';
    }
    $conn->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Bad Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-dark">
    <div class="container mt-5 bg-light border rounded p-5">
        <form action="badlogin.php" method="POST">
            <h1>Bad Login</h1>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label for="input_email">Email</label>
                    <input type="text" class="form-control" name="input_email" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="input_pass">Password</label>
                    <input type="password" class="form-control" name="input_pass" placeholder="Password">
                </div>
            </div>
            <input type="submit" class="btn btn-success" name="login" value="Login">
            <br>
            <?php
            if (isset($conn_err_msg)) {
                echo "<p class='text-danger'>" . $conn_err_msg . "</p>";
            }
            ?>
        </form>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>