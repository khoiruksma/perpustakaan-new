<div class="content-wrapper">
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Pengembalian Buku
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pengembalian Buku</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#form-pengembalian" data-toggle="tab">Formulir Pengembalian Buku</a></li>
                        <li><a href="#riwayat-pengembalian" data-toggle="tab">Riwayat Pengembalian Buku</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- Formulir Pengembalian Buku -->
                        <div class="tab-pane active" id="form-pengembalian">
                            <form action="pages/function/Peminjaman.php?aksi=pengembalian" method="POST">
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
                                        <option selected disabled> -- Pilih Buku yang akan dikembalikan -- </option>
                                    </select>
                                </div>

                                <!-- Tanggal Pengembalian -->
                                <div class="form-group">
                                    <label>Tanggal Pengembalian</label>
                                    <input type="text" class="form-control" name="tanggalPengembalian" value="<?= date('d-m-Y'); ?>" readonly required>
                                </div>

                                <!-- Kondisi Buku Saat Dikembalikan -->
                                <div class="form-group">
                                    <label>Kondisi Buku Saat Dikembalikan</label>
                                    <select class="form-control" name="kondisiBukuSaatDikembalikan" required>
                                        <option selected disabled>-- Pilih Kondisi Buku --</option>
                                        <option value="Baik">Baik (Tidak ada denda)</option>
                                        <option value="Rusak">Rusak (Denda 20.000)</option>
                                        <option value="Hilang">Hilang (Denda 50.000)</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                                </div>
                            </form>
                        </div>

                        <!-- Riwayat Pengembalian -->
                        <div class="tab-pane" id="riwayat-pengembalian">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Kondisi Buku Saat Dikembalikan</th>
                                        <th>Denda</th>
                                    </tr>
                                </thead>
                                <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM peminjaman");
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nama_anggota']; ?></td>
                                            <td><?= $row['judul_buku']; ?></td>
                                            <td><?= $row['tanggal_pengembalian']; ?></td>
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
            // Setelah memilih anggota, tampilkan buku yang dipinjam oleh anggota tersebut
            fetchBukuDipinjam(selectedAnggota);
        });

        // Fungsi untuk mengambil judul buku yang dipinjam oleh anggota yang dipilih
        function fetchBukuDipinjam(namaAnggota) {
            $.ajax({
                url: "admin/pages/function/getBukuDipinjam.php", // File untuk mendapatkan buku yang dipinjam oleh anggota
                method: "GET",
                data: { namaAnggota: namaAnggota },
                success: function(data) {
                    $('#judulBuku').html(data);  // Menampilkan hasil ke dropdown judul buku
                }
            });
        }
    });
</script>
