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
    <div class="container">
        <div class="col-md-6">
            <h1>Ekle</h1>
            <form id="ekleForm" action="" method="post">
                <table class="table">
                    <tr>
                        <td>Id</td>
                        <td>
                            <input type="checkbox" id="idCheck" name="id_check" value="1" checked> Otomatik ID Oluştur
                            <br>
                            <input type="text" id="idText" name="id_t" class="form-control" placeholder="ID Giriniz" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </td>
                    </tr>
                    <tr>
                        <td>Kitap Adı</td>
                        <td><textarea name="kitapadi_t" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td>Yazar Adı</td>
                        <td><textarea name="yazaradi_t" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td>Yayınevi</td>
                        <td><textarea name="yayinevi_t" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td>Tarih</td>
                        <td><textarea name="tarih_t" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input class="btn btn-primary" type="submit" value="Ekle"><a href="kitapdüzenle.php" style="float: right;"><div class="btn btn-danger">Geri Dön</div></a></td>
                    </tr>
                </table>
            </form>

            <script>
                document.getElementById("idCheck").addEventListener("change", function() {
                    var idText = document.getElementById("idText");
                    idText.disabled = this.checked;
                    if (this.checked) {
                        idText.value = "";
                    }
                });

            </script>

            <?php

            if ($_POST) {
                if (isset($_POST['id_check']) && $_POST['id_check'] == '1') {
                    $id = ''; 
                } else {
                    $id = $_POST['id_t'];
                }

                $kitapadi = $_POST['kitapadi_t'];
                $yazaradi = $_POST['yazaradi_t'];
                $yayinevi = $_POST['yayinevi_t'];
                $tarih = $_POST['tarih_t'];

                if ($kitapadi != "") {
                    if ($id === "") {
                       
                        $sql = "INSERT INTO test (kitapadi, yayinevi, yazaradi, tarih) VALUES ('$kitapadi','$yayinevi','$yazaradi','$tarih')";
                    } else {
                        $sql = "INSERT INTO test (id, kitapadi, yayinevi, yazaradi, tarih) VALUES ('$id','$kitapadi','$yayinevi','$yazaradi','$tarih')";
                    }

                    if ($conn->query($sql)) {
                        echo "Veri Eklendi";
                    } else {
                        echo "Hata oluştu: " . $conn->error;
                    }
                } else {
                    echo "Kitap adı boş bırakılamaz.";
                }
            }

            ?>
        </div>

        <div class="col-md-7">
            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kitap</th>
                        <th>Yazar</th>
                        <th>Yayınevi</th>
                        <th>Tarih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM test";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()) {
                        $id = $row["id"];
                        $kitapadi = $row["kitapadi"];
                        $yazaradi = $row["yazaradi"];
                        $yayinevi = $row["yayinevi"];
                        $tarih = $row["tarih"];
                    ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $kitapadi; ?></td>
                            <td><?php echo $yazaradi; ?></td>
                            <td><?php echo $yayinevi; ?></td>
                            <td><?php echo $tarih; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
