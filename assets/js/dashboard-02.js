(function ($) {
    'use strict';
    if ($("#chart-01").length) {
        var options = {
            chart: {
                height: 350,
                type: 'area',

                animations: {
                    enabled: true,
                },
            },
            colors: "#fff",
            dataLabels: {
                enabled: false
            },


            stroke: {
                colors: ["#fff"],
                curve: 'straight',
                width: 3
            },
            series: [{
                name: "Units",
                data: [8107.85, 8128, 8122.9, 8165.5, 8340.7, 8423.7, 8423.5, 8514.3, 8481.85, 8487.7, 8506.9, 8626.2, 8668.95, 8602.3, 8607.55, 8512.9, 8496.25, 8600.65, 8881.1, 9340.85]
            }],
            grid: {
                borderColor: 'rgba(255,225,255,0.2)',
                strokeDashArray: '3',

            },

            labels: ["13 Nov 2017", "14 Nov 2017", "15 Nov 2017", "16 Nov 2017", "17 Nov 2017", "20 Nov 2017", "21 Nov 2017", "22 Nov 2017", "23 Nov 2017", "24 Nov 2017", "27 Nov 2017", "28 Nov 2017", "29 Nov 2017", "30 Nov 2017", "01 Dec 2017", "04 Dec 2017", "05 Dec 2017", "06 Dec 2017", "07 Dec 2017", "08 Dec 2017"],
            xaxis: {
                type: 'datetime',

            },
            yaxis: {},
            legend: {
                horizontalAlign: 'left'
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-01"),
            options
        );

        chart.render();

    }
    if ($("#chart-02").length) {

        var options = {
            annotations: {
                yaxis: [{
                    y: 8200,
                    borderColor: colors[1],
                    label: {
                        borderColor: colors[1],
                        style: {
                            color: '#fff',
                            background: colors[1],
                        },
                        text: 'Avg Uptime',
                    }
                }],
                xaxis: [{
                    x: new Date('23 Nov 2017').getTime(),
                    strokeDashArray: 0,
                    borderColor: colors[0],
                    label: {
                        borderColor: colors[0],
                        style: {
                            color: '#fff',
                            background: colors[0],
                        },
                        text: 'Server Upgrades',
                    }
                }],
                points: [{
                    x: new Date('27 Nov 2017').getTime(),
                    y: 8506.9,
                    marker: {
                        size: 8,
                        fillColor: '#fff',
                        strokeColor: colors[6],
                        radius: 2
                    },
                    label: {
                        borderColor: colors[6],
                        offsetY: 0,
                        style: {
                            color: '#fff',
                            background: colors[6],
                        },

                        text: 'CDN Added',
                    }
                }]
            },
            chart: {
                height: 350,
                type: 'line',
            },
            dataLabels: {
                enabled: false
            },
            colors: colors,
            stroke: {
                curve: 'straight'
            },
            grid: {
                padding: {
                    right: 30,
                    left: 20
                },
                strokeDashArray: '3',
            },
            series: [{
                data: [8107, 8128, 8122, 8165, 8340, 8423, 8423, 8514, 8481, 8487, 8506, 8626, 8668, 8602, 8607, 8512, 8496, 8600, 8881, 9340]
            }],
            labels: ["13 Nov 2017", "14 Nov 2017", "15 Nov 2017", "16 Nov 2017", "17 Nov 2017", "20 Nov 2017", "21 Nov 2017", "22 Nov 2017", "23 Nov 2017", "24 Nov 2017", "27 Nov 2017", "28 Nov 2017", "29 Nov 2017", "30 Nov 2017", "01 Dec 2017", "04 Dec 2017", "05 Dec 2017", "06 Dec 2017", "07 Dec 2017", "08 Dec 2017"],
            xaxis: {
                type: 'datetime',
            },
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-02"),
            options
        );

        chart.render();


    }

    if ($("#chart-03").length) {

        var options = {
            chart: {
                type: 'line',

                height: 135,
                sparkline: {
                    enabled: true
                }
            },
            series: [{
                data: [47, 45, 74, 14, 56, 74, 14, 11, 7, 39, 82]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return ''
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-03"),
            options
        );

        chart.render();


    }
    if ($("#chart-04").length) {

        var options = {
            colors: [colors[1]],

            chart: {
                type: 'line',
                height: 135,
                sparkline: {
                    enabled: true
                }
            },
            series: [{
                data: [ 56, 74, 14, 11,47, 45, 74, 14, 7, 39, 56]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return ''
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-04"),
            options
        );

        chart.render();


    }
    if( $("#chart-05").length ){
        var options = {
            colors:[ colors[19], colors[18], colors[17], colors[16]] ,
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return 249
                            }
                        }
                    }
                }
            },
            series: [44, 55, 67, 83],
            labels: ['Total', 'In Progress', 'Due', 'Blocked'],

        }

        var chart = new ApexCharts(
            document.querySelector("#chart-05"),
            options
        );

        chart.render();
    }
})(window.jQuery);
