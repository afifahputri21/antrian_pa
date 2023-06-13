<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="row justify-content-center">
        <div class="col-md-8 ">

            <div class="card">
                <div class="card-header justify-content-center">

                    <div class="float-right">
                        <h1 class="h3 mb-6 text-gray 800">
                            <?php if ($ajuan['status_antrian'] == 'Prioritas OFF') {
                            ?> <a href="<?= base_url('Antrian/on/' . $ajuan['nik']); ?>" class="btn btn-danger">Jenis Antrian : Prioritas OFF</a>
                            <?php } else {
                            ?><a href="<?= base_url('Antrian/off/' . $ajuan['nik']); ?>" class="btn btn-success">Jenis Antrian : Prioritas ON</a>
                            <?php } ?>
                        </h1>
                    </div>
                </div>

                <div class="card-body">

                    <form action="<?= base_url('Antrian/tambah3/' . $ajuan['nik']) ?>" method="POST">
                        <div class="form-group">
                            <label for="nama">NIK</label>
                            <input type="text" name="nik" value="<?= $ajuan['nik']; ?> " class="form-control" id="nik" readonly>
                            <input type="hidden" name="nik" value="<?= $ajuan['nik']; ?> " class="form-control" id="nik">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" value="<?= $ajuan['nama']; ?> " class="form-control" id="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Umur Pasien</label>
                            <input type="text" name="umur" value="<?= $ajuan['usia']; ?> " class="form-control" id="umur" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Tempat Lahir Pasien</label>
                            <input type="text" name="tempat_lahir" value="<?= $ajuan['tempat_lahir']; ?> " class="form-control" id="tempat_lahir" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Tanggal Lahir Pasien</label>
                            <input type="text" name="ttl" value="<?= $ajuan['ttl']; ?> " class="form-control" id="ttl" readonly>
                        </div>
                        <div class="form-group">
                            <label for="poli">Poliknik</label>
                            <select name="poliknik" value="<?= set_value('poliknik'); ?>" id="poliknik" class="form-control">
                                <option value="">Pilih Poliknik</option>
                                <?php foreach ($poli as $p) : ?>
                                    <option value="<?= $p['id']; ?>"><?= $p['nama_poli']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('poliknik', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="kehamilan" id="kehamilan">
                                <label class="form-check-label" for="kehamilan">Pilih Bila Pasien adalah Ibu Hamil </label>
                            </div>
                        </div>

                        <a href="<?= base_url('Antrian') ?>" class="btn btn-danger">Kembali</a>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Daftar & Print</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>