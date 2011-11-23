<?php
//test
include_once "GtIsGoodObjects.php";
include_once "Connection.php";
include_once "GtWAWCalendarLibrary.php";

/**
 * GTIGSchedule Services
 */
function addSchedule($editStr,$alias,$userId){
	$con = connectToDb();
	if ($con) {
		$sql = "INSERT INTO `CONTRIB_droptables`.`schedule` ( `createrID`, `alias`) VALUES ('$userId', '$alias');";
		$result = desql($sql);
		$schId= mysql_insert_id($con);
		breakCon($con);
		createGrid(new GTIGGrid(-1,$userId,$editStr), $schId, $userId);
		if ($schId)
			return new GTIGSchedule($schId, $userId, $alias);
	}
	return 0;
}

function createSchedule($sch) {
	$con = connectToDb();
	if ($con) {
		$creatorID = $sch->getCreatorId();
		$alias = $sch->alias;
		$sql = "INSERT INTO `CONTRIB_droptables`.`schedule` ( `createrID`, `alias`) VALUES ('$creatorID', '$alias');";
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
		$sql="SELECT * FROM `CONTRIB_droptables`.`schedule` WHERE `schID`=$id";
		$result = desql($sql);
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
		$sql="SELECT * FROM `CONTRIB_droptables`.`schedule` WHERE `alias`='$alias';";
		$result = desql($sql);
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
		$sql="SELECT * FROM `CONTRIB_droptables`.`schedule`;";
		$result = desql($sql);
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
		$sql="SELECT * FROM `CONTRIB_droptables`.`schedule` WHERE `createrID`=$creatorId;";
		$result = desql($sql);
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
		$sql="SELECT `schedule`.`schID`, `schedule`.`alias`,`schedule`.`createrID` FROM `CONTRIB_droptables`.`schedule` INNER JOIN `CONTRIB_droptables`.`linktable` ON `schedule`.`schID` = `linktable`.`schID` WHERE `linktable`.`userID`=$userId;";
		$result = desql($sql);
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
	$sql="UPDATE `CONTRIB_droptables`.`schedule` SET `alias`='$alias' WHERE `schedule`.`schID`=$id AND `schedule`.`createrID`=$loggedInUserID ;";
	$result=desql($sql);
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
		$sql = "INSERT INTO `CONTRIB_droptables`.`grid` (`data`) VALUES ('$data');";
		$result = desql($sql);
		$id = mysql_insert_id($con);
		if ($id) {
			$sql = "DELETE FROM `CONTRIB_droptables`.`linktable` WHERE `schID` = $schId AND `userID` = $userId;";
			desql($sql);
			$sql = "INSERT INTO `CONTRIB_droptables`.`linktable` (`schID`, `gridID`, `userID`) VALUES ('$schId', '$id', '$userId');";
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
		$sql="SELECT * FROM `CONTRIB_droptables`.`grid`, `CONTRIB_droptables`.`linktable` WHERE `grid`.`gridID`=$gid AND `linktable`.`gridID`=$gid AND `linktable`.`schID`=$sid;";
		$result = desql($sql);
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
		$sql="SELECT * FROM `CONTRIB_droptables`.`grid`, `CONTRIB_droptables`.`linktable` WHERE `grid`.`gridID`=`linktable`.`gridID` AND `linktable`.`schID`=$schId;";
		$result = desql($sql);
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
	$sql="UPDATE `CONTRIB_droptables`.`grid`, `CONTRIB_droptables`.`linktable` SET `grid`.`data`='$data' WHERE `grid`.`gridID`=$id AND `linktable`.`userID`=$loggedInUserID;";
	$result=desql($sql);	
	breakCon($con);
	}
}

function getEditString($id){
	$con = connectToDb();
	if ($con) {
		$sql="SELECT `data` FROM `CONTRIB_droptables`.`grid` WHERE `gridID`=$id;";
		$result = desql($sql);
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
		$sql="UPDATE `CONTRIB_droptables`.`grid` SET `data`='$editStr' WHERE `id`=$id;";
		$result = desql($sql);
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
		$sql = "INSERT INTO `CONTRIB_droptables`.`user` (`username`) VALUES ('$name');";
		$result = desql($sql);
		$id = mysql_insert_id($con);
		breakCon($con);
		if ($id)
			return new GTIGUser($id, $name);
	}
	return 0;
}

function getUserById($id) {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `CONTRIB_droptables`.`user` WHERE `id`=$id;";
		$result = desql($sql);
		$rowcount = mysql_numrows($result);
		if($rowcount<1) {
			global $_USER; 
			return createUser(new GTIGUser(-1, $_USER['uid']));
		}
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
		$sql="SELECT * FROM `CONTRIB_droptables`.`user`;";
		$result = desql($sql);
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
	$id = $row["id"];
	$name = $row["username"];
	return new GTIGUser($id, $name);
}

function updateUser($user, $loggedInUserID) {
	$con = connectToDb();
	if ($con) {
	$name=$user->name;
	$sql="UPDATE `CONTRIB_droptables`.`user` SET `name`='$name' WHERE `user`.`userID`=$loggedInUserID;";
	$result=desql($sql);
	breakCon($con);
	}
}

function getUserByEmail($email) {
	// TODO
	$con = connectToDb();
	if ($con) {
		$sql="SELECT * FROM `CONTRIB_droptables`.`user` WHERE `username`='$email';";
		$result = desql($sql);
		$rowcount = mysql_numrows($result);
		if($rowcount<1) {
			global $_USER; 
			return createUser(new GTIGUser(-1, $_USER['uid']));
		}
		$rtn = parseUserRow(mysql_fetch_array($result));
		breakCon($con);
		return $rtn;
	}
	return 0;
}


/*
 * HTML
 */
function getPersistantResults($sch, $includedUserIDs=0) {
	if ($sch) {
		$grids = getGridsBySchedule($sch->getId());
		$count = count($grids);
		$arr = array();
		for($i=0;$i<$count;$i++) {
			if (!$includedUserIDs || !in_array($grids[$i]->getId(), $grids))
				$arr[] = $grids[$i]->data;
		}
		return generatePersistantCalendarOneResults(0, 7, 0, 24, $arr);
	}
}

?>
