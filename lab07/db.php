<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "webprogramming";
$src = "MySQL";

function fetch_table_from_db($conn)
{
  $result = $conn->query("SELECT * FROM Pet;");
  $data = [];
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }
  $result->close();
  $conn->close();
  return $data;
}

function fetch_record_from_db($conn, $key)
{
  $query = "SELECT * FROM Pet WHERE Name = '$key';";
  $result = $conn->query($query);
  $data = [];
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }
  $result->close();
  $conn->close();
  return $data;
}
?>