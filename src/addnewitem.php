<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>
</head>
<body>
    <h2>Add New Item</h2>
    <form action="AddNewItem.php" method="post">
        <label for="naam">Item Name:</label>
        <input type="text" id="naam" name="naam" required>
        <br>
        <label for="prijs">Item Price:</label>
        <input type="text" id="prijs" name="prijs" required>
        <br>
        <input type="submit" value="Add Item">
    </form>
</body>
</html>
<?php


require "../vendor/autoload.php";

// Assuming you have received the form data through POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $naam = $_POST["naam"] ?? "";
    $prijs = $_POST["prijs"] ?? "";

    // Validate form data (add more validation as needed)
    if (empty($naam) || empty($prijs) || !is_numeric($prijs)) {
        echo "Invalid form data. Please provide a valid name and price.";
        die();
    }

    try {
        // Create an instance of PDO (replace with your actual database connection parameters)
        $pdo = new PDO('mysql:host=localhost;dbname=kassasysteem', 'MainDev', 'GbXH85WN6VIOAAZE');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to insert a new item
        $sql = "INSERT INTO product (naam, prijs) VALUES (:naam, :prijs)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bindParam(':naam', $naam, PDO::PARAM_STR);
        $stmt->bindParam(':prijs', $prijs, PDO::PARAM_STR);
        $stmt->execute();

        echo "Item added successfully!";
    } catch (PDOException $e) {
        echo "Error adding item: " . $e->getMessage();
    }
} else {
    // If the request method is not POST, redirect or display an error message
    echo "Invalid request method.";
}


	
