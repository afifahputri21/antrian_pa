<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800"><?php echo $judul; ?> </h1>
        </div>
        <!-- <div class="float-right">
            <h1 class="h3 mb-4 text-gray 800">
                <a href="<?= base_url('RM/tambah'); ?>" class="btn btn-info mb-2">Tambah Rekam Medis</a>
            </h1>
        </div> -->
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Pasien</td>
                            <td>Tanggal Berobat</td>
                            <td>Rujukan</td>
                            <td>Keluhan</td>
                            <td>Tindakan</td>
                            <td>Obat</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($rm as $us) : ?>
                            <tr>
                                <td> <?= $i; ?>.</td>
                                <td><?= $us['nama']; ?></td>
                                <td><?= $us['tanggal_berobat']; ?></td>
                                <td><?= $us['rujukan']; ?></td>
                                <td><?= $us['keluhan']; ?></td>
                                <td><?= $us['tindakan']; ?></td>
                                <td><?= $us['obat']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success" data-toggle="modal" data-target=<?= "#EditModal" . $us['id']; ?>>Edit</a>
                                    <a href="<?= base_url('RM/hapus/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>
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


<?php
foreach ($rm as $us) : ?>
    <div class="modal fade" id="EditModal<?php echo $us['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Rekam Medis</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('RM/edit/' . $us['id']) ?>" method="POST">
                        <input type="text" name="id" value="<?= $us['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama Pasien</label>
                            <input type="text" name="nama" value="<?= $us['nama']; ?> " class=" form-control" id="id_pasien" placeholder="Nama Pasien" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nim">Tanggal Berobat</label>
                            <input type="date" name="tanggal_berobat" value="<?= $us['tanggal_berobat']; ?>" class="form-control" id="tanggal_berobat" placeholder="NIM">
                        </div>
                        <div class="form-group">
                            <label for="nama">Rujukan</label>
                            <input type="text" name="rujukan" value="<?= $us['rujukan']; ?> " class=" form-control" id="rujukan" placeholder="Rujukan Rumah Sakit Bila Perlu">
                        </div>
                        <div class="form-group">
                            <label for="email">Keluhan</label>
                            <input type="text" value="<?= $us['keluhan']; ?>" name="keluhan" class="form-control" id="keluhan" placeholder="Keluhan">

                        </div>
                        <div class="form-group">
                            <label for="nama">Tindakan</label>
                            <input type="text" name="tindakan" value="<?= $us['tindakan']; ?> " class=" form-control" id="tindakan" placeholder="Tindakan Pengobatan Bila Perlu">
                        </div>
                        <div class="form-group">
                            <label for="email">Obat</label>
                            <input type="text" value="<?= $us['obat']; ?>" name="obat" class="form-control" id="obat" placeholder="Obat ">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>