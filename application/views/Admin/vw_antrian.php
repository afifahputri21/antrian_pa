<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800"><?php echo $judul; ?> </h1>
        </div>
        <div class="float-right">
            <h1 class="h3 mb-4 text-gray 800">
                <!-- <a href="<?= base_url('Antrian/tambah2'); ?>" class="btn btn-info mb-2">Tambah Antrian</a> -->
                <!-- <a href="" class="btn btn-info mb-2" data-toggle="modal" data-target="#SearchModal">Tambah Antrian</a> -->
                <!-- <?php foreach ($kapasitas as $kp) : ?>
                     <a href="" class="badge badge-success" data-toggle="modal" data-target=<?= "#EditKapasitas" . $kp['id']; ?>>Edit <?= $kp['kapasitas'] ?></a> -->
                <!-- <a href="" class="btn btn-success mb-2" data-toggle="modal" data-target=<?= "#EditKapasitas" . $kp['id']; ?>>Kapasitas Antrian : <?= $kp['kapasitas'] ?></a>
                <?php endforeach; ?>  -->
            </h1>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
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
                                <td><?= $us['nama_poli']; ?></td>
                                <td><?= $us['status']; ?></td>
                                <td><?= $us['tanggal']; ?></td>
                                <td>
                                    <!-- <a href="<?= base_url('Antrian/panggil/') . $us['id']; ?>" class="badge badge-warning">Panggil</a> -->
                                    <a href="<?= base_url('Antrian/hapus/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>
                                    <!-- <a href="<?= base_url('Pasien/detail/') . $us['id']; ?>" class="badge badge-info">Detail</a> -->
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


<div class="modal fade" id="SearchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pasien</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Antrian/search/') ?>" method="post">
                    <!-- <input type="hidden" name="id" value="<?= $us['id']; ?>"> -->
                    <div class="form-group">
                        <label for="nama">Searching NIK Pasien</label>
                        <input type="text" name="nik" class=" form-control" id="nik" placeholder="NIK Pasien">
                    </div>

                    <button type="submit" id="tambah" name="tambah" class="btn btn-primary float-right">Cari</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
foreach ($kapasitas as $kp) : ?>
    <div class="modal fade" id="EditKapasitas<?php echo $kp['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kapasitas Antrian Hari Ini</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('Antrian/changeKapasitas/' . $kp['id']) ?>" method="post">
                        <input type="hidden" name="id" value="<?= $kp['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Kapasitas Antrian</label>
                            <input type="number" value="<?= $kp['kapasitas']; ?>" name="kapasitas" class="form-control" id="kapasitas" placeholder="Kapasitas Antrian">
                        </div>

                        <button type="submit" id="tambah" name="tambah" class="btn btn-primary float-right">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>