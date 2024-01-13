<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Anu</title>
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
            display: flex;
            flex-direction: column;
            gap: 2rem;
            align-items: center;
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
                            <a href="/" class="active">Halaman Utama</a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="menulis-file.php">Menulis File</a>
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
                    <p>Video Anime - Aria the Natural</p>
                    <video autoplay loop muted height="300">
                        <source src="aset/video/Awan.mp4" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                </div>
                <div class="footer">
                    <h3>Tidak &copy; Copyright</h3>
                </div>
            </div>
        </div>
    </div>
</body>
</html>