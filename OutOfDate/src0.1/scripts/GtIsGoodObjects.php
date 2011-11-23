<?php


class GTIGSchedule {

  private $id;
  private $creatorId;
  public $alias;	// GTIGScheduleTypes

  function __construct($id, $creatorId, $alias='NULL'){
    $this->id = $id;
    $this->creatorId = $creatorId;
    $this->alias = $alias;
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

  function __construct($id, $userId, $data) {
    $this->id = $id;
    $this->userId = $userId;
    $this->data = $data;
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

  function __construct($id, $name, $email) {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
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