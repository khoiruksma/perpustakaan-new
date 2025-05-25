<div class="content-wrapper">
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Data Peminjaman Buku
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Peminjaman</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Peminjaman Buku</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
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
    </section>
</div>
