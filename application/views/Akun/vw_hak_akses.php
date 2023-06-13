<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800"><?php echo $judul; ?> </h1>
        </div>
        <div class="float-right">
            <h1 class="h3 mb-4 text-gray 800">
                <!-- <a href="<?= base_url('Akun/tambah'); ?>" class="btn btn-info mb-2">Tambah Antrian</a> -->
                <a href="" class="btn btn-info mb-2" data-toggle="modal" data-target="#TambahModal">Tambah Role </a>
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
                            <td>Level</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($akses as $us) : ?>
                            <tr>
                                <td> <?= $i; ?>.</td>
                                <td><?= $us['nama_role']; ?></td>
                                <td><?= $us['level']; ?></td>
                                <!-- <td><?= $us['role_id']; ?></td> -->
                                <td>
                                    <a href="" class="badge badge-success" data-toggle="modal" data-target=<?= "#EditModal" . $us['id']; ?>>Edit</a>
                                    <a href="<?= base_url('Akun/hapus_akses/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>

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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Role User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Akun/tambah_akses') ?>" method="post">
                    <!-- <input type="hidden" name="id" value="<?= $us['id']; ?>"> -->
                    <div class="form-group">
                        <input type="text" name="nama_role" value="<?= set_value('nama_role'); ?>" class="form-control form-control-user" id="nama_role" placeholder="Nama Hak Akses">

                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= set_value('level'); ?>" class="form-control form-control-user" id="level" name="level" placeholder="Level">

                    </div>

                    <button type="submit" id="tambah" name="tambah" class="btn btn-primary float-right">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
foreach ($akses as $us) : ?>
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
                    <form action="<?= base_url('Akun/edit_hak_akses/' . $us['id']) ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $us['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama_role" value="<?= $us['nama_role']; ?> " class=" form-control" id="nama_role" placeholder="Nama">
                        </div>

                        <div class="form-group">
                            <label for="sifat">Level</label>
                            <select name="level" id="level" class="form-control">
                                <option value="1" <?php if ($us['level'] == "1") {
                                                        echo "selected";
                                                    } ?>>1</option>
                                <option value="2" <?php if ($us['level'] == "2") {
                                                        echo "selected";
                                                    } ?>>2</option>
                                <option value="3" <?php if ($us['level'] == "3") {
                                                        echo "selected";
                                                    } ?>>2</option>
                            </select>
                        </div>


                        <button type=" submit" id="tambah" name="tambah" class="btn btn-primary float-right">Submit Editing</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>