<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antri Pasien</title>
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
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        button[type="submit"] {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Antri Pasien</h2>
        <form id="formAntri">
             <div class="form-group">
                <label for="idPasien">Pilih Pasien:</label>
                <select class="form-control" id="idPasien" name="idPasien" required>
                    <!-- Options will be populated through JavaScript -->
                </select>
            </div>
            <div class="form-group">
                <label for="tensi">Tensi:</label>
                <input type="text" class="form-control" id="tensi" name="tensi" required placeholder="Masukkan tensi pasien">
            </div>
            <button type="button" class="btn btn-success" onclick="submitForm()">Antri</button>
        </form>
    </div>

    <script>
        function getPasien() {
            fetch('http://localhost/silk2024-slim/public/pasien')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(responseData => {
                    let select = document.querySelector("#idPasien");
                    select.innerHTML = "";

                    responseData.forEach(function(data) {
                        let option = document.createElement("option");
                        option.value = data.no_rm;
                        option.text = `No RM: ${data.no_rm}`;
                        select.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Request gagal:', error);
                    alert('Gagal mengambil data pasien. ' + error.message);
                });
        }

        function submitForm() {
            const no_rm = document.getElementById('idPasien').value;
            const tensi = document.getElementById('tensi').value;

            console.log('Mengirim data:', { no_rm, tensi });

            fetch('http://localhost/silk2024-slim/public/antri', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ no_rm, tensi })
            })
            .then(response => {
                console.log('Respons diterima:', response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(responseData => {
                console.log('Data respons:', responseData);
                if (responseData.status === 'berhasil') {
                    alert('Pasien berhasil masuk antrian!');
                    document.getElementById('formAntri').reset();
                    window.location.href = "/antrianpasien";

                } else {
                    throw new Error('Gagal memasukkan pasien ke antrian.');
                }
            })
            .catch(error => {
                console.error('Request gagal:', error);
                alert('Gagal memasukkan pasien ke antrian. ' + error.message);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            getPasien(); // Panggil fungsi getPasien saat halaman dimuat
        });

        // function tampilNoantrian() {
        //     window.location.href = "/antrianpasien"; // Mengarahkan ke halaman antrian pasien
        // }
    </script>
</body>
</html>