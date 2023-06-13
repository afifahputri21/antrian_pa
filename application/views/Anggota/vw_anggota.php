<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800"><?php echo $judul; ?> </h1>
        </div>
        <div class="float-right">
            <h1 class="h3 mb-4 text-gray 800">
                <!-- <a href="<?= base_url('Pasien/tambah1'); ?>" class="btn btn-info mb-2">Tambah Pasien</a> -->
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
                            <td>NIK</td>
                            <td>Alamat</td>
                            <td>Jenis Kelamin</td>
                            <td>Golangan Darah</td>
                            <td>Hubungan Keluarga</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($anggota as $us) : ?>
                            <tr>
                                <td> <?= $i; ?>.</td>
                                <td><?= $us['nama']; ?></td>
                                <td><?= $us['nik']; ?></td>
                                <td><?= $us['alamat']; ?></td>
                                <td><?= $us['jenis_kelamin']; ?></td>
                                <td><?= $us['goldar']; ?></td>
                                <td><?= $us['id_root']; ?></td>
                                <td>
                                    <a href="<?= base_url('Anggota/hapus/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>
                                    <a href="" class="badge badge-success" data-toggle="modal" data-target=<?= "#EditModal" . $us['id']; ?>>Edit</a>
                                    <a href="<?= base_url('Anggota/detail/') . $us['id']; ?>" class="badge badge-info">Detail</a>
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
foreach ($anggota as $us) : ?>
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
                    <form action="<?= base_url('Anggota/edit/' . $us['id']) ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $us['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" value="<?= $us['nama']; ?> " class=" form-control" id="nama" placeholder="Nama">
                        </div>

                        <div class="form-group">
                            <label for="nim">NIK</label>
                            <input type="text" name="nik" value="<?= $us['nik']; ?>" class="form-control" id="nik" placeholder="NIM">
                            <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <div class="form-group">
                            <label for="jenis_kelamin">Tanggal Lahir</label>
                            <input type="date" name="ttl" value="<?= $us['ttl']; ?>" class="form-control" id="ttl" placeholder="TTL">
                            <?= form_error('ttl', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <div class="form-group">
                            <label for="email">Alamat</label>
                            <input type="text" value="<?= $us['alamat']; ?>" name="alamat" class="form-control" id="alamat" placeholder="Alamat">
                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <div class="form-group">
                            <label for="prodi">Kelurahan</label>
                            <input type="text" value="<?= $us['kelurahan']; ?>" name="kelurahan" class="form-control" id="kelurahan" placeholder="Kelurahan">
                            <?= form_error('kelurahan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <div class="form-group">
                            <label for="asal_sekolah">Kecamatan</label>
                            <input type="text" value="<?= $us['kecamatan']; ?>" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan">
                            <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="sifat">Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="Laki-laki" <?php if ($us['jenis_kelamin'] == "Laki-laki") {
                                                                echo "selected";
                                                            } ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if ($us['jenis_kelamin'] == "Perempuan") {
                                                                echo "selected";
                                                            } ?>>Perempuan</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="prodi">Usia</label>
                            <input type="number" value="<?= $us['usia']; ?>" name="usia" class="form-control" id="usia" placeholder="Usia">
                            <?= form_error('usia', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="asal_sekolah">Golongan Darah</label>
                            <input type="text" value="<?= $us['goldar']; ?>" name="goldar" class="form-control" id="goldar" placeholder="Golangan Darah">
                            <?= form_error('goldar', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="asal_sekolah">Status Keluarga</label>
                            <input type="text" value="<?= $us['status_keluarga']; ?>" name="goldar" class="form-control" id="goldar" placeholder="Golangan Darah">
                            <?= form_error('goldar', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <button type="submit" id="tambah" name="tambah" class="btn btn-primary float-right">Input Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>