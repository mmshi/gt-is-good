<?php

include_once "GtIsGoodObjects.php";
include_once "GtIsGoodServices.php";

createMyUser();
createMySchedule(getUserById(1));
createMyGrid(getUserById(1), getScheduleById(1));

function createMyGrid($user, $schedule) {
	$grid = new GTIGGrid(-1, $user->getId(), GTIGGridTypes::CONSTRAINT, "AAAAAAAAAAABBBBBBBBAAAAAAAAA", "No Comment");
	formattedPrint($grid, '$grid');
	
	$dbGrid = createGrid($grid, $schedule->getId(), $user->getId());
	
	if ($dbGrid)
		formattedPrint(getScheduleById($dbGrid->getId()), 'getScheduleById($dbGrid->getId())');
	else
		echo "Grid is null.";
		
	createGrid($grid, $schedule->getId(), $user->getId());
	
	formattedPrint(getGridsBySchedule(1), 'getGridsBySchedule(1)');
}

function createMySchedule($user) {
	$sch = new GTIGSchedule(-1, $user->getId(), date_create(date('D, d M Y H:i:s')), date_create(date('D, d M Y H:i:s')), "MySchedule", GTIGScheduleTypes::HALFHOUR);
	formattedPrint($sch, '$sch');
	
	$dbSch = createSchedule($sch);
	
	if ($dbSch)
		formattedPrint(getScheduleById($dbSch->getId()), 'getScheduleById($dbSch->getId())');
	else
		echo "Schedule is null.";
}

function createMyUser() {
	
	//$user = new GTIGUser($id, $name, $email, $password, $pullFromTSquare);
	$user = new GTIGUser(-1, 'David', 'email@gmail.com', 'password', 0);
	formattedPrint($user, '$user');
	
	$dbUser = createUser($user);
	
	if ($dbUser)
		formattedPrint(getUserById($dbUser->getId()), 'getUserById($dbUser->getId())');
	else
		echo "User is null.";
}

function formattedPrint($obj, $header) {
	if ($obj) {
		echo "<br /><h2>$header</h2><pre>";
		print_r($obj);
		echo "</pre><br />";
	}
}