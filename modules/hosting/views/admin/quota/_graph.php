<div class="card">
    <div class="card-header">
        <h5>Использование диска</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <?php
                echo \panix\ext\highcharts\Highcharts::widget([
                    'scripts' => [
                        // 'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        'modules/exporting',
                        //'modules/drilldown',
                    ],
                    'options' => [
                        'chart' => [
                            'type' => 'pie',
                            'plotBackgroundColor' => null,
                            'plotBorderWidth' => null,
                            'plotShadow' => false,
                            'backgroundColor' => 'rgba(255, 255, 255, 0)'
                        ],
                        'title' => null,
                        'legend' => [
                            'enabled' => false
                        ],
                        'plotOptions' => [
                            'pie' => [
                                'allowPointSelect' => true,
                                'cursor' => 'pointer',
                                'dataLabels' => [
                                    'enabled' => true,
                                    'format' => '{point.name}: {point.value}',
                                    // 'style' => [
                                    //'color' => "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'"
                                    // ]
                                ]
                            ],
                        ],
                        'tooltip' => [
                            'headerFormat' => '<span style="font-size:11px">{point.name}</span>'
                        ],
                        'series' => [
                            [
                                'colorByPoint' => true,
                                'tooltip' => [
                                    'pointFormat' => '<span style="color: {series.color}">{point.name} {point.value}</span>' // {point.y:.1f}
                                ],
                                'data' => [
                                    [
                                        'name' => 'FTP',
                                        'y' => (int)$response['used']['ftp'],
                                        'value' => \panix\engine\CMS::fileSize((int)$response['used']['ftp'] * 1024 * 1024),
                                    ],
                                    [
                                        'name' => 'MySQL',
                                        'y' => (int)$response['used']['mysql'],
                                        'value' => \panix\engine\CMS::fileSize((int)$response['used']['mysql'] * 1024 * 1024),
                                    ],
                                ]
                            ],
                        ],
                    ]
                ]);
                ?>
            </div>

            <div class="col-sm-6">

                <?php
                echo \panix\ext\highcharts\Highcharts::widget([
                    'scripts' => [
                        // 'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        'modules/exporting',
                        //'modules/drilldown',
                    ],
                    'options' => [
                        'chart' => [
                            'type' => 'pie',
                            'plotBackgroundColor' => null,
                            'plotBorderWidth' => null,
                            'plotShadow' => false,
                            'backgroundColor' => 'rgba(255, 255, 255, 0)'
                        ],
                        'title' => null,
                        'legend' => [
                            'enabled' => false
                        ],
                        'plotOptions' => [
                            'pie' => [
                                'allowPointSelect' => true,
                                'cursor' => 'pointer',
                                'dataLabels' => [
                                    'enabled' => true,
                                    'format' => '{point.name}: {point.value}',
                                    // 'style' => [
                                    //'color' => "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'"
                                    // ]
                                ]
                            ],
                        ],
                        'tooltip' => [
                            'headerFormat' => '<span style="font-size:11px">{point.name}</span>'
                        ],
                        'series' => [
                            [
                                'colorByPoint' => true,
                                'tooltip' => [
                                    'pointFormat' => '<span style="color: {series.color}">{point.name}: {point.value}</span>' // {point.y:.1f}
                                ],
                                'data' => [
                                    [
                                        'name' => 'Свободно',
                                        'y' => (int)$response['free']['inode'],
                                        'value' => $response['free']['inode'],
                                    ],
                                    [
                                        'name' => 'Использовано',
                                        'y' => (int)$response['used']['inode'],
                                        'value' => $response['used']['inode'],
                                    ],
                                ]
                            ],
                        ],
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>