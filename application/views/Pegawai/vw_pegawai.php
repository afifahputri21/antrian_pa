<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800"><?php echo $judul; ?> </h1>
        </div>
        <div class="float-right">
            <h1 class="h3 mb-4 text-gray 800">
                <a href="<?= base_url('Perawat/tambah'); ?>" class="btn btn-info mb-2">Tambah Perawat </a>
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
                            <td>NIP</td>
                            <td>Tempat Tanggal Lahir</td>
                            <td>Status</td>
                            <td>Email</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pegawai as $us) : ?>
                            <tr>
                                <td> <?= $i; ?>.</td>
                                <td><?= $us['nama']; ?></td>
                                <td><?= $us['nip']; ?></td>
                                <td><?= $us['ttl']; ?></td>
                                <td><?= $us['jabatan']; ?></td>
                                <td><?= $us['email']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success" data-toggle="modal" data-target=<?= "#EditModal" . $us['id']; ?>>Edit</a>
                                    <a href="<?= base_url('Perawat/hapus/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>
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
foreach ($pegawai as $us) : ?>
    <div class="modal fade" id="EditModal<?php echo $us['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit DataPegawai</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('Perawat/edit/' . $us['id']) ?>" method="POST">
                        <input type="text" name="id" value="<?= $us['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" value="<?= $us['nama']; ?> " class=" form-control" id="nama" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="nim">NIP</label>
                            <input type="text" name="nip" value="<?= $us['nip']; ?>" class="form-control" id="nip" placeholder="NIP">
                        </div>
                        <div class="form-group">
                            <label for="nim">Email</label>
                            <input type="text" name="email" value="<?= $us['email']; ?>" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="nim">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="<?= $us['tempat_lahir']; ?>" class="form-control" id="email" placeholder="Tempat Lahir">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Tanggal Lahir</label>
                            <input type="date" name="ttl" value="<?= $us['ttl']; ?>" class="form-control" id="ttl" placeholder="TTL">

                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Alamat</label>
                            <input type="text" name="alamat" value="<?= $us['alamat']; ?>" class="form-control" id="alamat" placeholder="Alamat">

                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Kecamatan</label>
                            <input type="text" name="kecamatan" value="<?= $us['kecamatan']; ?>" class="form-control" id="kecamatan" placeholder="Kecamatan ">

                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Kelurahan</label>
                            <input type="text" name="kelurahan" value="<?= $us['kelurahan']; ?>" class="form-control" id="kelurahan" placeholder="Kelurahan">

                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">No HP</label>
                            <input type="text" name="hp" value="<?= $us['hp']; ?>" class="form-control" id="hp" placeholder="Nomor HP">

                        </div>

                        <div class="form-group">
                            <label for="sifat">Kelamin</label>
                            <select name="kelamin" id="kelamin" class="form-control">
                                <option value="Laki-laki" <?php if ($us['kelamin'] == "Laki-laki") {
                                                                echo "selected";
                                                            } ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if ($us['kelamin'] == "Perempuan") {
                                                                echo "selected";
                                                            } ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Pendidikan</label>
                            <input type="text" name="pendidikan" value="<?= $us['pendidikan']; ?>" class="form-control" id="ttl" placeholder="Pendidikan">

                        </div>
                        <div class="form-group">
                            <label for="email">Jabatan</label>
                            <input type="text" value="<?= $us['jabatan']; ?>" name="jabatan" class="form-control" id="jabatan" placeholder="Jabatan">

                        </div>
                        <div class="form-group">
                            <label for="nama">Email</label>
                            <input type="text" name="email" value="<?= $us['email']; ?> " class=" form-control" id="email" placeholder="Email">
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