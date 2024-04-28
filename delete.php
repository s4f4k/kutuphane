<?php
if ($_GET && isset($_GET['id'])) {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "kutuphane";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM test WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();

        header("location: kitapdüzenle.php"); 
        exit();
    } catch (PDOException $e) {
        echo "Bağlantı hatası: " . $e->getMessage();
    }
}
?>
