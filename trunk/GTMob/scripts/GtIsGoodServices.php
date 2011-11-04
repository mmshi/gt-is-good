<?php
//test
include_once "GtIsGoodObjects.php";
include_once "Connection.php";

/**
 * GTIGSchedule Services
 */
function createSchedule($sch) {
	$con = connectToDb();
	if ($con) {
		$startDate = dateToString($sch->startDate);
		$endDate = dateToString($sch->endDate);
		$creatorID = $sch->getCreatorId();
		$alias = $sch->alias;
		$type = $sch->type;
		$sql = "INSERT INTO `gtisgood`.`schedule` (`startDate`, `endDate`, `createrID`, `alias`, `periodType`) VALUES ('$startDate', '$endDate', '$creatorID', '$alias', '$type');";
		$result = desql($sql);
		$id = mysql_insert_id($con);
		breakCon($con);
		if ($id)
			return new GTIGSchedule($id, $creatorID, $startDate, $endDate, $alias, $type);
	}
	return 0;
}

function getScheduleById($id) {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `gtisgood`.`schedule` WHERE `schID`=$id";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		if($rowcount<1)return 0;
		$rtn = parseScheduleRow(mysql_fetch_array($result));
		breakCon($con);
		return $rtn;
	}
	return 0;
}

function getScheduleByAlias($alias) {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `gtisgood`.`schedule` WHERE `alias`='$alias';";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		if($rowcount<1)return 0;
		$rtn = parseScheduleRow(mysql_fetch_array($result));
		breakCon($con);
		return $rtn;
	}
	return 0;
}

function getAllSchedules() {
	// TODO
	$con = connectToDb();
	if ($con) {    
		$sql="SELECT * FROM `gtisgood`.`schedule`;";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		$i=0;
		$arr= array();
		while($row = mysql_fetch_array($result))
			$arr[] = parseScheduleRow($row);
		breakCon($con);
	    return $arr;
	}
	return 0;
}

function getAllSchedulesByCreator($creatorId) {
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `gtisgood`.`schedule` WHERE `creatorID`=$creatorId;";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		$i = 0;
		$arr = array();
		while($row = mysql_fetch_array($result))
			$arr[] = parseScheduleRow($row);
		breakCon($con);
		return $arr;
	}
	return 0;
}

/*private*/ function  parseScheduleRow($row) {
	$creatorId = $row["createrID"];
	$startDate= stringToDate($row["startDate"]);
	$endDate= stringToDate($row["endDate"]);
	$id= $row["schID"];
	$type= $row["periodType"];
	$alias = $row["alias"];
	return new GTIGSchedule($id, $creatorId, $startDate, $endDate, $alias, $type);
}

function updateSchedule($sch, $loggedInUserID) {
	$id=$sch->getId();
	$startDate= $sch->startDate;
	$endDate= $sch->endDate;
	$type= $sch->periodType;
	$alias = $sch->alias;
	$sql="UPDATE `gtisgood`.`schedule` SET `startDate`='$startDate', `endDate`='$endDate',`alias`='$alias', `periodType`='$type' WHERE 'schID'=$id AND `creatorID`=$loggedInUserID ;";
	$result=mysql_query($sql);
	if ($result)
		return $sch;
	return 0;
}


/**
 * GTIGGrid Services
 */
function createGrid($grid, $schId, $userId) {
	$con = connectToDb();
	if ($con) {
		$type = $grid->getScheduleType();
		$data = $grid->data;
		$comments = $grid->comments;
		$sql = "INSERT INTO `gtisgood`.`grid` (`data`, `comments`) VALUES ('$data', '$comments');";
		$result = desql($sql);
		$id = mysql_insert_id($con);
		if ($id) {
			$sql = "INSERT INTO `gtisgood`.`linktable` (`schID`, `gridID`, `userID`, `type`) VALUES ('$schId', '$id', '$userId', '$type');";
			desql($sql);
			breakCon($con);
			return new GTIGGrid($id, $userId, $type, $data, $comments);
		}
		breakCon($con);
	}
	return 0;
}

function getGridById($gid) {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `gtisgood`.`grid`, `gtisgood`.`linktable` WHERE `grid`.`gridID`=$gid AND `linktable`.`gridID`=$gid;";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		if($rowcount<1)return 0;
		$rtn = parseGridRow(mysql_fetch_array($result));
		breakCon($con);
		return $rtn;
	}
	return 0;
}

function getGridsBySchedule($schId) {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `gtisgood`.`grid`, `gtisgood`.`linktable` WHERE `grid`.`gridID`=`linktable`.`gridID` AND `linktable`.`schID`=$schId;";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		$i=0;
		$arr = array();
		while($row = mysql_fetch_array($result))
			$arr[] = parseGridRow($row);
		breakCon($con);
		return $arr;
	}
	return 0;
}

/*private*/ function parseGridRow($row) {
	$id= $row["gridID"];
	$userId= $row["userID"];
	$type= $row["type"];
	$data= $row["data"];
	$comments= $row["comments"];
	return new GTIGGrid($id, $userId, $type, $data, $comments);
}

function updateGrid($grid, $loggedInUserID) {
	$id= $grid->getId();
	$type= $grid->getScheduleType();
	$data= $grid->data;
	$comments= $grid->comments;
	$sql="UPDATE `gtisgood`.'grid','gtisgood'.'linktable' SET 'type'='%type','data'='$data','comments'='$comments' WHERE 'gridID'=$id AND 'userID'=$loggedInUserID;";
	$result=mysql_query($sql);	
	if ($result)
		return $grid;
	return 0;
}


/**
 * GTIGUser Services
 */
function createUser($user) {
	$con = connectToDb();
	if ($con) {
		$name = $user->name;
		$email = $user->email;
		$password = $user->password;
		$pullFromTSquare = $user->pullFromTSquare;
		$sql = "INSERT INTO `gtisgood`.`user` (`name`, `email`, `password`, `fromTSquare`) VALUES ('$name', '$email', '$password', $pullFromTSquare);";
		$result = desql($sql);
		$id = mysql_insert_id($con);
		breakCon($con);
		if ($id)
			return new GTIGUser($id, $name, $email, $password, $pullFromTSquare);
	}
	return 0;
}

function getUserById($id) {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `gtisgood`.`user` WHERE `userID`=$id;";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		if($rowcount<1)return 0;
		$rtn = parseUserRow(mysql_fetch_array($result));
		breakCon($con);
		return $rtn;
	}
	return 0;
}

function getUserByEmail($email) {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `gtisgood`.`user` WHERE `email`='$email';";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		if($rowcount<1)return null;
		$rtn = parseUserRow(mysql_fetch_array($result));
		breakCon($con);
		return $rtn;
	}
	return 0;
}

function getAllUsers() {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `gtisgood`.`user`;";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		$i=0;
		$arr= array($rowcount);
		while($row = mysql_fetch_array($result))
			$arr[] = parseUserRow($row);
			breakCon($con);
	    return $arr;
	}
	return 0;
}

/*private*/ function parseUserRow($row) {
	$id = $row["userID"];
	$name = $row["name"];
	$email = $row["email"];
	$password = $row["password"];
	$fromTsquare = $row["fromTSquare"];
	return new GTIGUser($id, $name,$email,$password,$fromTsquare);
}

function updateUser($user, $loggedInUserID) {
	$name=$user->name;
	$email=$user->email;
	$password=$user->password;
	$fromTsquare = $user->fromTsquare;
	$sql="UPDATE `gtisgood`.`user` SET `name`='$name', `email`='$email', `password`='$email', `fromTSquare`='$fromTsquare' WHERE 'userID'=$loggedInUserID;";
	$result=mysql_query($sql);
	if ($result)
		return $user;
	return 0;
}

/**
 * OTHER
 */
function stringToDate($date) {
	return date_create(date('D, d M Y H:i:s'), $date);
}

function dateToString($date) {
	return $date->format('Y-m-d H:i:s');
}

?>