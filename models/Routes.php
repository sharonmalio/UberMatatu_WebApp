<?php
	class Routes
	{
		function __construct(){
		}

		function getRoute($route_id){
			$route = query("SELECT * FROM `tbl_routes` WHERE `route_id` = ?", $route_id)[0];
			return $route;
		}


		function getRoutesWithStage($stop_id){
			//TODO: set max bus_stops
			$routes_stops_ids = query("SELECT `route_id` FROM `tbl_route_stops` WHERE `stop_id` = ?", $stop_id);
			foreach ($routes_stops_ids as $key => $routes_stops_id) {
				$routes_stops[] = $this->getRoute($routes_stops_id['route_id']);
			}
			return $routes_stops;
		}

		function getRoutesWithStops($stops){
			foreach ($stops as $key => $stop) {
				getRouteWithStop($stop['bus_stop_id']);
			}			
			return $routes_stops;
		}

		function hasStop($route_id, $stop_id){
			$route = query("SELECT * FROM `tbl_route_stops` WHERE `stop_id` = ? AND `route_id` = ?"
				, $stop_id, $route_id);
			//var_dump(count($route) > 0);
			return (count($route) > 0);
		}

		static function getBuses($route_id){
			$bus_routes = query("SELECT * FROM `tbl_bus_routes` WHERE `route_id` = ?"
				,$route_id);
			
			require_once 'Buses.php';

			foreach ($bus_routes as $key => $bus_route) {
				$buses[] = array_merge(Buses::getBus($bus_route['bus_id']),
					(new Routes())->getRoute($route_id));
			}
			return $buses;
		}
	}
?>