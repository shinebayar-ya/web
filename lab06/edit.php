<?php
include("check_login.php");
include("menu.php");
include("db.php");
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection error:" . $conn->connect_error);
}

$successfullyUpdate = false;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  // if (isset($_GET['edit'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM Pet WHERE PetID = $id";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $name = $row['Name'];
      $owner = $row['Owner'];
      $type = $row['Type'];
      $gender = $row['Gender'];
      $birth = $row['Birth'];
    }
  } else {
    echo "Error updating record: " . $conn->error;
  }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['save'])) {
    $id = $_POST['inputID'];
    $name = $_POST['inputName'];
    $owner = $_POST['inputOwner'];
    $type = $_POST['inputType'];
    $gender = $_POST['inputGender'];
    $birth = $_POST['inputBirth'];

    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $name);
    $owner = mysqli_real_escape_string($conn, $owner);
    $type = mysqli_real_escape_string($conn, $type);
    $gender = mysqli_real_escape_string($conn, $gender);
    $birth = mysqli_real_escape_string($conn, $birth);

    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $owner = htmlspecialchars($owner, ENT_QUOTES, 'UTF-8');
    $type = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
    $gender = htmlspecialchars($gender, ENT_QUOTES, 'UTF-8');
    $birth = htmlspecialchars($birth, ENT_QUOTES, 'UTF-8');

    // $name = sanitize_input($name);
    // $owner = sanitize_input($owner);
    // $type = sanitize_input($type);
    // $gender = sanitize_input($gender);
    // $birth = sanitize_input($birth);


    $query = "UPDATE Pet SET Name = '$name', Owner = '$owner', Type = '$type', Gender = '$gender', Birth = '$birth' WHERE PetID = '$id';";
    if ($conn->query($query) === TRUE) {
      $successfullyUpdate = true;
      // header('location:list.php');
    } else {
      echo "Error updating record: " . $conn->error;
    }
  } elseif (isset($_POST['reset'])) {
    // User clicked the "Reset" button
  }
}
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
  <title>Edit</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-dark">
  <div class="container mt-5 bg-light border rounded p-5">
    <form action="edit.php" method="POST">
      <h1>Edit Pet</h1>
      <div class="row mb-3">
        <div class="form-group col">
          <!-- <label for="inputID">ID</label> -->
          <input type="hidden" class="form-control" name="inputID" value="<?php echo (isset($id) ? $id : ''); ?>">
        </div>
      </div>
      <div class="row mb-3">
        <div class="form-group col-md-6">
          <label for="inputName">Name</label>
          <input type="text" class="form-control" name="inputName" value="<?php echo (isset($name) ? $name : ''); ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="inputOwner">Owner</label>
          <input type="text" class="form-control" name="inputOwner"
            value="<?php echo (isset($owner) ? $owner : ''); ?>">
        </div>
      </div>
      <div class="row mb-3">
        <div class="form-group col-md-6">
          <label for="inputType">Type</label>
          <select name="inputType" class="form-control">
            <option <?php echo (!isset($type) ? 'selected' : ''); ?>>Choose</option>
            <option <?php echo ((isset($type) && $type == 'Dog') ? 'selected' : ''); ?> value="Dog">Dog</option>
            <option <?php echo ((isset($type) && $type == 'Cat') ? 'selected' : ''); ?> value="Cat">Cat</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="inputGender">Gender</label>
          <select name="inputGender" class="form-control">
            <option <?php echo (!isset($gender) ? 'selected' : ''); ?>>Choose</option>
            <option <?php echo ((isset($gender) && $gender == 'M') ? 'selected' : ''); ?> value="M">Male</option>
            <option <?php echo ((isset($gender) && $gender == 'F') ? 'selected' : ''); ?> value="F">Female</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="form-group col-md-6">

          <label for="inputBirth">Birth</label>
          <input type="date" class="form-control" name="inputBirth"
            value="<?php echo (isset($birth) ? $birth : ''); ?>">
        </div>
      </div>
      <input type="submit" class="btn btn-success" name="save" value="Save">
      <input type="reset" class="btn btn-secondary" value="Reset">
      <br>
      <?php
      if ($successfullyUpdate == true) {
        echo "<p class='text-success'>Data updated</p>";
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