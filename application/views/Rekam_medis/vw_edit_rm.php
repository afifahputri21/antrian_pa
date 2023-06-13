<!-- <div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
        </div>
        <div class="float-right">
            <a href="<?= base_url('Pasien') ?>" class="btn btn-secondary btn-sm">
                <i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali
            </a>
        </div>
    </div>
   <div class="row">
        <?= $this->session->flashdata('message');
        ?>
    </div> 
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="col mr-2">
                        <form action="<?= base_url('RM/edit/' . $rm['id']) ?>" method="POST">
                            <input type="hidden" name="id" value="<?= $rm['id']; ?>">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" value="<?= $rm['nama']; ?> " class=" form-control" id="nama" placeholder="Nama">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nim">NIK</label>
                                        <input type="text" name="nik" value="<?= $rm['nik']; ?>" class="form-control" id="nik" placeholder="NIM">
                                        <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Tanggal Lahir</label>
                                        <input type="date" name="ttl" value="<?= $pasien['ttl']; ?>" class="form-control" id="ttl" placeholder="TTL">
                                        <?= form_error('ttl', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Alamat</label>
                                        <input type="text" value="<?= $pasien['alamat']; ?>" name="alamat" class="form-control" id="alamat" placeholder="Alamat">
                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="prodi">Kelurahan</label>
                                        <input type="text" value="<?= $pasien['kelurahan']; ?>" name="kelurahan" class="form-control" id="kelurahan" placeholder="Kelurahan">
                                        <?= form_error('kelurahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="asal_sekolah">Kecamatan</label>
                                        <input type="text" value="<?= $pasien['kecamatan']; ?>" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan">
                                        <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Jenis Kelamin</label>
                                        <input type="text" value="<?= $pasien['jenis_kelamin']; ?>" name="jenis_kelamin" class="form-control" id="jenis_kelamin" placeholder="Jenis Kelamin">
                                        <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="prodi">Usia</label>
                                        <input type="number" value="<?= $pasien['usia']; ?>" name="usia" class="form-control" id="usia" placeholder="Usia">
                                        <?= form_error('usia', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="asal_sekolah">Golongan Darah</label>
                                        <input type="text" value="<?= $pasien['goldar']; ?>" name="goldar" class="form-control" id="goldar" placeholder="Golangan Darah">
                                        <?= form_error('goldar', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="tambah" name="tambah" class="btn btn-primary float-right">Input Penanganan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->