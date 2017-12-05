<?php
	class BusStops
	{
		function __construct(){
		}

		function getClosestStops($lat,$long){
			//TODO: set max bus_stops
			$stops = query("SELECT * FROM `tbl_bus_stops` ");
			foreach ($stops as $key => $stop) {;
				$stops[$key]['distance'] = getLocDistance($stop['bus_stop_lat'],$stop['bus_stop_long'],$lat,$long)['distance'];
			}
			usort($stops, function($a, $b) {
				$result = 0;
		        if ($a['distance'] > $b['distance']) {
		            $result = 1;
		        } else if ($a['distance'] < $b['distance']) {
		            $result = -1;
		        }
		        return $result;
			});
			return $stops;
		}

	}
?>