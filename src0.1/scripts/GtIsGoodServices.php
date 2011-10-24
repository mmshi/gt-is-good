<?php
//test
include_once "GtIsGoodObjects.php";

/**
 * GTIGSchedule Services
 */
function getScheduleById($id) {
	// TODO
	return new GTIGSchedule($id, 1, date_create(date('D, d M Y H:i:s')), date_create(date('D, d M Y H:i:s')), "Sample Schedule: $id", GTIGScheduleTypes::HALFHOUR);
}

function getSchedulesByAlias($alias) {
	// TODO
	return new GTIGSchedule(1, 1, date_create(date('D, d M Y H:i:s')), date_create(date('D, d M Y H:i:s')), $alias, GTIGScheduleTypes::HALFHOUR);
}

function getAllSchedules() {
	// TODO
	$arr = array();
	for ($i=0;$i<10;$i++)
		$arr[] = getScheduleById($id);
	return $arr;
}

function getAllSchedulesByCreator($creatorId) {
	// TODO
	return getAllSchedules();
}


/**
 * GTIGGrid Services
 */
function getGridById($id) {
	// TODO
	return new GTIGGrid($id, 1, GTIGGridTypes::SCHEDULE, "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA", ""); // 8-11 x 4
}

function getGridsBySchedule($schId) {
	// TODO
	$arr = array();
	for ($i=0;$i<10;$i++)
		$arr[] = getGridById($id);
	return $arr;
}


/**
 * GTIGUser Services
 */
function getUserById($id) {
	// TODO
	return new GTIGUser($id, "David", "", "", 0);
}

function getUserByEmail($email) {
	// TODO
	return getUserById(1);
}

function getAllUsers() {
	// TODO
	$arr = array();
	for ($i=0;$i<10;$i++)
		$arr[] = getUserById($id);
	return $arr;
}

?>