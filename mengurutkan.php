<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Mengurutkan Angka</title>
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

        .form {
            margin-top: 1rem;
        }
        .form > * {
            display: block;
            width: 100%;
            padding: 1rem;
        }
        .form button {
            margin-top: 2rem;
        }

        .pesan {
            margin: 1rem 0;
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
                            <a href="membaca-file.php">Membaca File</a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="mengurutkan.php" class="active">Mengurutkan</a>
                        </h3>
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="content">
                    <p>Tambah (Enter)</p>
                    <p>Hapus (Shift + Backspace)</p>
                    <p>Urutkan - Kecil ke Besar (Shift + Enter)</p>
                    <p>Urutkan - Besar ke Kecil (Alt + Shift + Enter)</p>

                    <div class="form">
                        <label for="input-angka"><h4>Input Angka</h4></label>
                        <input type="number" id="input-angka" autofocus>
                        <button id="tombol-tambah">Tambah</button>
                        <button id="tombol-hapus">Hapus</button>
                        <button id="tombol-urutkan">Urutkan - Kecil ke Besar</button>
                        <button id="tombol-urutkan-terbalik">Urutkan - Besar ke Kecil</button>
                    </div>
                    
                    <div class="pesan">
                        <p id="kandidat"></p>
                        <p id="sailor"></p>
                    </div>
                </div>
                <div class="footer">
                    <h3>Tidak &copy; Copyright</h3>
                </div>
            </div>
        </div>
    </div>

    <script>
        let angka = [];
        let angkaUrut = [];
        
        function perbaruiKandidat() {
            document.getElementById("kandidat").innerText = (angka.length != 0 ? "Angka Input: " + angka.join(", ") : "");
        }
        
        function perbaruiSailor(terurut = true) {
            let pesan;
            if(terurut) {
                pesan = "Angka Urut (Kecil ke Besar): ";
            } else {
                pesan = "Angka Urut (Besar ke Kecil): ";
            }
            document.getElementById("sailor").innerText = (angkaUrut.length != 0 ? pesan + angkaUrut.join(", ") : "");
        }
        
        document.getElementById("tombol-tambah").addEventListener("click", function() {
            let inputAngka = parseFloat(document.getElementById("input-angka").value || 0);
            inputAngka = inputAngka > 0 ? inputAngka : 0;
            angka.push(inputAngka || 0);
            document.getElementById("input-angka").value = "";
            document.getElementById("input-angka").focus();
            perbaruiKandidat();
        });
        
        document.getElementById("tombol-hapus").addEventListener("click", function() {
            angka.pop();
            perbaruiKandidat();
        });

        document.getElementById("input-angka").addEventListener("keydown", function() {
            if(event.shiftKey && event.keyCode === 8) {
                document.getElementById("tombol-hapus").click();
            } else if(event.altKey && event.shiftKey && event.which === 13) {
                document.getElementById("tombol-urutkan-terbalik").click();
            } else if(event.shiftKey && event.which === 13) {
                document.getElementById("tombol-urutkan").click();
            } else if(event.which === 13) {
                document.getElementById("tombol-tambah").click();
            }
        });
        
        document.getElementById("tombol-urutkan").addEventListener("click", function() {
            angkaUrut = angka.slice();
            
            for(let i = 0; i < angkaUrut.length; i++) {
                for(let j = 0; j < (angkaUrut.length - i - 1); j++) {
                    if(angkaUrut[j] > angkaUrut[j + 1]) {
                        let sementara = angkaUrut[j];
                        angkaUrut[j] = angkaUrut[j + 1];
                        angkaUrut[j + 1] = sementara;
                    }
                }
            }
            
            perbaruiSailor();
        });
        
        document.getElementById("tombol-urutkan-terbalik").addEventListener("click", function() {
            angkaUrut = angka.slice();
            
            for(let i = 0; i < angkaUrut.length; i++) {
                for(let j = 0; j < (angkaUrut.length - i - 1); j++) {
                    if(angkaUrut[j] < angkaUrut[j + 1]) {
                        let sementara = angkaUrut[j];
                        angkaUrut[j] = angkaUrut[j + 1];
                        angkaUrut[j + 1] = sementara;
                    }
                }
            }
            
            perbaruiSailor(false);
        });
	</script>
</body>
</html>