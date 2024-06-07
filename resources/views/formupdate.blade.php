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
                <input type="text" class="form-control" id="no_rm" name="no_rm" required>
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
                <label for="kontak_keluarga">Kontak Keluarga:</label>
                <input type="text" class="form-control" id="kontak_keluarga" name="kontak_keluarga">
            </div>
            <div class="form-group">
                <label for="kontak_keluarga_hp">Kontak Keluarga HP:</label>
                <input type="text" class="form-control" id="kontak_keluarga_hp" name="kontak_keluarga_hp">
            </div>
            <div class="form-group">
                <label for="kontak_keluarga_alamat">Kontak Keluarga Alamat:</label>
                <input type="text" class="form-control" id="kontak_keluarga_alamat" name="kontak_keluarga_alamat">
            </div>

            <button class="btn btn-primary" onclick="updateDataPasien(event)">Submit</button>
        </form>
    </div>

    <script>
        function loadDataPasien() {
            let pasienId = window.location.pathname.split('/').pop();

            fetch(`http://localhost/silk2024-slim/public/pasien/${pasienId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(responseData => {
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
                })
                .catch(error => alert('Gagal memuat data pasien. Mohon coba lagi. ' + error.message));
        }

        function updateDataPasien(event, retryCount = 0) {
    event.preventDefault();
    
    let pasienId = window.location.pathname.split('/').pop();
    
    let data = {
        nama: document.getElementById('nama').value,
        alamat: document.getElementById('alamat').value,
        no_hp: document.getElementById('no_hp').value,
        jk: document.getElementById('jk').value,
        nik: document.getElementById('nik').value,
        no_rm: document.getElementById('no_rm').value,
        tgl_lahir: document.getElementById('tgl_lahir').value,
        tempat_lahir: document.getElementById('tempat_lahir').value,
        gol_darah: document.getElementById('gol_darah').value,
        tinggi: document.getElementById('tinggi').value,
        berat: document.getElementById('berat').value,
        kontak_keluarga: document.getElementById('kontak_keluarga').value,
        kontak_keluarga_hp: document.getElementById('kontak_keluarga_hp').value,
        kontak_keluarga_alamat: document.getElementById('kontak_keluarga_alamat').value
    };

    let params = new URLSearchParams();
    for (let key in data) {
        if (data.hasOwnProperty(key)) {
            params.append(key, data[key]);
        }
    }

    console.log('Request URL:', `http://localhost/silk2024-slim/public/update_pasien/${pasienId}`);
    console.log('Request Params:', params.toString());

    fetch(`http://localhost/silk2024-slim/public/update_pasien/${pasienId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: params
    })
    .then(response => {
        console.log('Response Status:', response.status);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(responseData => {
        console.log('Response Data:', responseData);
        if (responseData.status === 'berhasil') {
            alert('Data pasien berhasil diperbarui!');
            window.location.href = 'index.php';
        } else {
            throw new Error('Terjadi kesalahan. Mohon coba lagi.');
        }
    })
    .catch(error => {
        console.error('Request gagal:', error);
        alert('Request gagal. ' + error.message);

        // Retry the request if it fails and the retry count is less than a maximum value
        if (retryCount < 3) {
            console.log(`Retrying... attempt #${retryCount + 1}`);
            updateDataPasien(event, retryCount + 1);
        } else {
            alert('Request gagal setelah beberapa percobaan. Mohon coba lagi nanti.');
        }
    });
}

        window.onload = function() {
            loadDataPasien();
            document.getElementById('formUpdatePasien').addEventListener('submit', updateDataPasien);
        };
    </script>
</body>
</html>
