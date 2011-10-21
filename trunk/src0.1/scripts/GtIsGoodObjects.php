<?php

abstract class GTIGScheduleTypes {
  public const DAY 	= 0;
  public const HOUR 	= 1;
  public const HALFHOUR = 2;
}

class GTIGSchedule {

  private $id;
  private $creatorId
  public $startDate;
  public $endDate;
  public $alias;
  public $type;		// GTIGScheduleTypes

  function __construct($id, $creatorId, $startDate, $endDate, $alias='NULL', $type=GTIGScheduleTypes->HALFHOUR){
    $this->id = $id;
    $this->creatorId = $creatorId;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->alias = $alias;
    $this->type = $type;
  }

  function getId() {
    return $this->id;
  }

  function getCreatorId() {
    return $this->creatorId;
  }

  function getCreator() {
    // TODO
  }

  function getConstraintsGrid() {
    // TODO
  }

  function getAllGrids() {
    // TODO
  }

  function saveToDb() {
    // TODO
  }
}

abstract class GTIGGridTypes {
  public const CONSTRAINT = 0;
  public const SCHEDULE   = 1;
}

class GTIGGrid {

  private $id;
  private $userId;
  private $type; 	// GTIGGridTypes
  public $data;
  public $comments;

  function __construct($id, $userId, $type, $data, $comments) {
    $this->id = $id;
    $this->userId = $userId;
    $this->type = $type;
    $this->data = $data;
    $this->comments = $comments;
  }

  function getId() {
    return $this->id;
  }

  function getUserId() {
    return $this->userId;
  }

  function getUser() {
    // TODO
  }

  function getScheduleType() {
    return $this->type;
  }

  function saveToDb() {
    // TODO
  }
}

class GTIGUser {

  private $id;
  public $name;
  public $email;
  public $password;
  public $pullFromTSquare;

  function __construct($id, $name, $email, $password, $pullFromTSquare) {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->pullFromTSquare = $pullFromTSquare;
  }

  function getId() {
    return $this->id;
  }

  function getAllSchedules() {
    // TODO
  }

  function getAllCreatedSchedules() {
    // TODO
  }

  function saveToDb() {
    // TODO
  }
}

?>