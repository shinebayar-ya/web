<?php
if (isset($_GET["in"])) {
  $result = 0;
  switch ($_GET["unit"]) {
    case "1":
      $result = $_GET["in"] * 2.54;
      break;
    case "2":
      $result = $_GET["in"] * 1.6;
      break;
    case "3":
      $result = $_GET["in"] * 745.7;
      break;
    case "4":
      $result = $_GET["in"] * 453.5924;
      break;
    case "5":
      $result = $_GET["in"] * 119.24;
      break;
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laboratory #3</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-success ">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="bg-light rounded-3" style="width: auto; padding: 50px;">
      <div class="d-flex justify-content-center mx-auto">
        <form action="index.php" method="get">
          <br>
          <div class="row">
            <div class="col-sm-6">
              <label for="in">Утга Хөрвүүлэх</label>
            </div>
            <div class="col-sm-6">
              <input type="button" class="btn btn-primary position-absolute" value=" Бүх лабораторийн ажил">
              <span class="phicon glyphicon-th-list"> </span>
            </div>
          </div>
          <br>
          <hr>
          <div class="row">
            <div class="col-sm-6">
              Хувиргах утга<br>
              <input type="text" class="form-control" name="in" value="<?php echo $_GET["in"]?>">
            </div>
            <div class="col-sm-6">
              Хувиргах төрөл<br>
              <select name="unit">
                <option value="1">инч-см</option>
                <option value="2">миль-км</option>
                <option value="3">морьны хүч-Ватт</option>
                <option value="4">паунд-грамм</option>
                <option value="5">баррел-литр</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              Нэгжийн утга
              <input type="text" class="form-control" value="<?php echo $result; ?>">
            </div>
          </div>
          <br>
          <input type="submit" class="btn btn-success" value="convert">
          <input type="reset" class="btn btn-secondary" value="clear">

        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>