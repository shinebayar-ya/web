<?php
include 'menu.php';
include 'db.php';
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection error:" . $conn->connect_error);
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>List</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-dark">
  <div class="container bg-light border rounded mt-5 p-5">
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">PetID</th>
          <th scope="col">Name</th>
          <th scope="col">Owner</th>
          <th scope="col">Gender</th>
          <th scope="col">Type</th>
          <th scope="col">Birth</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <script>
          function deleteRecord(id) {
            if (confirm('Do you want to delete this record?')) {
              window.location = 'delete.php?id=' + id;
            }
          }
        </script>
        <?php
        $query = "SELECT * FROM Pet;";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $str = "<tr>";
            $str .= "<td>" . $row["PetID"] . "</td>";
            $str .= "<td>" . $row["Name"] . "</td>";
            $str .= "<td>" . $row["Owner"] . "</td>";
            $str .= "<td>" . $row["Gender"] . "</td>";
            $str .= "<td>" . $row["Type"] . "</td>";
            $str .= "<td>" . $row["Birth"] . "</td>";
            $str .= "<td>" . "<a href=# onclick='deleteRecord(" . $row['PetID'] . ")'>Delete</a>,<a href='edit.php'>Edit</a>" . "</td>";
            $str .= "</tr>";
            echo $str;
          }
        }
        ?>
      </tbody>
    </table>

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