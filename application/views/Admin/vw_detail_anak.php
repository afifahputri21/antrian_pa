<div class="container-fluid">
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
    <!-- <div class="row">
        <?= $this->session->flashdata('message');
        ?>
    </div> -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" value="<?= $detail['nama']; ?> " class=" form-control" id="nama" placeholder="Nama" readonly>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin">Tanggal Lahir</label>
                                <input type="date" name="ttl" value="<?= $detail['ttl']; ?>" class="form-control" id="ttl" placeholder="TTL" readonly>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Alamat</label>
                                        <input type="text" value="<?= $detail['alamat']; ?>" name="alamat" class="form-control" id="alamat" placeholder="Alamat" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="prodi">Kelurahan</label>
                                        <input type="text" value="<?= $detail['kelurahan']; ?>" name="kelurahan" class="form-control" id="kelurahan" placeholder="Alamat" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="asal_sekolah">Kecamatan</label>
                                        <input type="text" value="<?= $detail['kecamatan']; ?>" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Jenis Kelamin</label>
                                <input type="text" value="<?= $detail['jenis_kelamin']; ?>" name="jenis_kelamin" class="form-control" id="jenis_kelamin" placeholder="Kelamin" readonly>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <!-- <th scope="col">#</th> -->
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
                            <form action="<?= base_url('Admin/input_tindakananak/' . $booking['id']) ?>" method="POST">
                                <input type="hidden" name="id" value="<?= $booking['id']; ?>">
                                <input type="hidden" name="id_pasien" value="<?= $detail['id']; ?>" class="form-control" id="id_pasien">
                                <div class="form-group">
                                    <label for="prodi">Tanggal Berobat</label>
                                    <input type="date" value="<?= set_value('tanggal_berobat'); ?>" name="tanggal_berobat" class="form-control" id="tanggal_berobat" placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <label for="asal_sekolah">Keluhan</label>
                                    <input type="text" value="<?= set_value('keluhan'); ?>" name="keluhan" class="form-control" id="keluhan" placeholder="Keluhan Pasien">

                                </div>
                                <div class="form-group">
                                    <label for="no_hp">Rujukan</label>
                                    <input type="text" value="<?= set_value('rujukan'); ?>" name="rujukan" class="form-control" id="rujukan" placeholder="Rujukan Rumah Sakit">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">Tindakan</label>
                                    <input type="text" value="<?= set_value('tindakan'); ?>" name="tindakan" class="form-control" id="tindakan" placeholder="Tindakan Pengobatan">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">Obat</label>
                                    <input type="text" value="<?= set_value('obat'); ?>" name="obat" class="form-control" id="obat" placeholder="Obat yang diresep">
                                </div>
                                <button type="submit" id="tambah" name="tambah" class="btn btn-primary float-right">Input Penanganan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>