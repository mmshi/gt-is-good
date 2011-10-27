<?php
//test
include_once "GtIsGoodObjects.php";

/**
 * GTIGSchedule Services
 */
function getScheduleById($id) {
	// TODO
	$sql="SELECT * FROM `gtisgood`.`schedule` WHERE `schID`=$id";
	$result = mysql_query($sql);
	$rowcount = mysql_numrows($result);
	if($rowcount<1)return null;
	return parseScheduleRow(mysql_fetch_array($result));
}

function getScheduleByAlias($alias) {
	// TODO
	$sql="SELECT * FROM `gtisgood`.`schedule` WHERE `alias`='$alias';";
	$result = mysql_query($sql);
	$rowcount = mysql_numrows($result);
	if($rowcount<1)return null;
	return parseScheduleRow(mysql_fetch_array($result));
}

function getAllSchedules() {
        // TODO
	$sql="SELECT * FROM `gtisgood`.`schedule`;";
	$result = mysql_query($sql);
	$rowcount = mysql_numrows($result);
	$i=0;
	$arr= array();
	while($row = mysql_fetch_array($result))
		$arr[] = parseScheduleRow($row);
    return $arr;
}

function getAllSchedulesByCreator($creatorId) {
	$sql="SELECT * FROM `gtisgood`.`schedule` WHERE `creatorID`=$creatorId;";
	$result = mysql_query($sql);
	$rowcount = mysql_numrows($result);
	$i = 0;
	$arr = array();
	while($row = mysql_fetch_array($result))
		$arr[] = parseScheduleRow($row);
	return $arr;
}

function  parseScheduleRow($row) {
	$creatorId = $row["creatorID"];
	$startDate= $row["startDate"];
	$endDate= $row["endDate"];
	$id= $row["schID"];
	$type= $row["periodType"];
	return new GTIGSchedule($id, $createrId, $startDate, $endDate, $alias, $type);
}


/**
 * GTIGGrid Services
 */
function getGridById($gid, $sid) {
	// TODO
	$sql="SELECT * FROM `gtisgood`.`grid`, `gtisgood`.`linktable` WHERE `grid`.`gridID`=$gid AND `linktable`.`gridID`=$gid AND `linktable`.`schID`=$sid;";
	$result = mysql_query($sql);
	$rowcount = mysql_numrows($result);
	if($rowcount<1)return null;
	return parseGridRow(mysql_fetch_array($result));
}

function getGridsBySchedule($schId) {
	// TODO
	$sql="SELECT * FROM `gtisgood`.`grid`, `gtisgood`.`linktable` WHERE `grid`.`gridID`=`linktable`.`gridID` AND `linktable`.`schID`=$sid;";
	$result = mysql_query($sql);
	$rowcount = mysql_numrows($result);
	$i=0;
	$arr = array();
	while($row = mysql_fetch_array($result))
		$arr[] = parseGridRow($row);
	return $arr;
}

// PRIVATE
function parseGridRow($row) {
	$id= $row["gridID"];
	$userId= $row["userID"];
	$type= $row["type"];
	$data= $row["data"];
	$comments= $row["comments"];
	return new GTIGGrid($id, $userId, $type, $data, $comments);
}


/**
 * GTIGUser Services
 */
function getUserById($id) {
	// TODO
	$sql="SELECT * FROM `gtisgood`.`user` WHERE `userID`=$id;";
	$result = mysql_query($sql);
	$rowcount = mysql_numrows($result);
	if($rowcount<1)return null;
	return parseUserRow(mysql_fetch_array($result));
}

function getUserByEmail($email) {
	// TODO
	$sql="SELECT * FROM `gtisgood`.`user` WHERE `email`='$email';";
	$result = mysql_query($sql);
	$rowcount = mysql_numrows($result);
	if($rowcount<1)return null;
	return parseUserRow(mysql_fetch_array($result));
}

function getAllUsers() {
	// TODO
	$sql="SELECT * FROM `gtisgood`.`user`;";
	$result = mysql_query($sql);
	$rowcount = mysql_numrows($result);
	$i=0;
	$arr= array($rowcount);
	while($row = mysql_fetch_array($result))
		$arr[] = parseUserRow($row);
    return $arr;
}

// PRIVATE
function parseUserRow($row) {
	$id = $row["userID"];
	$name = $row["name"];
	$email = $row["email"];
	$password = $row["password"];
	$fromTsquare = $row["fromTsquare"];
	return new GTIGUser($id, $name,$email,$password,$fromTsquare);
}

?>
