<?php

namespace App\Entity;

class Task {

  private $name;

  private $dueDate;

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name): void {
    $this->name = $name;
  }

  /**
   * @return mixed
   */
  public function getDueDate() {
    return $this->dueDate;
  }

  /**
   * @param mixed $dueDate
   */
  public function setDueDate($dueDate): void {
    $this->dueDate = $dueDate;
  }

}