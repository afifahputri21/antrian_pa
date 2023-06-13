<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="row justify-content-center">
        <div class="col-md-8 ">

            <div class="card">
                <div class="card-header justify-content-center">
                    Form Tambah Data Perawat
                </div>

                <div class="card-body">
                    <form action="<?= base_url('Perawat/button_tambah/') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" value="<?= set_value('nama'); ?>" class="form-control" id="nama" placeholder="Nama" required>

                        </div>
                        <div class="form-group">
                            <label for="nim">NIP</label>
                            <input type="text" name="nip" value="<?= set_value('nip'); ?>" class="form-control" id="nik" placeholder="NIK" required>

                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="<?= set_value('tempat_lahir'); ?>" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Tanggal Lahir</label>
                            <input type="date" name="ttl" value="<?= set_value('ttl'); ?>" class="form-control" id="ttl" placeholder="TTL">
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat</label>
                            <input type="text" value="<?= set_value('alamat'); ?>" name="alamat" class="form-control" id="alamat" placeholder="Alamat" required>

                        </div>
                        <div class="form-group">
                            <label for="prodi">Kelurahan</label>
                            <input type="text" value="<?= set_value('kelurahan'); ?>" name="kelurahan" class="form-control" id="kelurahan" placeholder="Kelurahan" required>
                        </div>
                        <div class="form-group">
                            <label for="asal_sekolah">Kecamatan</label>
                            <input type="text" value="<?= set_value('kecamatan'); ?>" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan" required>
                        </div>
                        <div class="form-group">
                            <label for="asal_sekolah">No HP</label>
                            <input type="text" value="<?= set_value('hp'); ?>" name="hp" class="form-control" id="goldar" placeholder="No HP" required>
                        </div>
                        <div class="form-group">
                            <label for="asal_sekolah">Email</label>
                            <input type="text" value="<?= set_value('email'); ?>" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Pendidikan</label>
                            <input type="text" name="pendidikan" value="<?= set_value('pendidikan'); ?>" class="form-control" id="ttl" placeholder="Pendidikan Terakhir">

                        </div>
                        <div class="form-group">
                            <label for="no_hp">Kelamin</label>
                            <select name="kelamin" value="<?= set_value('kelamin'); ?>" id="kelamin" class="form-control" required>
                                <option value="">Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="alamat">Jabatan</label>
                            <input type="text" name="jabatan" value="<?= set_value('jabatan'); ?>" class="form-control" id="jabatan" placeholder="Jabatan" required>

                        </div>
                        <a href="<?= base_url('Pasien') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Pegawai</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>