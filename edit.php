<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kutuphane";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
} else {
    //echo "Bağlantı başarılı!";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekle</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<?php 

$sorgu = $conn->query("SELECT * FROM test WHERE id =".(int)$_GET['id']); //id değeri ile düzenlenecek verileri veritabanından alacak sorgu
$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>
    <div class="container">
        <div class="col-md-6">
            <h1>Ekle</h1>
            <form id="ekleForm" action="" method="post">
                <table class="table">
                    <tr>
                        <td>İd</td>
                        <td><?php echo $sonuc['id']; ?></td>
                    </tr>
                    <tr>
                        <td>Kitap Adı</td>
                        <td><textarea name="kitapadi_t" class="form-control"><?php echo $sonuc['kitapadi']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Yazar Adı</td>
                        <td><textarea name="yazaradi_t" class="form-control"><?php echo $sonuc['yazaradi']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Yayınevi</td>
                        <td><textarea name="yayinevi_t" class="form-control"><?php echo $sonuc['yayinevi']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Tarih</td>
                        <td><textarea name="tarih_t" class="form-control"><?php echo $sonuc['tarih']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
			            <td><input type="submit" class="btn btn-primary" value="Kaydet"></td>
                    </tr>
                </table>
            </form>

<?php

if ($_POST) {
    //$id = $_POST['id_t'];
    $kitapadi = $_POST['kitapadi_t'];
    $yazaradi = $_POST['yazaradi_t'];
    $yayinevi = $_POST['yayinevi_t'];
    $tarih = $_POST['tarih_t'];

    if ($kitapadi<>"") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
		
		if ($conn->query("UPDATE test SET/* id_t = '$id',*/ kitapadi = '$kitapadi', yazaradi = '$yazaradi', yayinevi = '$yayinevi', tarih = '$tarih' WHERE id =".$_GET['id'])) // Veri güncelleme sorgumuzu yazıyoruz.
		{
			header("location:kitapdüzenle.php"); // Eğer güncelleme sorgusu çalıştıysa ekle.php sayfasına yönlendiriyoruz.
		}
		else
		{
			echo "Hata oluştu"; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
		}
    }
}
?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>