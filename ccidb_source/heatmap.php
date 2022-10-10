<?php require_once("globalvars.php"); header("Content-Type: text/javascript"); ?>

am4core.ready(function() {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("mapdiv", am4maps.MapChart);
		chart.geodata = am4geodata_worldLow;
		chart.projection = new am4maps.projections.Miller();
		var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
		polygonSeries.exclude = ["AQ"];
		
		polygonSeries.heatRules.push({
		  property: "fill",
		  target: polygonSeries.mapPolygons.template,
		  min: am4core.color("#0000FF"),
		  max: am4core.color("#FF0000"),
		  logarithmic: true
		});
		
		polygonSeries.useGeodata = true;
		
		polygonSeries.data = [
		<?php
		$countries = "";
		$countrycount = 0;
		$runcount = 0;
		$sql = "SELECT country_of_origin FROM " . $_SESSION["tablename"] . " WHERE country_of_origin IS NOT NULL AND country_of_origin != '' AND line != 123456;";
		
		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			
			$stmt = $pdo->prepare($sql);
			
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$result = $stmt->execute();
			
			if($result) {
				while($row = $stmt->fetch()) {
					$countrycount++;
					
					if(preg_match("/, /", $row["country_of_origin"])) {
						$temparray = explode(", ", $row["country_of_origin"]);
						foreach($temparray as $key => $data) {
							$countries .= $data . ", ";
						}
						
					}
					
					else {
						$countries .= $row["country_of_origin"] . ", ";
					}
				}
				$countries = preg_replace("/, $/", "", $countries);
				$countryarray = explode(", ", $countries);
				$countrycount = array_count_values($countryarray);
				foreach($countrycount as $key => $data) {
					$runcount++;
					
					if($runcount === count($countrycount)) {
						print_r("{\"id\": \"" . $key . "\", \"value\": " . $data . "}");
					}
					
					else {
						print_r("{\"id\": \"" . $key . "\", \"value\": " . $data . "}, ");
					}
				}
			}
			
			$database = null;
		}
		
		catch(PDOException $e) {
			echo $e->getMessage();
			die();
		}
		?>
		];
		
		let heatLegend = chart.createChild(am4maps.HeatLegend);
		heatLegend.series = polygonSeries;
		heatLegend.align = "center";
		heatLegend.valign = "bottom";
		heatLegend.width = am4core.percent(20);
		heatLegend.marginRight = am4core.percent(4);
		heatLegend.minValue = 0;
		heatLegend.maxValue = 10000;
		
		var minRange = heatLegend.valueAxis.axisRanges.create();
		minRange.value = heatLegend.minValue;
		minRange.label.text = "Out of one...";
		var maxRange = heatLegend.valueAxis.axisRanges.create();
		maxRange.value = heatLegend.maxValue;
		maxRange.label.text = "...many.";
		
		heatLegend.valueAxis.renderer.labels.template.adapter.add("text", function(labelText) {
		  return "";
		});
		
		var polygonTemplate = polygonSeries.mapPolygons.template;
		polygonTemplate.tooltipText = "{name}: {value}";
		polygonTemplate.nonScalingStroke = true;
		polygonTemplate.strokeWidth = 0.5;
		
		var hs = polygonTemplate.states.create("hover");
		hs.properties.fill = am4core.color("#009900");
		chart.backgroundSeries.mapPolygons.template.polygon.fill = am4core.color("#d4f1f9");
		chart.backgroundSeries.mapPolygons.template.polygon.fillOpacity = 1;
		chart.seriesContainer.draggable = true;
		chart.seriesContainer.resizable = false;
		
		var mapdiv2 = document.getElementById('mapdiv');
		mapdiv2.removeChild(mapdiv2.childNodes[0]);
	});