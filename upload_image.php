<?php
// Koneksi ke database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menerima data dari aplikasi Android
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_POST['image'];

    // Decode base64 string menjadi binary data
    $binaryImage = base64_decode($image);

    // Simpan binary data ke database sebagai blob
    $stmt = $conn->prepare("INSERT INTO images (image_data) VALUES (?)");
    $stmt->bind_param("b", $binaryImage);

    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image.";
    }

    $stmt->close();
}

$conn->close();
?>
