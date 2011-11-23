<?php
include_once "GtIsGoodServices.php";
function test(){
	//$con=connectToDb();
	if($con){
	$sch=new GTIGSchedule(0, 1,  'test1');
	$grid=new GTIGGrid(1, 1,  'This is not only a test data but also a data test.This is not only a test data but also a data test.This is not only a test data but also a data test.',  'Sounds good');
	$user=new GTIGUser(0,'testuser1',  'testuser1@test.com');
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
	$sch3=new GTIGSchedule(1, 3,  'test3');	
	$grid3=new GTIGGrid(1, 1, "That is not only a test data but also a data test.There is not only a test data but also a data test.There is not only a test data but also a data test.",  "Thats so bad. Id miss the test.");
	$user3=new GTIGUser(1,'testuser2',  'testuser2@test.com');
	updateSchedule($sch3,1);
	updateUser($user3,1);
	updateGrid($grid3,1);
	echo("Testing new methods<br/>");
	addSchedule("something long long long long long","foreveralone",1);
echo("addSchedule<br/>");
	$arr4=getSchedulesByUserId(1);
echo("getSchedulesByUserId <br/>");
	addEditString("something long long long long lang",1);
echo("addEditString <br/>");
	getEditString(1);
echo("getEditString <br/>");
	echo("Testing complete<br/>");

	}
}
test();
?>