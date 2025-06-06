<div class="content-wrapper">
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Peminjaman Buku
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Peminjaman Buku</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#form-peminjaman" data-toggle="tab">Formulir Peminjaman Buku</a></li>
                        <li><a href="#riwayat-peminjaman" data-toggle="tab">Riwayat Peminjaman Buku</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- Formulir Peminjaman Buku -->
                        <div class="tab-pane active" id="form-peminjaman">
                            <form action="pages/function/Peminjaman.php?aksi=pinjam" method="POST">
                                <!-- Pencarian Nama Anggota -->
                                <div class="form-group">
                                    <label>Nama Anggota</label>
                                    <input type="text" class="form-control" name="namaAnggota" id="searchAnggota" placeholder="Cari nama anggota..." required>
                                    <div id="anggota-suggestions"></div> <!-- Untuk menampilkan suggestion anggota -->
                                </div>

                                <!-- Pencarian Judul Buku -->
                                <div class="form-group">
                                    <label>Judul Buku</label>
                                    <select class="form-control" name="judulBuku" id="judulBuku" required>
                                        <option selected disabled> -- Pilih Buku yang akan dipinjam -- </option>
                                    </select>
                                </div>

                                <!-- Tanggal Peminjaman -->
                                <div class="form-group">
                                    <label>Tanggal Peminjaman</label>
                                    <input type="text" class="form-control" name="tanggalPeminjaman" value="<?= date('d-m-Y'); ?>" readonly required>
                                </div>

                                <!-- Kondisi Buku Saat Dipinjam -->
                                <div class="form-group">
                                    <label>Kondisi Buku Saat Dipinjam</label>
                                    <select class="form-control" name="kondisiBukuSaatDipinjam" required>
                                        <option selected disabled>-- Pilih Kondisi Buku --</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Rusak">Rusak</option>
                                        <option value="Hilang">Hilang</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                                </div>
                            </form>
                        </div>

                        <!-- Riwayat Peminjaman -->
                        <div class="tab-pane" id="riwayat-peminjaman">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Kondisi Buku Saat Dipinjam</th>
                                        <th>Kondisi Buku Saat Dikembalikan</th>
                                        <th>Denda</th>
                                    </tr>
                                </thead>
                                <?php
                                include "../../config/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM peminjaman");
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nama_anggota']; ?></td>
                                            <td><?= $row['judul_buku']; ?></td>
                                            <td><?= $row['tanggal_peminjaman']; ?></td>
                                            <td><?= $row['tanggal_pengembalian']; ?></td>
                                            <td><?= $row['kondisi_buku_saat_dipinjam']; ?></td>
                                            <td><?= $row['kondisi_buku_saat_dikembalikan']; ?></td>
                                            <td><?= $row['denda']; ?></td>
                                        </tr>
                                    </tbody>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery 3 -->
<script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../assets/dist/js/sweetalert.min.js"></script>

<script>
    // Fungsi untuk pencarian nama anggota dan menampilkan suggestion
    $(document).ready(function(){
        $('#searchAnggota').on('input', function() {
            let query = $(this).val();
            if (query.length >= 2) {  // Mulai mencari setelah 2 karakter
                $.ajax({
                    url: "pages/function/searchAnggota.php", // File untuk menangani pencarian anggota
                    method: "GET",
                    data: { query: query },
                    success: function(data) {
                        $('#anggota-suggestions').html(data);
                    }
                });
            } else {
                $('#anggota-suggestions').html('');
            }
        });

        // Pilih anggota dari suggestion dan isikan ke input
        $(document).on('click', '.suggestion', function() {
            let selectedAnggota = $(this).text();
            $('#searchAnggota').val(selectedAnggota);
            // Setelah memilih anggota, tampilkan buku yang bisa dipinjam oleh anggota tersebut
            fetchBukuAvailable(selectedAnggota);
        });

        // Fungsi untuk mengambil judul buku yang tersedia untuk dipinjam oleh anggota yang dipilih
        function fetchBukuAvailable(namaAnggota) {
            $.ajax({
                url: "pages/function/getBukuAvailable.php", // File untuk mendapatkan buku yang tersedia untuk dipinjam oleh anggota
                method: "GET",
                data: { namaAnggota: namaAnggota },
                success: function(data) {
                    $('#judulBuku').html(data);  // Menampilkan hasil ke dropdown judul buku
                }
            });
        }
    });
</script>
