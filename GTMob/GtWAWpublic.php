<?php

include_once "scripts/GtIsGoodServices.php";
include_once "scripts/GtIsGoodServices.php";

	function scheduleIndex() {
		// TODO
		echo 'This will be useful information provided to the users.';
	}

	function scheduleList($id) {
		// TODO
		$arr = getAllSchedulesByCreator($id);
		if ($arr)
			echo json_encode($arr);
		echo json_encode({'error' : 'Error finding schedules for the current user.'});
	}

	function scheduleAddNew($loggedInUserID, $startDate, $endDate, $alias, $type) {
		// TODO
		$startDate = stringToDate($startDate);
		$endDate = stringToDate($endDate);
		$sch = createSchedule(new GTIGSchedule(-1, $loggedInUserID, $startDate, $endDate, $alias, $type));
		if ($sch) {
			echo json_encode($sch);
		} else
			echo json_encode({'error' : 'There was an error creating the new schedule. Please try again later.'});
	}

	function scheduleUpdate($scheduleID, $loggedInUserID, $startDate, $endDate, $alias, $type) {
		// TODO
		$startDate = stringToDate($startDate);
		$endDate = stringToDate($endDate);
		$sch = createSchedule(new GTIGSchedule($scheduleID, -1, $startDate, $endDate, $alias, $type), $loggedInUserID);
		if ($sch) {
			echo json_encode($sch);
		} else
			echo json_encode({'error':'There was an error updating the schedule. Please try again later.'});
	}

	function gridRetrieve($gridID) {
		// TODO
		$grid = getGridById($gid);
		if ($grid) 
			echo json_encode($grid);
		echo json_encode({'error' : 'Error finding the requested grid.'});
	}

	function gridAddNew($loggedInUserID, $scheduleID, $data, $comments) {
		// TODO
		echo 'gridAddNew($loggedInUserID, $scheduleID, $data, $comments)\n';
	}

	function gridUpdate($gridID, $loggedInUserID, $scheduleID, $data, $comments) {
		// TODO
		echo 'gridUpdate($gridID, $loggedInUserID, $scheduleID, $data, $comments)\n';
	}

	function gridDelete($gridID, $loggedInUserID, $scheduleID) {
		// TODO
		echo 'gridDelete($gridID, $loggedInUserID, $scheduleID)\n';
	}

	function userGetByCredentials($credentials) {
		// TODO
		echo 'userGetByCredentials($credentials)\n';
	}

	function userAddNew($name, $email, $password, $pullDataFromTSquare) {
		// TODO
		echo 'userAddNew($name, $email, $password, $pullDataFromTSquare)\n';
	}

	function userUpdate($loggedInUserID, $toEditUserID, $name, $email, $password) {
		// TODO
		echo 'userUpdate($loggedInUserID, $toEditUserID, $name, $email, $password)\n';
	}
?>