<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="pdf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<!-- Custom scripts for all pages-->
<!-- <script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script> -->
<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/demo/datatables-demo.js"></script>
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    })
</script>

<!-- CHART JUMLAH POLIKNIK PERHARI (HARIAN) -->
<script type="text/javascript">
    var ctx = document.getElementById('chart_jum_poli_hari').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                <?php
                foreach ($poli_perhari as $data) {
                    echo "'" . $data['id_poli'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Jumlah Pengunjung pada Hari Ini',
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: [
                    <?php
                    foreach ($poli_perhari as $data) {
                        echo $data['jumlah'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Poliknik'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Jumlah Pengunjung'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });
</script>
<!-- CHART UNTUK JUMLAH KELURAHAN PERHARI -->
<script type="text/javascript">
    var ctx = document.getElementById('jum_kelurahan').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                <?php
                foreach ($kelurahan as $data) {
                    echo "'" . $data['kelurahan'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Banyak Pengunjung Berdasarkan Kelurahan',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverBackgroundColor: "#2e59d9",
                borderColor: "rgb(255,255,255)",
                data: [
                    <?php
                    foreach ($kelurahan as $data) {
                        echo $data['jumlah'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Kelurahan'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Jumlah Pengunjung'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "rgb(255,255,255)",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });
</script>
<!-- CHART KELUHAN PASIEN PERHARI -->
<script type="text/javascript">
    var ctx = document.getElementById('keluhan_perhari').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                <?php
                foreach ($keluhan_hari as $data) {
                    echo "'" . $data['keluhan'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Data Keluhan Pasien Perhari',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverBackgroundColor: "#2e59d9",
                borderColor: "rgb(255,255,255)",
                data: [
                    <?php
                    foreach ($keluhan_hari as $data) {
                        echo $data['jumlah'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Keluhan'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Banyak Keluhan'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "rgb(255,255,255)",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });
</script>
<!-- CHART KUNJUNGAN PASIEN PERMINGGU -->
<script type="text/javascript">
    var ctx = document.getElementById('kunjungan_perminggu').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                foreach ($week_antrian as $data) {
                    echo "'" . $data['week'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Jumlah Pasien',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverBackgroundColor: "#2e59d9",
                borderColor: "rgb(255,255,255)",
                data: [
                    <?php
                    foreach ($week_antrian as $data) {
                        echo $data['total'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Minggu ke- per Bulan'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Banyak Pengunjung'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "rgb(255,255,255)",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });
</script>
<!-- CHART UNTUK JUMLAH KELURAHAN PERMINGGU -->
<script type="text/javascript">
    var ctx = document.getElementById('kelurahan_1week').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                <?php
                foreach ($week_lurah as $data) {
                    echo "'" . $data['kelurahan'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Banyak Pengunjung',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverBackgroundColor: "#2e59d9",
                borderColor: "rgb(255,255,255)",
                data: [
                    <?php
                    foreach ($week_lurah as $data) {
                        echo $data['jumlah'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Kelurahan'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Jumlah Pengunjung'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "rgb(255,255,255)",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });
</script>
<!-- //CHART KUNJUNGAN POLI DALAM 1 MINGGU -->
<script type="text/javascript">
    var ctx = document.getElementById('poli_1week').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                foreach ($week_poli as $data) {
                    echo "'" . $data['id_poli'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Jumlah Pengunjung',
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: [
                    <?php
                    foreach ($week_poli as $data) {
                        echo $data['jumlah'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Poliknik'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Jumlah Pengunjung'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });
</script>
<!-- CHART KELUHAN PASIEN PERMINGGU -->
<script type="text/javascript">
    var ctx = document.getElementById('keluhan_1week').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                foreach ($week_keluhan as $data) {
                    echo "'" . $data['keluhan'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Keluhan Pasien Perminggu',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverBackgroundColor: "#2e59d9",
                borderColor: "rgb(255,255,255)",
                data: [
                    <?php
                    foreach ($week_keluhan as $data) {
                        echo $data['jumlah'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Keluhan'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Banyak Keluhan'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "rgb(255,255,255)",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });
</script>
<!-- CHART KUNJUNGAN PASIEN PERBULAN -->
<script type="text/javascript">
    var ctx = document.getElementById('kunjungan_perbulan').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                foreach ($antrian_bulan as $data) {
                    echo "'" . $data['bulan'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Jumlah Pasien',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverBackgroundColor: "#2e59d9",
                borderColor: "rgb(255,255,255)",
                data: [
                    <?php
                    foreach ($antrian_bulan as $data) {
                        echo $data['jumlah'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Minggu ke- per Bulan'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Banyak Pengunjung'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "rgb(255,255,255)",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });
</script>
<!-- CHART POLI TIAP BULAN -->
<script type="text/javascript">
    var ctx = document.getElementById('poli_bulan').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                foreach ($poli_bulan as $data) {
                    echo "'" . $data['id_poli'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Jumlah Pengunjung',
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: [
                    <?php
                    foreach ($poli_bulan as $data) {
                        echo $data['jumlah'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Poliknik'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Jumlah Pengunjung'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });
</script>
<!-- CHART TIAP JAM KUNJUNGAN -->
<script type="text/javascript">
    var ctx = document.getElementById('jam').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                foreach ($jam as $data) {
                    echo "'" . $data['hour'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Jumlah Pengunjung',
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: [
                    <?php
                    foreach ($jam as $data) {
                        echo $data['visitor_count'] . ", ";
                    }
                    ?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Poliknik'
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Jumlah Pengunjung'
                    },
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 30,
                        stepSize: 10
                    }
                }]
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });

    function exportToPDF() {
        var canvas = document.querySelector('#kunjungan_perminggu');
        var canvasImg = canvas.toDataURL('image/png');
        var imgWidth = 200;
        var pageHeight = 295;
        var imgHeight = canvas.height * imgWidth / canvas.width;
        var heightLeft = imgHeight;
        var doc = new jsPDF('p', 'mm');
        var position = 10;

        doc.addImage(canvasImg, 'PNG', 10, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;

        while (heightLeft >= 0) {
            position = heightLeft - imgHeight;
            doc.addPage();
            doc.addImage(canvasImg, 'PNG', 10, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
        }

        doc.save('chart.pdf');
    }
</script>
<script>
    // Fungsi untuk mengambil gambar dari grafik dan mengunduhnya sebagai PDF
    function downloadPDF() {
        // Buat instance dari jsPDF
        const doc = new jsPDF();

        // Ambil elemen canvas dari grafik pertama
        const chartCanvas = document.getElementById('chart_jum_poli_hari');

        // Buat gambar dari elemen canvas
        const chartImage = chartCanvas.toDataURL('image/png');

        // Tambahkan gambar ke dokumen PDF
        doc.addImage(chartImage, 'PNG', 10, 10, 190, 100);

        // Simpan dokumen PDF sebagai file
        doc.save('grafik_pengunjung.pdf');
    }

    // Menambahkan event listener ke tombol "Download PDF"
    document.getElementById('download').addEventListener('click', downloadPDF);
</script>
<script>
    $('#tab1_btn').on('click', function() {
        $('#tab1').show();
        $('#tab2').hide()
        $('#tab3').hide()
    })
    $('#tab2_btn').on('click', function() {
        $('#tab1').hide();
        $('#tab2').show()
        $('#tab3').hide()
    })
    $('#tab3_btn').on('click', function() {
        $('#tab1').hide();
        $('#tab2').hide()
        $('#tab3').show()
    })
</script>
</body>


</html>