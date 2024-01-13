<?php

function tulis() {
    $namaFile = $_POST["namaFile"];
    $isiFile = $_POST["isiFile"];
    $pathFolder = "aset/file/";

    // Validasi nama dan isi file
    if(empty(trim($namaFile))) {
        echo '<script>
            alert("Nama file diperlukan");
        </script>';
        return;
    }
    if(empty(trim($isiFile))) {
        echo '<script>
            alert("File sebaiknya memiliki isi");
        </script>';
        return;
    }

    // Buat path folder jika belum ada
    if(!file_exists($pathFolder)) {
        mkdir($pathFolder, 0777, true);
    }

    $lokasiFile = $pathFolder . $namaFile . ".txt";

    // Cek apakah file sudah ada
    if(file_exists($lokasiFile)) {
        echo '<script>
            alert("Waduh, Nama File sudah tersedia, coba Nama File yang lain");
        </script>';
        return;
    }

    // Write jika file belum ada
    if($file = fopen($lokasiFile, "x")) {
        fwrite($file, $isiFile);

        fclose($file);

        echo '<script>
            alert("Berhasil menambah file");
        </script>';
        return;
    } else {
        echo '<script>
            alert("Gagal menambah file");
        </script>';
        return;
    }
}

if(isset($_POST["tulis"])) {
    tulis();
    unset($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Menulis File</title>
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
            display: grid;
            grid-template-rows: auto auto 1fr;
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
                            <a href="menulis-file.php" class="active">Menulis File</a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="membaca-file.php">Membaca File</a>
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
                        <label for="isiFile">Isi File</label>
                        <textarea name="isiFile" id="isiFile" rows="5" placeholder="Isi File"></textarea>
                        <button type="submit" name="tulis">Tambah</button>
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
    </script>
</body>
</html>