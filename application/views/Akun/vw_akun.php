<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800"><?php echo $judul; ?> </h1>
        </div>
        <div class="float-right">
            <h1 class="h3 mb-4 text-gray 800">
                <!-- <a href="<?= base_url('Akun/tambah'); ?>" class="btn btn-info mb-2">Tambah Antrian</a> -->
                <a href="" class="btn btn-info mb-2" data-toggle="modal" data-target="#TambahModal">Tambah Akun Pegawai</a>
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
                            <td>Email</td>
                            <td>Level User</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($akun as $us) : ?>
                            <tr>
                                <td> <?= $i; ?>.</td>
                                <td><?= $us['name']; ?></td>
                                <td><?= $us['email']; ?></td>
                                <td><?= $us['role_id']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success" data-toggle="modal" data-target=<?= "#EditModal" . $us['id']; ?>>Edit</a>
                                    <a href="<?= base_url('Akun/hapus/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>

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
                <h5 class="modal-title" id="exampleModalLabel">Edit Pasien</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Akun/tambah') ?>" method="post">
                    <!-- <input type="hidden" name="id" value="<?= $us['id']; ?>"> -->
                    <div class="form-group">
                        <input type="text" name="nama" value="<?= set_value('nama'); ?>" class="form-control form-control-user" id="nama" placeholder="Nama Lengkap">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= set_value('email'); ?>" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <button type="submit" id="tambah" name="tambah" class="btn btn-primary float-right">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
foreach ($akun as $us) : ?>
    <div class="modal fade" id="EditModal<?php echo $us['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pasien</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('Akun/edit/' . $us['id']) ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $us['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="name" value="<?= $us['name']; ?> " class=" form-control" id="nama" placeholder="Nama">
                        </div>

                        <div class="form-group">
                            <label for="nim">Email</label>
                            <input type="text" name="email" value="<?= $us['email']; ?>" class="form-control" id="nik" placeholder="NIM">
                            <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <div class="form-group">
                            <label for="klasifikasi">Level</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <?php foreach ($level as $p) : ?>
                                    <option value="<?= $p['id']; ?>" <?= $us['role_id'] == $p['id'] ? 'selected' : '' ?>><?= $p['level']; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <button type=" submit" id="tambah" name="tambah" class="btn btn-primary float-right">Submit Editing</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>