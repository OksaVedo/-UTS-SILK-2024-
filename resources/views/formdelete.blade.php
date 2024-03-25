<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Pasien</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Hapus Pasien</h1>
        <form id="formHapusPasien">
            <div class="form-group">
                <label for="id">ID Pasien:</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </div>

    <script type="text/javascript">
        document.getElementById('formHapusPasien').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form dari pengiriman default

            // Mengambil data ID pasien dari formulir
            let idPasien = document.getElementById('id').value;

            // Kirim permintaan DELETE ke server menggunakan AJAX
            let xhr = new XMLHttpRequest();
            xhr.open('DELETE', 'http://localhost/silk2024-slim-main/public/pasien/' + idPasien);
            xhr.send();

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    alert('Pasien berhasil dihapus!');
                    // Redirect atau lakukan tindakan lain setelah berhasil menghapus pasien
                } else {
                    alert('Terjadi kesalahan. Mohon coba lagi.');
                }
            };

            xhr.onerror = function() {
                alert('Request failed');
            };
        });
    </script>
</body>
</html>
