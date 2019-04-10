<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Task {

  /**
   * @Assert\Length(
   *      min = 2,
   *      max = 50,
   *      minMessage = "The name must be at least {{ limit }} characters long",
   *      maxMessage = "The name cannot be longer than {{ limit }} characters"
   * )
   */
  protected $name;

  /**
   * @Assert\Date
   * @var string A "Y-m-d" formatted value
   */
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