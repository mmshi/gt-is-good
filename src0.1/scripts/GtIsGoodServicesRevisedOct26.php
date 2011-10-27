<?php
//test
include_once "GtIsGoodObjects.php";

/**
 * GTIGSchedule Services
 */
function getScheduleById($id) {
	// TODO
$sql="SELECT * FROM schedule WHERE schID=/'".$id;
$result = mysql_query($sql);
$rowcount = mysql_numrows($result);
if($rowcount<1)return null;
$creatorId= mysql_result($result, 0, "creatorID");
$startDate= mysql_result($result, 0, "startDate");
$endDate= mysql_result($result, 0, "endDate");
$alias= mysql_result($result, 0, "alias");
$type= mysql_result($result, 0, "periodType");
	return new GTIGSchedule($id, $createrId, $startDate, $endDate, $alias, $type);
}

function getSchedulesByAlias($alias) {
	// TODO
$sql="SELECT * FROM schedule WHERE alias=/'".$alias;
$result = mysql_query($sql);
$rowcount = mysql_numrows($result);
if($rowcount<1)return null;
$creatorId= mysql_result($result, 0, "creatorID");
$startDate= mysql_result($result, 0, "startDate");
$endDate= mysql_result($result, 0, "endDate");
$id= mysql_result($result, 0, "schID");
$type= mysql_result($result, 0, "periodType");

	return new GTIGSchedule($id, $createrId, $startDate, $endDate, $alias, $type);
}

function getAllSchedules() {
	// TODO
$sql="SELECT * FROM schedule";
$result = mysql_query($sql);
$rowcount = mysql_numrows($result);
$i=0;
arr= new array($rowcount);
while($i<$rowcount){
$creatorId= mysql_result($result, $i, "creatorID");
$startDate= mysql_result($result, $i, "startDate");
$endDate= mysql_result($result, $i, "endDate");
$id= mysql_result($result, $i, "schID");
$type= mysql_result($result, $i, "periodType");
$arr[$i] = new GTIGSchedule($id, $createrId, $startDate, $endDate, $alias, $type);
}
	return $arr;
}

function getAllSchedulesByCreator($creatorId) {
$sql="SELECT * FROM schedule WHERE creatorID=/'".$creatorId;
$result = mysql_query($sql);
$rowcount = mysql_numrows($result);
$i=0;
arr= new array($rowcount);
while($i<$rowcount){
$creatorId= mysql_result($result, $i, "creatorID");
$startDate= mysql_result($result, $i, "startDate");
$endDate= mysql_result($result, $i, "endDate");
$id= mysql_result($result, $i, "schID");
$type= mysql_result($result, $i, "periodType");
$arr[$i] = new GTIGSchedule($id, $createrId, $startDate, $endDate, $alias, $type);
}
	return $arr;
}


/**
 * GTIGGrid Services
 */
function getGridById($id) {
	// TODO
$sql="SELECT * FROM grid,linktable WHERE gridID=/'".$id;
$result = mysql_query($sql);
$rowcount = mysql_numrows($result);
if($rowcount<1)return null;
$userId= mysql_result($result, 0, "userID");
$type= mysql_result($result, 0, "type");
$data= mysql_result($result, 0, "data");
$comments= mysql_result($result, 0, "comments");

	return new GTIGGrid($id, $userId, $type, $data, $comments);

}

function getGridsBySchedule($schId) {
	// TODO
$sql="SELECT * FROM grid,linktable WHERE schID=/'".$schId;
$result = mysql_query($sql);
$rowcount = mysql_numrows($result);
$i=0;
arr= new array($rowcount);
while($i<$rowcount){
$id= mysql_result($result, 0, "gridID");
$userId= mysql_result($result, 0, "userID");
$type= mysql_result($result, 0, "type");
$data= mysql_result($result, 0, "data");
$comments= mysql_result($result, 0, "comments");

$arr[$i] = new GTIGGrid($id, $userId, $type, $data, $comments);
}

	return $arr;
}


/**
 * GTIGUser Services
 */
function getUserById($id) {
	// TODO
$sql="SELECT * FROM user WHERE userID=/'".$id;
$result = mysql_query($sql);
$rowcount = mysql_numrows($result);
if($rowcount<1)return null;
$id= mysql_result($result, 0, "userID");
$name= mysql_result($result, 0, "name");
$email= mysql_result($result, 0, "email");
$password= mysql_result($result, 0, "password");
$fromTsquare= mysql_result($result, 0, "fromTsquare");

	return new GTIGUser($id, $name,$email,$password,$fromTsquare);
}

function getUserByEmail($email) {
	// TODO
$sql="SELECT * FROM user WHERE email=/'".$email;
$result = mysql_query($sql);
$rowcount = mysql_numrows($result);
if($rowcount<1)return null;
$id= mysql_result($result, 0, "userID");
$name= mysql_result($result, 0, "name");
$email= mysql_result($result, 0, "email");
$password= mysql_result($result, 0, "password");
$fromTsquare= mysql_result($result, 0, "fromTsquare");

	return new GTIGUser($id, $name,$email,$password,$fromTsquare);

}

function getAllUsers() {
	// TODO
$sql="SELECT * FROM user";
$result = mysql_query($sql);
$rowcount = mysql_numrows($result);
$i=0;
arr= new array($rowcount);
while($i<$rowcount){
$id= mysql_result($result, 0, "userID");
$name= mysql_result($result, 0, "name");
$email= mysql_result($result, 0, "email");
$password= mysql_result($result, 0, "password");
$fromTsquare= mysql_result($result, 0, "fromTsquare");

$arr[$i] = new GTIGUser($id, $name,$email,$password,$fromTsquare);
}
	return $arr;
}

?>