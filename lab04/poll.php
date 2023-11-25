<?php
// Function to load and parse poll.txt
function loadPollData() {
    $file = fopen("poll.txt", "r") or die("Unable to open file");
    $question = trim(fgets($file));
    $votes = explode(",", trim(fgets($file)));
    fclose($file);
    return ["question" => $question, "votes" => $votes];
}

// Function to save poll data back to poll.txt
function savePollData($data) {
    $file = fopen("poll.txt", "w+") or die("Unable to open file");
    $lines = [$data["question"], implode(",", $data["votes"])];
    fwrite($file, implode("\n", $lines));
}

// Check if a user has voted in the last 3 minutes
session_start();
if (!isset($_COOKIE["total_votes"])) {
  $data = loadPollData();
  $_COOKIE["total_votes"] = array_sum($data["votes"]);
}
$caution = false;
$total = $_COOKIE["total_votes"];
if (isset($_SESSION['last_vote_time']) && time() - $_SESSION['last_vote_time'] < 10) {
    // echo '<script>alert("Боломжгүй");</script>';
    $caution = true;
} else {
    if (isset($_POST['vote'])) {
        $vote = $_POST['vote'];
        $pollData = loadPollData();
        $pollData["votes"][$vote] += 1;
        $total = $_COOKIE["total_votes"] + 1;
        setcookie("total_votes", $total);
        savePollData($pollData);
        $_SESSION['last_vote_time'] = time();
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Poll</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-dark">
  <header>
    <!-- place navbar here -->
  </header>
  <main>
      <div class="container bg-light mt-5 border border-success rounded p-3" style="width: 400px;">
        <h3>САНАЛ АСУУЛГА</h3>
        <?php 
        if ($caution == true) 
        echo '<p class="text-danger">Хүсэлт амжилтгүй.</p>'
        ?>
        <p class="text-left"><?php 
            $pollData = loadPollData();
            echo $pollData["question"];
     ?></p>
        <form method="POST">
            <div class="d-grid gap-3">
                <div class="form-check border border-secondary py-2">
                  <input class="form-check-input" type="radio" name="vote" value="0">
                  <label class="form-check-label" for="vote">
                    Тийм
                  </label>
                </div>
                <div class="form-check border border-secondary py-2">
                  <input class="form-check-input" type="radio" name="vote" value="1">
                  <label class="form-check-label" for="vote">
                    Үгүй
                  </label>
                </div>
                <div class="form-check border border-secondary py-2">
                  <input class="form-check-input" type="radio" name="vote" value="2">
                  <label class="form-check-label" for="vote">
                    Мэдэхгүй
                  </label>
                </div>
            </div>
            <input type="submit" class="btn btn-danger mt-3" value="САНАЛ ӨГӨХ">
            <p class="text-left">(Нийт: <?php echo $total;?>)</p>
        </form>
    </div>
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
