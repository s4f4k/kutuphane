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
            <header>
                <nav>
                    <ul>
                        <li><a href="index.html">Anasayfa</a></li>
                        <li><a href="kitaplar.php">Kitaplar</a></li>
                        <li><a href="kitapdüzenle.php">Kitapları Düzenle</a></li>
                        <li><a href="#">Kayıtları Düzenle</a></li>
                    </ul>
                </nav>
            </header>
            <section>
                <a href="add.php" style="float: right; margin: 10px;"><div class="btn btn-primary">Ekle</div></a>
                <div class="search-container">
                    <input type="text" placeholder="Ara..." id="searchInput">
                    <button type="button" onclick="searchText()" id="ara_btn">Ara</button>
                    <a href="kitapdüzenle.php" class="btn btn-primary" id="yenile_btn">Yenile</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Kitap</th>
                            <th>Yazar</th>
                            <th>Yayınevi</th>
                            <th>Tarih</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                        </tr>
                    </thead>
                    <tbody class="table">
                    <?php
                    $sql = "SELECT * FROM test";
                    $res = $conn->query($sql);
                    while($row=$res->fetch_assoc())
                    {
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
                        <td><a href="edit.php?id=<?php echo $id; ?>" class="btn btn-primary">Düzenle</a></td>
                        <td><a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger">Sil</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </section>
            <footer>

            </footer>
        </div>
    </div>

    <script>
        function searchText() {
            document.getElementById("searchInput").style.display = "none";
            document.getElementById("ara_btn").style.visibility = "hidden";
            document.getElementById("yenile_btn").style.visibility = "visible";
            document.getElementById("yenile_btn").style.float = "left";
            var searchText = document.getElementById('searchInput').value.toLowerCase();
            var table = document.querySelector('.table');
            var rows = table.getElementsByTagName('tr');
            var foundRows = []; 

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var cells = row.getElementsByTagName('td');
                if (cells && cells.length > 1) {
                    var kitapadi = cells[1].innerText.toLowerCase();
                    if (kitapadi.includes(searchText)) {
                        foundRows.push(row);
                        cells[0].style.backgroundColor = '#ffff99';
                        cells[1].style.backgroundColor = '#ffff99';
                        cells[2].style.backgroundColor = '#ffff99';
                        cells[3].style.backgroundColor = '#ffff99';
                        cells[4].style.backgroundColor = '#ffff99';
                        cells[5].style.backgroundColor = '#ffff99';
                        cells[6].style.backgroundColor = '#ffff99';
                    }
                }
            }

    if (foundRows.length > 0) {
        //alert('Arama sonucunda ' + foundRows.length + ' satır bulundu.');

        var newTable = document.createElement('table');
        newTable.className = 'table';
        newTable.innerHTML = '<thead><tr><th>NO</th><th>Kitap</th><th>Yazar</th><th>Yayınevi</th><th>Tarih</th></tr></thead><tbody></tbody>';
        
        var newTableBody = newTable.querySelector('tbody');
        for (var j = 0; j < foundRows.length; j++) {
            var newRow = newTableBody.insertRow();
            var cells = foundRows[j].getElementsByTagName('td');
            for (var k = 0; k < cells.length; k++) {
                var newCell = newRow.insertCell();
                newCell.innerHTML = cells[k].innerHTML;
            }
        }

        var searchContainer = document.querySelector('.search-container');
        searchContainer.appendChild(newTable);
    } else {
        alert('Metin bulunamadı.');
    }
}

    </script>
</body>
</html>
