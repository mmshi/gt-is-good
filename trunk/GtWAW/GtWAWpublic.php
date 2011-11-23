<?php

include_once "scripts/GtIsGoodServices.php";
include_once "scripts/GtIsGoodObjects.php";

$DEFAULT_LINK_FUNCTION = "TODO();";

/**
 *	WAWfrontDoor
 */
	function p_getSchedulesForUser($userID) {
		// TODO
		global $_USER;
		$user = getUserByEmail($_USER['uid']);
		$arr = getSchedulesByUserId($user->getId()); 
		if ($arr)
			echo json_encode(array('html'=>convertScheduesToLinkList($arr)));
		else
			echo json_encode(array('error'=>'Error finding schedules for the current user.'));
	}

/**
 *	WAWeditString
 */
	function p_getEditStringById($IDs) {
		// TODO
		$arr = explode('_', $IDs);
		$gridID = $arr[0];
		$schID = $arr[1];
		$grid = getGridById($gridID, $schID);
		
		
		if ($grid)
			echo json_encode(array('html'=>$grid->data));
		else 
			echo json_encode(array('error'=>'TODO'));
	}

	function p_addEditString($userID, $schID, $editStr, $alias) {
		// TODO
		global $_USER;
		$user = getUserByEmail($_USER['uid']);
		$grid = createGrid(new GTIGGrid(-1, $user->getId(), $editStr), $schID, $user->getId());
		if ($grid) {
			$sch = getScheduleById($schID);
			echo json_encode(array('html'=>convertScheduleToLink($sch)));
		} else
			echo json_encode(array('error'=>'TODO'));
	}

	function p_updateEditString($gridID, $userID, $editStr) {
		// TODO
		global $_USER;
		$user = getUserByEmail($_USER['uid']);
		$grid = updateGrid(new GTIGGrid($gridID, $user->getId(), "schedule", $editStr, ''), $user->getId());
		if ($grid)
			echo json_encode(array('html'=>$grid));
		else
			echo json_encode(array('error'=>'TODO'));
		
	}

/**
 *	WAWresultsTable
 */
	function p_getResultsTable($schID) {
		// TODO
		$sch = getScheduleById($schID);
		if ($sch) {
			$str = "<h1>Name:'" . $sch->alias . "' id:" . $sch->getId() . "</h1><br />";
			$str .= getPersistantResults($sch);
			echo json_encode(array('html'=>$str));
		} else
			echo json_encode(array('error'=>'TODO'));
	}

	function p_getIncompleteResultsTable($schID, $includedUsers) {
		// TODO
		$arr = explode(',', $includeUsers);
		$count = count($arr);
		$a = array();
		for ($i=0;$i<$count;$i++)
			$a[] = $arr[$i];
		$sch = getScheduleById($schID);
		if ($sch) {
			echo json_encode(array('html'=>getPersistantResults($sch, $a)));
		} else
			echo json_encode(array('error'=>'TODO'));
	}

/**
 *	WAWschedule
 */
	function p_getScheduleById($schID) {
		// TODO
		$sch = getScheduleById($schID);
		if ($sch) {
			echo json_encode(array('html'=>$sch));
		} else
			echo json_encode(array('error'=>'TODO'));
	}

	function p_addSchedule($userID, $editStr, $alias) {
		// TODO
		global $_USER;
		$user = getUserByEmail($_USER['uid']);
		$startDate = 0;
		$endDate = 0;
		$sch = createSchedule(new GTIGSchedule(-1, $user->getId(), $alias));
		if ($sch) {
			createGrid(new GTIGGrid(-1, $user->getId(), $editStr), $sch->getId(), $user->getId());
			echo json_encode(array('html'=>convertScheduleToLink($sch)));
		} else
			echo json_encode(array('error'=>'There was an error creating the new schedule. Please try again later.'));
	}

	function p_getScheduleByAlias($alias) {
		// TODO
		$arr = explode("<>()__8", $alias);
		$sch = getScheduleById($arr[1]);
		if ($sch && $sch->alias == $arr[0]) {
			echo json_encode(array('html'=>$sch, 'id'=>$sch->getId()));
		} else
			echo json_encode(array('error'=>'TODO'));
	}

/**
 * HTML
 */
	function convertUsersToCheckList($arr) {
		$count = count($arr);
		$str = "<ul>";
		for($i=0;$i<$count;$i++) {
			$str .= "<li>" . $arr[$i]->alias . "</li>";
		}
		return $str . "</ul>";
	}

	function convertScheduesToLinkList($arr) {$count = count($arr);
		$str = "";
		for($i=0;$i<$count;$i++) {
			$str .= convertScheduleToLink($arr[$i]);
		}
		return $str;
	}

	function convertScheduleToLink($sch) {
	 return "<li data-icon='false'><a href='#'onclick='getResultsTable(" . $sch->getID() . ");'>" . $sch->alias . "</a></li>";
	}

	function echo___json_encode($arr) {
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
?>
