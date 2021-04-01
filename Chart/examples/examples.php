<?php
include "../../connect_db.php";
require "../src/AntoineAugusti/EasyPHPCharts/Chart.php";
use Antoineaugusti\EasyPHPCharts\Chart;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Charts</title>
	<link rel="stylesheet" href="chart.css">
	<style>
		*{margin: 0; padding: 0;}
		@import url(http://fonts.googleapis.com/css?family=Roboto);
		body{background: #FFF; font-family: 'Roboto', sans-serif;font-weight: 400}
		#content{background: #FFF; width: 1000px; padding: 20px; margin: 0 auto}
		h2{color: #4081BD; margin-bottom: 20px; font-weight: 400}
		.clearBoth:after{width: 300px; border: 1px solid #EEE; margin: 50px 0; display: block;}
		.containerChartLegend{width: 480px;padding-left: 20px}
	</style>
	<script src="ChartJS.min.js"></script>
</head>
<body>
	<div id="content">
		<?php
		/*
		//	A basic example of a pie chart
		*/
		$pieChart = new Chart('pie', 'examplePie');
		$pieChart->set('data', array(2, 10, 16, 30, 42));
		$pieChart->set('legend', array('Work', 'Eat', 'Sleep', 'Listen to music', 'Code'));
		$pieChart->set('displayLegend', true);
		echo $pieChart->returnFullHTML();

		/*
		//	An example of a doughnut chart with legend in percentages
		*/
		$doughnutChart = new Chart('doughnut', 'exampleDoughnut');
		$doughnutChart->set('data', array(2, 10, 16, 30, 42));
		$doughnutChart->set('legend', array('Work', 'Eat', 'Sleep', 'Listen to music', 'Code'));
		$doughnutChart->set('displayLegend', true);
		$doughnutChart->set('legendIsPercentage', true);
		echo $doughnutChart->returnFullHTML();

		/*
		//	An example of a bar chart with multiple datasets
		*/
        /** @var TYPE_NAME $conn */
        $chartTopicbyYear = $conn->query("select faculty.f_id, faculty.f_name, year(topic.topic_deadline) as year, count(*) as contributions from faculty join topic on faculty.f_id = topic.faculty_id group by year(topic.topic_deadline), faculty.f_id");

        $topicbyYear = array();
        $yearTopicbyYear = array();
        $keyTopicbyYear = array();

        while ($rowSt = mysqli_fetch_array($chartTopicbyYear)) {
            $yearTopicbyYear[$rowSt["year"]][] = $rowSt;
            $keyTopicbyYear[$rowSt["f_id"]] = $rowSt["f_name"];
        }

        $dataTopicbyYear = array();
        foreach ($keyTopicbyYear as $f_id => $row) {
            $falcutyData = array();
            foreach ($yearTopicbyYear as $yearData) {
                $hasData = false;
                foreach ($yearData as $facultyInYearData) {
                    if($facultyInYearData["f_id"] == $f_id) {
                        $falcutyData[] = $facultyInYearData["contributions"];
                        $hasData = true;
                        break;
                    }
                }
                if (!$hasData) {
                    $falcutyData[] = "0";
                }
            }
            $dataTopicbyYear[] = $falcutyData;
        }

        $barChart = new Chart('bar', 'examplebar');

		$barChart->set('data', $dataTopicbyYear);
		$barChart->set('legend', array_keys($yearTopicbyYear));
		// We don't to use the x-axis for the legend so we specify the name of each dataset
		$barChart->set('legendData', array_keys($keyTopicbyYear));
		$barChart->set('displayLegend', true);
		echo $barChart->returnFullHTML();

		/*
		//	An example of a radar chart
		*/
		$radarChart = new Chart('radar', 'exampleradar');
		$radarChart->set('data', array(20, 55, 16, 30, 42));
		$radarChart->set('legend', array('A', 'B', 'C', 'D', 'E'));
		echo $radarChart->returnFullHTML();

		/*
		//	An example of a polar chart
		*/
		$polarChart = new Chart('polar', 'examplepolar');
		$polarChart->set('data', array(20, 55, 16, 30, 42));
		$polarChart->set('legend', array('A', 'B', 'C', 'D', 'E'));
		echo $polarChart->returnFullHTML();
		?>
	</div>
</body>
</html>