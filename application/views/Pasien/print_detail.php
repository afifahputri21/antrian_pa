<!DOCTYPE html>
<html Lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="row">
        <div class="col text-center">
            <h3 class="h3 text-dark"><?= $title ?></h3>
        </div>
    </div>
    <hr>
    <div class="row">
    </div class="row">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="">
        <thead>
            <tr>
                <td>Nama Pasien </td>
                <td> : </td>
                <td><?= $pasien['nama']; ?></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td> : </td>
                <td><?= $pasien['tempat_lahir']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir </td>
                <td> : </td>
                <td><?= $pasien['ttl']; ?></td>
            </tr>
            <tr>
                <td>Alamat </td>
                <td> : </td>
                <td><?= $pasien['alamat']; ?></td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td> : </td>
                <td><?= $pasien['kelurahan']; ?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td> : </td>
                <td><?= $pasien['kecamatan']; ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td> : </td>
                <td><?= $pasien['jenis_kelamin']; ?></td>
            </tr>
            <tr>
                <td>Usia</td>
                <td> : </td>
                <td><?= $pasien['usia']; ?></td>
            </tr>
            <tr>
                <td>Golangan Darah</td>
                <td> : </td>
                <td><?= $pasien['goldar']; ?></td>
            </tr>
    </table>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Tanggal Berobat</td>
                    <td>Rujukan</td>
                    <td>Keluhan</td>
                    <td>Tindakan</td>
                    <td>Obat</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rm as $p) : ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $p->tanggal_berobat ?></td>
                        <td><?= $p->rujukan ?></td>
                        <td><?= $p->keluhan ?></td>
                        <td><?= $p->tindakan ?></td>
                        <td><?= $p->obat ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>