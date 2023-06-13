<!DOCTYPE html>
<html Lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
</head>

<body>
    <h1>Chart PDF</h1>
    <canvas id="chart_jum_poli_hari" width="800" height="400"></canvas>
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
        </script