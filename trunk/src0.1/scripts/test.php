<?php
include_once "GtIsGoodServices.php";
function test(){
	$con=connectToDb();
	if($con){
	$sch=new GTIGSchedule(0, 1, '2011-11-01 20:23:17',  '2011-11-02 20:23:24',  'test1',  '30min');
	$grid=new GTIGGrid(1, 1, 'userSchedule',  'This is not only a test data but also a data test.This is not only a test data but also a data test.This is not only a test data but also a data test.',  'Sounds good');
	$user=new GTIGUser(0,'testuser1',  'testuser1@test.com',  'test',  1);
	echo("Testing create<br/>");
	$sch= createSchedule($sch);
	echo("Schedule created: ".$sch->getId()." <br/>");
	$user= createUser($user);
	echo("User created: ".$user->getId()." <br/>");
	$grid= createGrid($grid,$sch->getId(),$user->getId());
	echo("Grid created: ".$grid->getId()." for user ".$grid->getUserId()." <br/> ");
	echo("Testing retrieve<br/>");
	$sch2= getScheduleById(1);
	$grid2= getGridById(1,1);
	$user2= getUserById(1);
	echo("Testing update<br/>");
	$sch3=new GTIGSchedule(1, 3, '2011-11-01 20:23:17',  '2011-11-04 20:23:24',  'test3',  '1hour');	
	$grid3=new GTIGGrid(1, 1, 'constraint',  "That is not only a test data but also a data test.There is not only a test data but also a data test.There is not only a test data but also a data test.",  "Thats so bad. Id miss the test.");
	$user3=new GTIGUser(1,'testuser2',  'testuser2@test.com',  'wtf',  0);
	updateSchedule($sch3,1);
	updateUser($user3,1);
	updateGrid($grid3,1);
	echo("Testing complete<br/>");

	}
}
test();
?>