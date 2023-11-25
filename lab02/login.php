<?php
  session_start();

  // Аль хэдийн нэвтэрсэн байвал product хуудас руу шууд зочилно.
  if (isset($_SESSION['username'])) {
    header('Location: product.php');
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Оруулсан username, password -г хувьсагчт хадгална.
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    // Дараах мэдээлэлтэй хэрэглэгчийн мэдээллээр баталгаажуулалт хийгдэнэ.
    $validUsername = 'user';
    $validPassword = '123';

    if ($submittedUsername === $validUsername && $submittedPassword === $validPassword) {
      // Баталгаажуулалт амжилттай болвол session -д хэрэглэгчийн нэрийг хадгална.
      $_SESSION['username'] = $submittedUsername;
      header('Location: product.php');
      exit();
    } else {
      // Баталгаажүүлалт бүтэлгүйтвэл алдааны мессежыг харуулна.
      echo "Invalid username or password. Please try again.";
      echo "<a href='login.html'>Back to login</a>";
    }
  }
?>
