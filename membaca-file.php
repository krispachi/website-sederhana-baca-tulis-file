<?php

$datas = [];

function baca() {
    $namaFile = $_POST["namaFile"];
    $pathFolder = "aset/file/";

    // Validasi input nama file
    if(empty(trim($namaFile))) {
        echo '<script>
            alert("Saya pikir Anda perlu mengetik nama file");
        </script>';
        return [];
    }
    
    $lokasiFile = $pathFolder . $namaFile . ".txt";

    // Cek apakah file ada
    if(!file_exists($lokasiFile)) {
        echo '<script>
            alert("Yahhh, file tidak ada");
        </script>';
        return [];
    }
    
    $hasil = [];
    if($file = fopen($lokasiFile, "r")) {
        while(!feof($file)) {
            $hasil[] = trim(fgets($file));
        }

        fclose($file);
        return $hasil;
    } else {
        echo '<script>
            alert("Gagal membuka file");
        </script>';
        return [];
    }
}

if(isset($_POST["baca"])) {
    $datas = baca();
    unset($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Membaca File</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: monospace;
        }
        .bapak {
            min-height: 100vh;
            display: grid;
            grid-template-rows: auto 1fr;
        }
        .container {
            display: grid;
            grid-template-columns: auto 1fr;
            height: 100%;
        }

        .header {
            background-color: olivedrab;
            padding: 2rem;
            color: white;
            text-align: center;
        }
        .sidebar {
            background-color: darkslategray;
            padding: 2rem;
        }
        .content {
            padding: 2rem;
        }
        .footer {
            background-color: darkseagreen;
            padding: 2rem;
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .sidebar ul a {
            background-color: teal;
            display: block;
            color: white;
            text-decoration: none;
            font-weight: bolder;
            padding: 1rem 1.8rem;
            border-radius: 1rem;
            text-wrap: nowrap;
        }
        .sidebar ul a:hover {
            background-color: teal;
        }
        .sidebar ul a:active {
            filter: invert();
        }

        .main {
            display: grid;
            grid-template-rows: 1fr auto;
        }
        .active {
            filter: brightness(80%);
        }

        form > * {
            display: block;
            width: 100%;
            padding: 1rem;
        }
        form button {
            margin-top: 2rem;
        }

        .daftar-file {
            margin-top: 2rem;
            background-color: lightsalmon;
            border: 1px solid darkslategray;
            border-radius: 0.6rem;
            padding: 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(16rem, 1fr));
            gap: 1rem;
        }

        .daftar-file > * {
            background-color: lightyellow;
            padding: 1rem;
            border-radius: 0.5rem;
            height: fit-content;
        }

        .daftar-file-label {
            padding-top: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="bapak">
        <div class="header">
            <h2>Krisna no Hikari</h2>
        </div>
        <div class="container">
            <div class="sidebar">
                <ul>
                    <li>
                        <h3>
                            <a href="/">Halaman Utama</a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="menulis-file.php">Menulis File</a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="membaca-file.php" class="active">Membaca File</a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="mengurutkan.php">Mengurutkan</a>
                        </h3>
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="content">
                    <form action="" method="post">
                        <label for="namaFile">Nama File</label>
                        <input type="text" name="namaFile" id="text" placeholder="Nama File">
                        <button type="submit" name="baca">Baca</button>
                        <label for="isiFile">Isi File</label>
                        <textarea name="isiFile" id="isiFile" rows="5" placeholder="Isi File" disabled><?php
                            foreach($datas as $data) {
                                echo $data . "\n";
                            }
                        ?></textarea>
                    </form>

                    <h3 class="daftar-file-label">File yang sudah ada</h3>
                    <div class="daftar-file">
                        <?php
                            if(!file_exists("aset/file/")) {
                                mkdir("aset/file/", 0777, true);
                            }
                            foreach(glob("aset/file/*") as $file) :
                        ?>
                            <p><?= basename(pathinfo($file, PATHINFO_FILENAME)) ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="footer">
                    <h3>Tidak &copy; Copyright</h3>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Saat refresh tidak submit - StackOverflow
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function tinggiTextarea() {
            let textarea = document.getElementById("isiFile");
            textarea.style.height = "";
            textarea.style.height = (textarea.scrollHeight + 2) + "px";
        }
        tinggiTextarea();
    </script>
</body>
</html>