<?php
// Memasukkan koneksi ke database
include "../../config/koneksi.php";

// Query untuk mengambil data buku yang sedang dipinjam
$query = "
    SELECT p.id_peminjaman, p.nama_anggota, p.judul_buku, p.tanggal_peminjaman, p.tanggal_pengembalian, p.kondisi_buku_saat_dipinjam, p.kondisi_buku_saat_dikembalikan, p.denda, 
           b.judul_buku AS judul_buku_detail, b.penerbit_buku, b.pengarang, b.tahun_terbit
    FROM peminjaman p
    INNER JOIN buku b ON p.judul_buku = b.judul_buku
    WHERE p.tanggal_pengembalian = ''
    ORDER BY p.tanggal_peminjaman DESC
";

// Menjalankan query
$result = mysqli_query($koneksi, $query);

// Mengecek apakah ada hasil
if (mysqli_num_rows($result) > 0) {
    // Membuat array untuk menyimpan hasil
    $bukuDipinjam = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $bukuDipinjam[] = $row;
    }

    // Menampilkan data dalam format JSON
    echo json_encode($bukuDipinjam);
} else {
    // Jika tidak ada data buku yang sedang dipinjam
    echo json_encode(array('message' => 'Tidak ada buku yang sedang dipinjam.'));
}

// Menutup koneksi database
mysqli_close($koneksi);
?>
