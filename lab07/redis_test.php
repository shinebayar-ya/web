<?php
include("check_login.php");
include("menu.php");
include("db.php");
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection error:" . $conn->connect_error);
}
$redis = new Redis();

try {
    $redis->connect('localhost');
    echo '<br>';
    echo "Connected to Redis server successfully";
    echo '<br>';
} catch (RedisException $e) {
    echo "Failed to connect to Redis server: " . $e->getMessage() . "\n";
}

$redis->close();
?>