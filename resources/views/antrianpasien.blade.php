<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Antrian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .nomor-antrian {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .nomor-antrian-text {
            font-size: 50px;
            font-weight: bold;
        }
        .id-rm-text {
            font-size: 20px;
            margin-top: 10px;
            font-weight: normal;
        }
        .btn-back {
            display: block;
            margin-top: 20px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="nomor-antrian">
            <h2>Nomor Antrian Anda</h2>
            <div id="nomorAntrianText" class="nomor-antrian-text"></div>
            <div id="idRMText" class="id-rm-text"></div>
            <a href="/" class="btn btn-primary btn-back">Kembali</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let nomorAntrianText = document.getElementById('nomorAntrianText');
            let idRMText = document.getElementById('idRMText');

            // Fetch the last record from rekam_medis
            fetch('http://localhost/silk2024-slim/public/rekam_medis/latest')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(responseData => {
                    if (responseData.id_rm) {
                        nomorAntrianText.innerText = responseData.id_rm;
                        idRMText.innerText = ''; // Clear the idRMText element
                    } else {
                        nomorAntrianText.innerText = 'Tidak ada data';
                        idRMText.innerText = 'Tidak ada ID Rekam Medis';
                    }
                })
                .catch(error => {
                    console.error('Request gagal:', error);
                    nomorAntrianText.innerText = 'Error';
                    idRMText.innerText = 'Gagal mengambil data ID Rekam Medis';
                });
        });
    </script>
</body>
</html>