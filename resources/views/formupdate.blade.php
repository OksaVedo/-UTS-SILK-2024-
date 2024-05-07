<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update Pasien</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Form Update Pasien</h1>
        <form id="formUpdatePasien">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="no_hp">Nomor HP:</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp">
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin:</label>
                <select class="form-control" id="jk" name="jk" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" class="form-control" id="nik" name="nik" required>
            </div>
            <div class="form-group">
                <label for="no_rm">Nomor Rekam Medis:</label>
                <input type="text" class="form-control" id="no_rm" name="no_rm">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir:</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
            </div>
            <div class="form-group">
                <label for="gol_darah">Golongan Darah:</label>
                <input type="text" class="form-control" id="gol_darah" name="gol_darah">
            </div>
            <div class="form-group">
                <label for="tinggi">Tinggi:</label>
                <input type="text" class="form-control" id="tinggi" name="tinggi">
            </div>
            <div class="form-group">
                <label for="berat">Berat:</label>
                <input type="text" class="form-control" id="berat" name="berat">
            </div>
            <div class="form-group">
                <label for="kontak_keluarga">Kontak_keluarga:</label>
                <input type="text" class="form-control" id="kontak_keluarga" name="kontak_keluarga">
            </div>
            <div class="form-group">
                <label for="kontak_keluarga_hp">Kontak_keluarga_hp:</label>
                <input type="text" class="form-control" id="kontak_keluarga_hp" name="kontak_keluarga_hp">
            </div>
            <div class="form-group">
                <label for="kontak_keluarga_alamat">Kontak_keluarga_alamat:</label>
                <input type="text" class="form-control" id="kontak_keluarga_alamat" name="kontak_keluarga_alamat">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        // Fungsi untuk mendapatkan data pasien yang akan diedit dan mengisi formulir dengan data tersebut
        function loadDataPasien() {
            let pasienId = window.location.pathname.split('/').pop();

            let xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost/silk2024-slim-main/public/pasien/${pasienId}`);
            xhr.send();

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    let responseData = JSON.parse(xhr.responseText);

                    // Mengisi formulir dengan data pasien
                    document.getElementById('nama').value = responseData.nama;
                    document.getElementById('alamat').value = responseData.alamat;
                    document.getElementById('no_hp').value = responseData.no_hp;
                    document.getElementById('jk').value = responseData.jk;
                    document.getElementById('nik').value = responseData.nik;
                    document.getElementById('no_rm').value = responseData.no_rm;
                    document.getElementById('tgl_lahir').value = responseData.tgl_lahir;
                    document.getElementById('tempat_lahir').value = responseData.tempat_lahir;
                    document.getElementById('gol_darah').value = responseData.gol_darah;
                    document.getElementById('tinggi').value = responseData.tinggi;
                    document.getElementById('berat').value = responseData.berat;
                    document.getElementById('kontak_keluarga').value = responseData.kontak_keluarga;
                    document.getElementById('kontak_keluarga_hp').value = responseData.kontak_keluarga_hp;
                    document.getElementById('kontak_keluarga_alamat').value = responseData.kontak_keluarga_alamat;
                } else {
                    alert('Gagal memuat data pasien. Mohon coba lagi.');
                }
            };

            xhr.onerror = function() {
                alert('Request gagal.');
            };
        }

        // Fungsi untuk mengirimkan data yang diperbarui ke server saat formulir disubmit
        function updateDataPasien() {
            let pasienId = window.location.pathname.split('/').pop();
            let formData = new FormData(document.getElementById('formUpdatePasien'));

            let updateXhr = new XMLHttpRequest();
            updateXhr.open('PUT', `http://localhost/silk2024-slim-main/public/pasien/${pasienId}`);
            updateXhr.send(formData);

            updateXhr.onload = function() {
                if (updateXhr.status >= 200 && updateXhr.status < 300) {
                    alert('Data pasien berhasil diperbarui!');
                    // Redirect ke halaman daftar pasien setelah berhasil memperbarui
                    window.location.href = 'http://localhost/silk2024-slim-main/public/pasien';
                } else {
                    alert('Terjadi kesalahan. Mohon coba lagi.');
                }
            };

            updateXhr.onerror = function() {
                alert('Request gagal.');
            };
        }

        // Fungsi untuk memuat data pasien saat halaman dimuat
        window.onload = function() {
            loadDataPasien();

            document.getElementById('formUpdatePasien').addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form dari pengiriman default
                updateDataPasien();
            });
        };
    </script>
</body>
</html>
