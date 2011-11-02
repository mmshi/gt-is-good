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
		$startDate = $sch->startDate;//->format('Y-m-d H:i:s');
		$endDate = $sch->endDate;//->format('Y-m-d H:i:s');
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
	$startDate= $row["startDate"];
	$endDate= $row["endDate"];
	$id= $row["schID"];
	$type= $row["periodType"];
	$alias = $row["alias"];
	return new GTIGSchedule($id, $creatorId, $startDate, $endDate, $alias, $type);
}

function updateSchedule($sch, $loggedInUserID) {
	$con = connectToDb();
	if ($con) {
	$id=$sch->getId();
/*$sql="SELECT `createrID` FROM `gtisgood`.`schedule` WHERE `creatorID`=$loggedInUserID AND `schID`=$id;"
$result=mysql_query($sql);
$rowcount=mysql_numrows($result);*/
	$startDate= $sch->startDate;
	$endDate= $sch->endDate;
	$type= $sch->type;
	$alias = $sch->alias;
/*while($row = mysql_fetch_array($result)){
$id=$row["schID"];*/
	$sql="UPDATE `gtisgood`.`schedule` SET `startDate`='$startDate', `endDate`='$endDate',`alias`='$alias', `periodType`='$type' WHERE `schedule`.`schID`=$id AND `schedule`.`createrID`=$loggedInUserID ;";
	$result=mysql_query($sql);
	breakCon($con);
	}
/*}*/
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

function getGridById($gid, $sid) {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `gtisgood`.`grid`, `gtisgood`.`linktable` WHERE `grid`.`gridID`=$gid AND `linktable`.`gridID`=$gid AND `linktable`.`schID`=$sid;";
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
	$con = connectToDb();
	if ($con) {
	$id= $grid->getId();
	$type= $grid->getScheduleType();
	$data= $grid->data;
	$comments= $grid->comments;
	$sql="UPDATE `gtisgood`.`grid`, `gtisgood`.`linktable` SET `linktable`.`type`='$type',`grid`.`data`='$data',`grid`.`comments`='$comments' WHERE `grid`.`gridID`=$id AND `linktable`.`userID`=$loggedInUserID;";
echo($sql);
	$result=mysql_query($sql);	
	breakCon($con);
	}
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
	$con = connectToDb();
	if ($con) {
	$name=$user->name;
	$email=$user->email;
	$password=$user->password;
	$fromTsquare = $user->fromTsquare;
	$sql="UPDATE `gtisgood`.`user` SET `name`='$name', `email`='$email', `password`='$password', `fromTSquare`='$fromTsquare' WHERE `user`.`userID`=$loggedInUserID;";
	$result=mysql_query($sql);
	breakCon($con);
	}
}

?>