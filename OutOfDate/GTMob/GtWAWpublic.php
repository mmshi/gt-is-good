<?php

include_once "scripts/GtIsGoodServices.php";
include_once "scripts/GtIsGoodObjects.php";

/**
 *	WAWfrontDoor
 */
	function getSchedulesForUser($userID) {
		// TODO
		$arr = getAllSchedulesByCreator($id); 
		if ($arr)
			echo json_encode(array('html'=>convertUsersToCheckList($arr););
		else
			echo json_encode(array('error'=>'Error finding schedules for the current user.'));
	}

/**
 *	WAWeditString
 */
	function getEditStringById($gridID) {
		// TODO
		$grid = getGridById($gridID);
		if ($grid)
			echo json_encode($grid->data);
		else 
			echo json_encode(array('error':'TODO'));
	}

	function addEditString($userID, $editStr, $alias); {
		// TODO
		$grid = createGrid(new GTIGGrid(-1, $userID, "schedule", $editStr, ''), $schId, $userId)
		if ($grid)
			echo json_encode(array('grid'=>$grid));
		else
			echo json_encode(array('error'=>'TODO'));
	}

	function updateEditString($gridID, $userID, $editStr, $alias); {
		// TODO
		$grid = createGrid(new GTIGGrid($gridID, $userID, "schedule", $editStr, ''), $schId, $userId)
		if ($grid)
			echo json_encode(array('grid'=>$grid));
		else
			echo json_encode(array('error'=>'TODO'));
		
	}

/**
 *	WAWresultsTable
 */
	function getResultsTable($schID) {
		// TODO
		$sch = getScheduleById($schID);
		if ($sch) {
			echo json_encode(array('html'=>getPersistantResults($sch));
		} else
			echo json_encode('error'=>'TODO');
	}

	function getIncompleteResultsTable($schID, $includedUsers) {
		// TODO
		$sch = getScheduleById($schID);
		if ($sch) {
			echo json_encode(array('html'=>getPersistantResults($sch, $includedUserIDs));
		} else
			echo json_encode('error'=>'TODO');
	}

/**
 *	WAWschedule
 */
	function getScheduleById($schID) {
		// TODO
		$sch = getScheduleById($schID);
		if ($sch) {
			echo json_encode(array($sch);
		} else
			echo json_encode(array('error'=>'TODO'));
	}

	function addSchedule($userId, $editStr, $alias) {
		// TODO
		$startDate = 0;
		$endDate = 0;
		$sch = createSchedule(new GTIGSchedule(-1, $userID, 0, 0, $alias, '1hour'));
		if ($sch) {
			$grid = createGrid(new GTIGGrid(-1, $userID, 'userSchedule', $editStr, '');
			echo json_encode(array('html'=>convertScheduleToLink($sch));
		} else
			echo json_encode(array('error'=>'There was an error creating the new schedule. Please try again later.'));
	}

	function getScheduleByAlias($alias) {
		// TODO
		$sch = getScheduleByAlias($schID);
		if ($sch) {
			echo json_encode(array($sch);
		} else
			echo json_encode(array('error'=>'TODO'));
	}

?>
