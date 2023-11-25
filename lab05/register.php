<?php
include 'menu.php';
include 'db.php';
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection error:" . $conn->connect_error);
}
$successfully = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['save'])) {
    $name = $_POST['inputName'];
    $owner = $_POST['inputOwner'];
    $type = $_POST['inputType'];
    $gender = $_POST['inputGender'];
    $birth = $_POST['inputBirth'];

    $query = "INSERT INTO Pet (Name, Owner, Type, Gender, Birth) VALUES ('$name', '$owner', '$type', '$gender', '$birth');";
    if ($conn->query($query) === TRUE) {
      $successfully = true;
    } else {
      echo "Error inserting record: " . $conn->error;
    }
  } elseif (isset($_POST['reset'])) {
    // User clicked the "Reset" button
    // You don't need to do anything here; the form will be cleared automatically.
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Register</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-dark">
  <div class="container mt-5 bg-light border rounded p-5">
    <form action="register.php" method="POST">
      <h1>Pet Registration</h1>
      <div class="row mb-3">
        <div class="form-group col-md-6">
          <label for="inputName">Name</label>
          <input type="text" class="form-control" name="inputName" placeholder="Name">
        </div>
        <div class="form-group col-md-6">
          <label for="inputOwner">Owner</label>
          <input type="text" class="form-control" name="inputOwner" placeholder="Owner">
        </div>
      </div>
      <div class="row mb-3">
        <div class="form-group col-md-6">
          <label for="inputType">Type</label>
          <select name="inputType" class="form-control">
            <option selected>Choose</option>
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="inputGender">Gender</label>
          <select name="inputGender" class="form-control">
            <option selected>Choose</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="form-group col-md-6">
          <label for="inputBirth">Birth</label>
          <input type="date" class="form-control" name="inputBirth" placeholder="Birth">
        </div>
      </div>
      <input type="submit" class="btn btn-success" name="save" value="Save">
      <input type="reset" class="btn btn-secondary" value="Reset">
      <br>
      <?php
      if ($successfully == true) {
        echo "<p class='text-success'>Data Saved</p>";
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