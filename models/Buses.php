<?php
	class Buses
	{
		function __construct(){
		}

		static function getBus($bus_id){
			$bus = query("SELECT * FROM `tbl_buses` WHERE `id` = ? ",$bus_id);
			return $bus[0];
		}

		static function getBusRoutes($bus_id){
			$bus = query("SELECT * FROM `tbl_buses` WHERE `id` = ? ",$bus_id);
			return $bus[0];
		}

	}
?>