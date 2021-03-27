(function ($) {
    'use strict';
    if ($("#chart-06").length) {
        var options = {
            chart: {
                height: 400,
                type: 'line',

                toolbar: {
                    show: false
                }
            },
            colors: ['#4c66fb', '#00C1D4'],
            stroke:{

            },


            series: [{
                name: "High - 2013",
                data: [10, 16, 33, 36, 32, 32, 33,11, 25, 18, 17,10]
            },
                {
                    name: "Low - 2013",
                    data: [ 32, 32, 33,12, 11, 14, 18, 17, 13, 13,33, 36 ]
                }
            ],
            title: {
                text: 'Overall Visitors',
                align: 'left'
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            markers: {

                size: 6
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
                max: 40
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
            document.querySelector("#chart-06"),
            options
        );

        chart.render();

    }

})(window.jQuery);

