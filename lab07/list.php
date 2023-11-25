<?php
include("check_login.php");
include("menu.php");
include("db.php");
include("redis.php");

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection error:" . $conn->connect_error);
}

$table = "pet";
$key = "row";
$cacheExpiration = 1 * 60;

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// $table = fetch_string_from_cache($redis, $table, $cacheExpiration, $conn, $src);
$table = fetch_record_from_cache($redis, $table, $key, $cacheExpiration, $conn, $src);
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
    <?php
    echo "<h2 class='text-primary'>from " . $src . "</h1>";
    ?>
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
        <?php
        foreach ($table as $row) {
          $str = "<tr>";
          $str .= "<td>" . $row["PetID"] . "</td>";
          $str .= "<td>" . $row["Name"] . "</td>";
          $str .= "<td>" . $row["Owner"] . "</td>";
          $str .= "<td>" . $row["Gender"] . "</td>";
          $str .= "<td>" . $row["Type"] . "</td>";
          $str .= "<td>" . $row["Birth"] . "</td>";
          $str .= "<td>";
          $str .= "<a href=# onclick='deleteRecord(" . $row['PetID'] . ")'>Delete</a>,";
          $str .= "<a href='edit.php?id=" . $row['PetID'] . "' name='edit'>Edit</a>";
          $str .= "</td>";
          $str .= "</tr>";
          echo $str;
        }
        ?>
      </tbody>
    </table>
  </div>
  <script src="alert.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>