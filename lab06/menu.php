<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Pet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="list.php">List</a>
            </li>
          </ul>
          <form action="search.php" method="GET" class="d-flex">
            <input class="form-control me-2" type="search" name="inputSearch" placeholder="Search" aria-label="Search">
            <input class="btn btn-outline-dark" type="submit" name="btnSearch" value="Search"></input>
          </form>
          <?php
          if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
            ?>
            <form action="logout.php" method="POST" class="d-flex mx-2">
              <input class="btn btn-outline-danger" type="submit" name="btnLogout" value="Logout"></input>
            </form>
          <?php
          } else {
            ?>
            <form action="login.php" method="POST" class="d-flex mx-2">
              <input class="btn btn-outline-primary" type="submit" name="btnLogin" value="Login"></input>
            </form>
            <?php
          }
          ?>
        </div>
      </div>
    </nav>
  </header>
  <main>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>