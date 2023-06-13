<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800"><?php echo $judul; ?> </h1>
        </div>
        <div class="float-right">
            <h1 class="h3 mb-4 text-gray 800">
                <!-- <a href="<?= base_url('Akun/tambah'); ?>" class="btn btn-info mb-2">Tambah Antrian</a> -->
                <a href="" class="btn btn-info mb-2" data-toggle="modal" data-target="#TambahModal">Tambah Poliknik</a>
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
                            <td>Kode</td>
                            <td>Penjelasan</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($poli as $us) : ?>
                            <tr>
                                <td> <?= $i; ?>.</td>
                                <td><?= $us['nama_poli']; ?></td>
                                <td><?= $us['kode']; ?></td>
                                <td><?= $us['penjelasan']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success" data-toggle="modal" data-target=<?= "#EditModal" . $us['id']; ?>>Edit</a>
                                    <a href="<?= base_url('Poli/hapus/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>

                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Poliknik</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Poli/button_tambah') ?>" method="post">
                    <!-- <input type="hidden" name="id" value="<?= $us['id']; ?>"> -->
                    <div class="form-group">
                        <input type="text" name="nama_poli" value="<?= set_value('nama_poli'); ?>" class="form-control form-control-user" id="nama_poli" placeholder="Nama Poliknik">

                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= set_value('kode'); ?>" class="form-control form-control-user" id="kode" name="kode" placeholder="Kode Poliknik">

                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= set_value('penjelasan'); ?>" class="form-control form-control-user" id="penjelasan" name="penjelasan" placeholder="Penjelasan Poliknik">

                    </div>

                    <button type="submit" id="tambah" name="tambah" class="btn btn-primary float-right">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
foreach ($poli as $us) : ?>
    <div class="modal fade" id="EditModal<?php echo $us['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Poliknik</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('Poli/edit/' . $us['id']) ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $us['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama Poliknik</label>
                            <input type="text" name="nama_poli" value="<?= $us['nama_poli']; ?> " class=" form-control" id="nama_poli" placeholder="Nama">
                        </div>

                        <div class="form-group">
                            <label for="nim">Kode Poli</label>
                            <input type="text" name="kode" value="<?= $us['kode']; ?>" class="form-control" id="kode" placeholder="Kode Poliknik">
                            <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nim">Penjelasan Poliknik</label>
                            <input type="text" name="penjelasan" value="<?= $us['penjelasan']; ?>" class="form-control" id="penjelasan" placeholder="Kode Poliknik">
                            <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <button type=" submit" id="tambah" name="tambah" class="btn btn-primary float-right">Submit Editing</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>