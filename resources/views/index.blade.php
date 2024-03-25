<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pasien</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Daftar Pasien</h1>
        <button class="btn btn-primary mb-3" onclick="tambahPasien()">Tambah Pasien</button> <!-- Tombol tambah pasien -->

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No_hp</th>
                    <th>Jk</th>
                    <th>Nik</th>
                    <th>No_RM</th>
                    <th>Tgl_lahir</th>
                    <th>Tempat_lahir</th>
                    <th>Gol_darah</th>
                    <th>Tinggi</th>
                    <th>Berat</th>
                    <th>Kontak_keluarga</th>
                    <th>kontak_keluarga_hp</th>
                    <th>kontak_keluarga_alamat</th>
                    <th>Aksi</th> <!-- Kolom untuk tombol aksi -->
                </tr>
            </thead>
            <tbody id="outputTabel">
                <!-- Data pasien akan ditambahkan di sini -->
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        function getPasien() {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost/silk2024-slim-main/public/pasien');
            xhr.send();

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    let responseData = JSON.parse(xhr.responseText);
                    let tbody = document.querySelector("#outputTabel");

                    // Bersihkan isi tbody sebelum menambahkan data baru
                    tbody.innerHTML = "";

                    // Loop melalui data dan tambahkan baris-baris baru ke dalam tabel
                    responseData.forEach(function(data) {
                        let row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${data.id}</td>
                            <td>${data.nama}</td>
                            <td>${data.alamat}</td>
                            <td>${data.no_hp}</td>
                            <td>${data.jk}</td>
                            <td>${data.nik}</td>
                            <td>${data.no_rm}</td>
                            <td>${data.tgl_lahir}</td>
                            <td>${data.tempat_lahir}</td>
                            <td>${data.gol_darah}</td>
                            <td>${data.tinggi}</td>
                            <td>${data.berat}</td>
                            <td>${data.kontak_keluarga}</td>
                            <td>${data.kontak_keluarga_hp}</td>
                            <td>${data.kontak_keluarga_alamat}</td>
                            <td>
                                <button class="btn btn-primary" onclick="updatePasien(${data.id})">Update</button>
                                <button class="btn btn-danger" onclick="hapusPasien(${data.id})">Delete</button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    alert("Error " + xhr.status + ": " + xhr.statusText);
                }
            };

            xhr.onerror = function() {
                alert("Request failed");
            };
        }

        function updatePasien(id) {
            // Fungsi untuk menghandle update pasien
        }

        function hapusPasien(id) {
            // Fungsi untuk menghandle hapus pasien
        }

        function tambahPasien() {
            window.location.href = "formtambah.html; // Mengarahkan ke halaman form tambah pasien"
        }

        window.onload = getPasien;
    </script>
</body>
</html>
