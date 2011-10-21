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

class GTIGGrid {

  private $id;
  private $userId;
  public $data;
  public $comments;

  function __construct($id, $userId, $data, $comments) {
    $this->id = $id;
    $this->userId = $userId;
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