<script src="pdf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<style>
    #home,
    #menu1,
    #menu2 {
        width: 720px;
        height: 1000px;
        /* display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto; */
        margin: 0 auto;
        /* Center the content horizontally */
        padding: 20px;
        /* Add some spacing around the content */

    }
</style>


<!-- <button class="btn btn-primary btn-lg" id="chartJsDownloadButton">
        <i class="fas fa-download"></i> Download
    </button> -->
<div class="card shadow mb-1">
    <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
            <li class="nav-link"><a class="d-flex align-items-center text-start mx-3 ms-0 pb-3" data-toggle="tab" href="#home">Harian</a></li>
            <li class="nav-link"><a class="d-flex align-items-center text-start mx-3 ms-0 pb-3" data-toggle="tab" href="#menu1">Mingguan</a></li>
            <li class="nav-link"><a class="d-flex align-items-center text-start mx-3 ms-0 pb-3" data-toggle="tab" href="#menu2">Bulanan</a></li>
        </ul>

        <div class="tab-content">
            <div>
            </div>
            <div id="home" class="tab-pane active in">
                <div id="home2" class="clearfix">
                    <div class="float-left">
                        <?php $date = date("Y-m-d"); ?>
                        <h1 class="h3 mb-4 text-gray 800">GRAFIK PENGUNJUNG TANGGAL <?= $date ?> </h1>
                    </div>

                    <div class="float-right">
                        <h1 class="h3 mb-4 text-gray 800">
                            <!-- <button class="btn btn-primary btn-lg" id="chartJsDownloadButton">
                                    <i class="fas fa-download"></i> Download
                                </button> -->
                            <button class="btn btn-primary" id="download">Download PDF</button>
                            <!-- <a href="<?= base_url('Laporan/export_harian'); ?>" class="btn btn-info mb-2">Tambah Antrian</a> -->
                        </h1>
                    </div>
                </div>
                <div class="card shadow mb-5">
                    <div class="card-body">
                        <div class="float-left">
                            <?php $date = date("Y-m-d"); ?>
                            <h1 class="h6 mb-4 text-gray 800">Jumlah Pengunjung Poli Tanggal <?= $date ?> </h1>
                        </div>
                        <div class="chart-bar mb-5">
                            <canvas id="chart_jum_poli_hari"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-5">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="float-left">
                                            <?php $date = date("Y-m-d"); ?>
                                            <h1 class="h6 mb-4 text-gray 800">Jumlah Kelurahan Asal Pasien Tanggal <?= $date ?> </h1>
                                        </div>
                                        <div class="chart-bar mb-5">
                                            <canvas id="jum_kelurahan"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="float-left">
                                            <?php $date = date("Y-m-d"); ?>
                                            <h1 class="h6 mb-4 text-gray 800">Keluhan Pasien Tanggal <?= $date ?> </h1>
                                        </div>
                                        <div class="chart-bar mb-5">
                                            <canvas id="keluhan_perhari"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="menu1" class="tab-pane fade">
                <div class="clearfix">
                    <div class="float-left">
                        <?php $date = date("m"); ?>
                        <h1 class="h3 mb-4 text-gray 800">GRAFIK PENGUNJUNG PERMINGGU BULAN <?= $date ?> </h1>
                    </div>
                    <div class="float-right">
                        <h1 class="h3 mb-4 text-gray 800">
                            <button class="btn btn-primary" id="download1">Download PDF</button>
                        </h1>
                    </div>
                </div>
                <div class="card shadow mb-5">
                    <div class="card-body">
                        <div class="float-left">
                            <?php $date = date("m"); ?>
                            <h1 class="h6 mb-4 text-gray 800">Kunjungan Pasien Poliknik Perminggu Bulan <?= $date ?> </h1>
                        </div>
                        <div class="chart-bar mb-5">
                            <canvas id="poli_1week"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="float-left">
                                            <?php $date = date("m"); ?>
                                            <h1 class="h6 mb-4 text-gray 800">Kunjungan Perminggu Bulan <?= $date ?> </h1>
                                        </div>
                                        <div class="chart-bar mb-5">
                                            <canvas id="kunjungan_perminggu"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="float-left">
                                            <?php $date = date("m"); ?>
                                            <h1 class="h6 mb-4 text-gray 800">Kelurahan Pasien Perminggu Bulan <?= $date ?> </h1>
                                        </div>
                                        <div class="chart-bar mb-5">
                                            <canvas id="kelurahan_1week"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body ">
                        <div class="float-left">
                            <?php $date = date("m"); ?>
                            <h1 class="h6 mb-4 text-gray 800">Keluhan Pasien Perminggu Bulan <?= $date ?> </h1>
                        </div>
                        <div class="chart-bar mb-5">
                            <canvas id="keluhan_1week"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div class="clearfix">
                    <div class="float-left">
                        <?php $date = date("m"); ?>
                        <h1 class="h3 mb-4 text-gray 800">GRAFIK PENGUNJUNG PERMINGGU BULAN <?= $date ?> </h1>
                    </div>
                    <div class="float-right">
                        <h1 class="h3 mb-4 text-gray 800">
                            <button class="btn btn-primary" id="download2">Download PDF</button>
                        </h1>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="float-left">
                            <?php $date = date("y"); ?>
                            <h1 class="h6 mb-4 text-gray 800">Kunjungan Pasien Perbulan Tahun<?= $date ?> </h1>
                        </div>
                        <div class="chart-bar mb-5">
                            <canvas id="kunjungan_perbulan"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="float-left">
                            <?php $date = date("y"); ?>
                            <h1 class="h6 mb-4 text-gray 800">Kunjungan Pasien Poliknik Tahun <?= $date ?> </h1>
                        </div>
                        <div class="chart-bar mb-5">
                            <canvas id="poli_bulan"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.onload = function() {
        document.getElementById("download").addEventListener("click", () => {
            const home = document.getElementById("home");

            const downloadButton = home.querySelector(".btn-primary");
            downloadButton.style.display = "none";

            // Add a CSS class to hide the button when printing
            // downloadButton.classList.add("hide-on-pdf");

            var opt = {
                margin: 0.5,
                filename: 'home_chart.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'legal',
                    orientation: 'portrait'
                }
            };
            // html2pdf().from(home).set(opt).save();
            html2pdf().from(home).set(opt).save();

        });

        document.getElementById("download1").addEventListener("click", () => {
            const menu1 = document.getElementById("menu1");

            const downloadButton = menu1.querySelector(".btn-primary");
            downloadButton.style.display = "none";

            // Add a CSS class to hide the button when printing
            // downloadButton.classList.add("hide-on-pdf");

            var opt = {
                margin: 0.5,
                filename: 'minggu_chart.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'legal',
                    orientation: 'portrait'
                }
            };
            // html2pdf().from(home).set(opt).save();
            html2pdf().from(menu1).set(opt).save();

        });
        document.getElementById("download2").addEventListener("click", () => {
            const menu2 = document.getElementById("menu2");

            const downloadButton = menu2.querySelector(".btn-primary");
            downloadButton.style.display = "none";

            // Add a CSS class to hide the button when printing
            // downloadButton.classList.add("hide-on-pdf");

            var opt = {
                margin: 0.5,
                filename: 'tahunan_chart.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'legal',
                    orientation: 'portrait'
                }
            };
            // html2pdf().from(home).set(opt).save();
            html2pdf().from(menu2).set(opt).save();

        });

        // document.getElementById("download2").addEventListener("click", () => {
        //     const menu2 = document.getElementById("menu2");
        //     const downloadButton = home.querySelector(".btn-primary");
        //     downloadButton.style.display = "none";
        //     var opt = {
        //         margin: 0.5,
        //         filename: 'menu2_chart.pdf',
        //         image: {
        //             type: 'jpeg',
        //             quality: 0.98
        //         },
        //         html2canvas: {
        //             scale: 2
        //         },
        //         jsPDF: {
        //             unit: 'in',
        //             format: 'legal',
        //             orientation: 'portrait'
        //         }
        //     };
        //     html2pdf().from(menu2).set(opt).save();
        // });
    };
</script>
<script>
    document.getElementById("chartJsDownloadButton").addEventListener("click", downloadChartJs);
    var downloadChartJs = () => {
        html2canvas(document.getElementById("home"), {
            onrendered: function(canvas) {
                var img = canvas.toDataURL(); //image data of canvas
                var doc = new jsPDF();
                doc.addImage(img, 10, 10);
                doc.save('test.pdf');
            }
        });
    }
</script>
</div>