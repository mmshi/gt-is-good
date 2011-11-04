<?php
//test
include_once "GtIsGoodObjects.php";
include_once "Connection.php";

/**
 * GTIGSchedule Services
 */
function addSchedule($editStr,$alias,$userId){
	$con = connectToDb();
	if ($con) {
		$sql = "INSERT INTO `gtisgood`.`schedule` ( `creatorID`, `alias`) VALUES ('$userId', '$alias');";
		$result = desql($sql);
		$schId= mysql_insert_id($con);
		breakCon($con);
		createGrid(new GTIGGrid(-1,$id,$editStr), $schId, $userId);
		if ($schId)
			return new GTIGSchedule($schId, $creatorID, $alias);
	}
	return 0;
}

function createSchedule($sch) {
	$con = connectToDb();
	if ($con) {
		$creatorID = $sch->getCreatorId();
		$alias = $sch->alias;
		$sql = "INSERT INTO `gtisgood`.`schedule` ( `creatorID`, `alias`) VALUES ('$creatorID', '$alias');";
		$result = desql($sql);
		$id = mysql_insert_id($con);
		breakCon($con);
		if ($id)
			return new GTIGSchedule($id, $creatorID, $alias);
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

function getSchedulesByUserId($userId){
	$con = connectToDb();
	if ($con) {
		$sql="SELECT `schedule`.`schID`, `schedule`.`alias`,`schedule`.`creatorID` FROM `gtisgood`.`schedule`,`gtisgood`.`linktable` WHERE `linktable`.`userID`=$userId;";
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
	$id= $row["schID"];
	$alias = $row["alias"];
	return new GTIGSchedule($id, $creatorId, $alias);
}

function updateSchedule($sch, $loggedInUserID) {
	$con = connectToDb();
	if ($con) {
	$id=$sch->getId();
	$alias = $sch->alias;
	$sql="UPDATE `gtisgood`.`schedule` SET `alias`='$alias' WHERE `schedule`.`schID`=$id AND `schedule`.`creatorID`=$loggedInUserID ;";
	$result=mysql_query($sql);
	breakCon($con);
	}
}


/**
 * GTIGGrid Services
 */
function createGrid($grid, $schId, $userId) {
	$con = connectToDb();
	if ($con) {
		$data = $grid->data;
		$sql = "INSERT INTO `gtisgood`.`grid` (`data`) VALUES ('$data');";
		$result = desql($sql);
		$id = mysql_insert_id($con);
		if ($id) {
			$sql = "INSERT INTO `gtisgood`.`linktable` (`schID`, `gridID`, `userID`) VALUES ('$schId', '$id', '$userId');";
			desql($sql);
			breakCon($con);
			return new GTIGGrid($id, $userId, $data);
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
	$data= $row["data"];
	return new GTIGGrid($id, $userId, $data);
}

function updateGrid($grid, $loggedInUserID) {
	$con = connectToDb();
	if ($con) {
	$id= $grid->getId();
	$data= $grid->data;
	$sql="UPDATE `gtisgood`.`grid`, `gtisgood`.`linktable` SET `grid`.`data`='$data' WHERE `grid`.`gridID`=$id AND `linktable`.`userID`=$loggedInUserID;";
	$result=mysql_query($sql);	
	breakCon($con);
	}
}

function getEditString($id){
	$con = connectToDb();
	if ($con) {
		$sql="SELECT `data` FROM `gtisgood`.`grid` WHERE `gridID`=$id;";
		$result = mysql_query($sql);
		$rowcount = mysql_numrows($result);
		if($rowcount<1)return 0;
		$rtn = mysql_fetch_array($result);
		$rtn=$rtn["data"];
		breakCon($con);
		return $rtn;
	}
	return 0;
}

function addEditString($editStr,$id){
	$con = connectToDb();
	if ($con) {
		$sql="UPDATE `gtisgood`.`grid` SET `data`='$editStr' WHERE `id`=$id;";
		$result = mysql_query($sql);
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
		$sql = "INSERT INTO `gtisgood`.`user` (`name`, `email`) VALUES ('$name', '$email');";
		$result = desql($sql);
		$id = mysql_insert_id($con);
		breakCon($con);
		if ($id)
			return new GTIGUser($id, $name, $email);
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
	return new GTIGUser($id, $name,$email);
}

function updateUser($user, $loggedInUserID) {
	$con = connectToDb();
	if ($con) {
	$name=$user->name;
	$email=$user->email;
	$sql="UPDATE `gtisgood`.`user` SET `name`='$name', `email`='$email' WHERE `user`.`userID`=$loggedInUserID;";
	$result=mysql_query($sql);
	breakCon($con);
	}
}

?>
