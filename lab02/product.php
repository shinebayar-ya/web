<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}


// Function to read and parse product data from product.txt.
function readProductData() {
    $productData = [];

    // Read the product.txt file line by line.
    $lines = file('product.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Parse each line and split it into product name and price at the last space.
    foreach ($lines as $line) {
        $lastSpacePos = strrpos($line, ' '); // Find the last space position.
        if ($lastSpacePos !== false) {
            $productName = substr($line, 0, $lastSpacePos); // Extract product name.
            $productPrice = substr($line, $lastSpacePos + 1); // Extract product price.
            $productData[] = ['name' => $productName, 'price' => $productPrice];
        }
    }

    return $productData;
}

// Read product data from the file.
$productData = readProductData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <h3>Product List</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productData as $product): ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
