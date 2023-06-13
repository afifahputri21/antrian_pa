<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="float-right">
        <h1 class="h3 mb-4 text-gray 800">
            <a href="<?= base_url('Pasien/export/') . $pasien['id'];; ?>" class="btn btn-info mb-2">Export</a>
        </h1>
    </div>
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong> Detail Pasien</strong>
                </div>

                <div class="card-body">
                    <h2 class="card-title"><?= $pasien['nama']; ?></h2>
                    <div class="row">
                        <div class="col-md-4">NIK</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $pasien['nik']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Tempat Lahir</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $pasien['tempat_lahir']; ?></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">Tanggal Lahir</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $pasien['ttl']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Alamat</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $pasien['alamat']; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Kelurahan</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $pasien['kelurahan']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Kecamatan</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $pasien['kecamatan']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Jenis Kelamin</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $pasien['jenis_kelamin']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Usia</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $pasien['usia']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Golangan Darah</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $pasien['goldar']; ?></div>
                    </div>
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-header">
                    <strong> Rekam Medis Pasien <?= $pasien['nama']; ?></strong>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Berobat</th>
                            <th scope="col">Rujukan</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Tindakan</th>
                            <th scope="col">Obat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($rm as $row) { ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row->tanggal_berobat ?></td>
                                <td><?= $row->rujukan ?></td>
                                <td><?= $row->keluhan ?></td>
                                <td><?= $row->tindakan ?></td>
                                <td><?= $row->obat ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="card-header">
                    <strong> Anggota Keluarga</strong>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Golangan Darah</th>
                            <th scope="col">Usia</th>
                            <th scope="col">Status Keluarga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($anggota as $row) { ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row->nama ?></td>
                                <td><?= $row->ttl ?></td>
                                <td><?= $row->goldar ?></td>
                                <td><?= $row->usia ?></td>
                                <td><?= $row->status_keluarga ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer justify-content-center">
        <a href="<?= base_url('Mahasiswa') ?>" class="btn btn-danger">Tutup</a>
    </div>
</div>
</div>

</div>
</div>

</div>