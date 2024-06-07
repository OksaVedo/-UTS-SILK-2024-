<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pasien</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th, td {
          padding: 5px;
        }
        th {
          text-align: left;
        }
</style>
</head>
<body>
    {{-- <div class="container"> --}}
        <h1>Daftar Pasien</h1>
        <button class="btn btn-primary mb-3" onclick="tambahPasien()">Tambah Pasien</button> <!-- Tombol tambah pasien -->
        <button class="btn btn-success mb-3" onclick="tampilAntrian()">Antri Pasien</button> <!-- Tombol antrian pasien -->

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
    {{-- </div> --}}

    <script>
        function getPasien() {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost/silk2024-slim/public/pasien');
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
                                <button class="btn btn-primary" onclick="updatePasien('${data.no_rm}')">Update</button>
                                <button class="btn btn-danger " onclick="deleteData('${data.id}')"">Hapus</button>
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
    
        function updatePasien(no_rm) {
            // Mengarahkan ke halaman update dengan parameter no_rm
            window.location.href = "/update/" + no_rm;
        }

        document.addEventListener('DOMContentLoaded', function() {
    // Dapatkan semua tombol hapus
    const deleteButtons = document.querySelectorAll('.hapusPasien');

    // Tambahkan event listener ke setiap tombol hapus
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Dapatkan id pasien dari atribut data-id pada tombol hapus
            const pasienId = this.dataset.id;

            // Konfirmasi penghapusan
            if (confirm(`Apakah Anda yakin ingin menghapus pasien dengan ID ${pasienId}?`)) {
                deleteData(pasienId);
            }
        });
    });
});


        // Fungsi untuk menghapus data
        function deleteData(pasienId) {
            fetch(`http://localhost/silk2024-slim/public/delete_pasien/${pasienId}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(responseData => {
                if (responseData.status === 'berhasil') {
                    alert('Data pasien berhasil dihapus!');
                    window.location.href = 'index.php';
                } else {
                    throw new Error('Terjadi kesalahan. Mohon coba lagi.');
                }
            })
            .catch(error => {
                console.error('Request gagal:', error);
                alert('Request gagal. ' + error.message);
            });
        }

        function tambahPasien() {
            // Mengarahkan ke halaman form tambah pasien
            window.location.href = "/tambah";
        }

        function tampilAntrian() {
            window.location.href = "/antri"; // Mengarahkan ke halaman antrian pasien
        }
        // Memanggil getPasien saat halaman dimuat
        window.onload = getPasien;
    </script>    
</body>
</html>
