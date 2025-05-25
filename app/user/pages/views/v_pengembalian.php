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
                        <li class="active"><a href="#riwayat-pengembalian" data-toggle="tab">Riwayat Pengembalian Buku</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- Riwayat Pengembalian -->
                        <div class="tab-pane active" id="riwayat-pengembalian">
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
                                include "../../config/koneksi.php";
                                $no = 1;
                                $fullname = $_SESSION['fullname'];
                                $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE nama_anggota = '$fullname'");
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
                        <li class="active"><a href="#riwayat-pengembalian" data-toggle="tab">Riwayat Pengembalian Buku</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- Riwayat Pengembalian -->
                        <div class="tab-pane active" id="riwayat-pengembalian">
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
                                <tbody>
                                    <?php
                                    include "../../config/koneksi.php";
                                    $no = 1;
                                    $fullname = $_SESSION['fullname'];
                                    $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE nama_anggota = '$fullname'");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nama_anggota']; ?></td>
                                            <td><?= $row['judul_buku']; ?></td>
                                            <td><?= $row['tanggal_pengembalian']; ?></td>
                                            <td><?= $row['kondisi_buku_saat_dikembalikan']; ?></td>
                                            <td><?= $row['denda']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>