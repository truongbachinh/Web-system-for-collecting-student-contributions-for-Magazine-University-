(function ($) {
    'use strict';
    if($("#chart-10").length > 0){
        var options = {
            chart: {
                height: 400,
                type: 'area',

                toolbar: {
                    show: false
                }
            },
            colors: ['#4c66fb', '#00C1D4'],
            stroke:{

            },
            dataLabels:{
                enabled: false,
            },
           series: [{
                name: "Channel A",
                data: [12,15,19,25,30,38,45,51,68,72,88,90]
            },
                {
                    name: "Channel B",
                    data: [86,75,50,60,40,50,52,40,30,20,10,18]
                }
            ],


            markers: {

                size: 2
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    inverseColors: false,
                    opacityFrom: 0.7,
                    opacityTo: 0,
                    stops: [0, 90, 100]
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sept','Oct','Nov','Dec'],
                title: {
                    text: 'Month'
                }
            },
            yaxis: {
                title: {
                    text: 'Visitors'
                },
                min: 5,
                max: 100
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-10"),
            options
        );

        chart.render();

    }
    if($("#chart-11").length > 0){
        var options = {
            chart: {
                type: 'donut',

            },
            series: [44, 55, 41, 17, 15],
            dataLabels:{
                enabled: false,
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                floating: true,
                offsetY: 0,
                offsetX: -5
            },

        }

        var chart = new ApexCharts(
            document.querySelector("#chart-11"),
            options
        );

        chart.render();

    }
    if( $("#chart-12") ){

        var options = {
            chart: {
                height: 350,
                type: 'line',
                stacked: false
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Income',
                type: 'column',
                data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
            }, {
                name: 'Cashflow',
                type: 'column',
                data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
            }, {
                name: 'Revenue',
                type: 'line',
                data: [20, 29, 37, 36, 44, 45, 50, 58]
            }],
            stroke: {
                width: [1, 1, 4]
            },
            title: {
                text: 'XYZ - Stock Analysis (2009 - 2016)',
                align: 'left',
                offsetX: 0
            },
            xaxis: {
                categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016],
            },
            yaxis: [
                {
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#008FFB'
                    },
                    labels: {
                        style: {
                            color: '#008FFB',
                        }
                    },
                    title: {
                        text: "Income (thousand crores)",
                        style: {
                            color: '#008FFB',
                        }
                    },
                    tooltip: {
                        enabled: true
                    }
                },

                {
                    seriesName: 'Income',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#00E396'
                    },
                    labels: {
                        style: {
                            color: '#00E396',
                        }
                    },
                    title: {
                        text: "Operating Cashflow (thousand crores)",
                        style: {
                            color: '#00E396',
                        }
                    },
                },
                {
                    seriesName: 'Revenue',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FEB019'
                    },
                    labels: {
                        style: {
                            color: '#FEB019',
                        },
                    },
                    title: {
                        text: "Revenue (thousand crores)",
                        style: {
                            color: '#FEB019',
                        }
                    }
                },
            ],
            tooltip: {
                fixed: {
                    enabled: true,
                    position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                    offsetY: 30,
                    offsetX: 60
                },
            },
            legend: {
                horizontalAlign: 'left',
                offsetX: 40
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-12"),
            options
        );


        chart.render();

    }
})(window.jQuery);

