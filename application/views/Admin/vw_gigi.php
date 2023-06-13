<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800"><?php echo $judul; ?> </h1>
        </div>
        <div class="float-right">
            <!-- <h1 class="h3 mb-4 text-gray 800">
                <a href="<?= base_url('Antrian/tambah1'); ?>" class="btn btn-info mb-2">Tambah Antrian</a>
            </h1> -->
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <strong> ANTRIAN DIPROSES </strong>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>No Antrian</td>
                            <td>Poliknik</td>
                            <td>Status</td>
                            <td>Tanggal</td>
                            <!-- <td>Alamat</td> -->
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($antrian2 as $us) : ?>
                            <tr>
                                <td> <?= $i; ?>.</td>
                                <td><?= $us['nama']; ?></td>
                                <td><?= $us['no_antrian']; ?></td>
                                <td><?= $us['id_poli']; ?></td>
                                <td><?= $us['status']; ?></td>
                                <td><?= $us['tanggal']; ?></td>
                                <td>
                                    <!-- <a href="<?= base_url('Antrian/panggil/') . $us['id']; ?>" class="badge badge-warning">Panggil</a> -->
                                    <a href="<?= base_url('Admin/hapusumum/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>
                                    <a href="<?= base_url('Admin/detailgigi/') . $us['id']; ?>" class="badge badge-info">Detail</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>No Antrian</td>
                            <td>Poliknik</td>
                            <td>Status</td>
                            <td>Tanggal</td>
                            <!-- <td>Alamat</td> -->
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($antrian as $us) : ?>
                            <tr>
                                <td> <?= $i; ?>.</td>
                                <td><?= $us['nama']; ?></td>
                                <td><?= $us['no_antrian']; ?></td>
                                <td><?= $us['id_poli']; ?></td>
                                <td><?= $us['status']; ?></td>
                                <td><?= $us['tanggal']; ?></td>
                                <td>
                                    <a href="<?= base_url('Admin/panggil_gigi/') . $us['id']; ?>" class="badge badge-warning">Panggil</a>
                                    <a href="<?= base_url('Admin/hapusgigi/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>
                                    <a href="<?= base_url('Admin/detail/') . $us['id']; ?>" class="badge badge-info">Detail</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>