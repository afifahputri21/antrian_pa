<div class="container-fluid">
    <div class="clearfix">
        <?php $date = date("d-m-Y");
        ?>
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800">JUMLAH ANTRIAN TANGGAL <?= $date; ?> </h1>
        </div>
        <div class="float-right">

        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">Poli Gigi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $gigi; ?></div>
                        </div>
                        <!-- <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">Poli Umum</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $umum; ?></div>
                        </div>
                        <!-- <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">Poli Lansia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $lansia; ?></div>
                        </div>
                        <!-- <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-success text-uppercase mb-1">Poli Anak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $anak; ?></div>
                        </div>
                        <!-- <div class="col-auto">
                            <i class="fas fa-hammer fa-2x text-gray-300"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-success text-uppercase mb-1">Poli KIA</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kia; ?></div>
                        </div>
                        <!-- <div class="col-auto">
                            <i class="fas fa-hammer fa-2x text-gray-300"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="clearfix">
        <?php $date = date("d-m-Y");
        ?>
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray 800">ANTRIAN YANG DIPROSES TANGGAL <?= $date; ?> </h1>
        </div>
        <div class="float-right">

        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">Poli Gigi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $gigipr; ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">Poli Umum</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $umumpr; ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">Poli Lansia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $lansiapr; ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-success text-uppercase mb-1">Poli Anak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $anakpr; ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-success text-uppercase mb-1">Poli KIA</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kiapr; ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
</div>