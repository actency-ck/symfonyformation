<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

class TaskOld implements GroupSequenceProviderInterface {

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
   */
  private $dueDate;

  protected $priority;

  private $image;

  private $author;

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

  /**
   * @return mixed
   */
  public function getPriority() {
    return $this->priority;
  }

  /**
   * @param mixed $priority
   */
  public function setPriority($priority): void {
    $this->priority = $priority;
  }

  /**
   * Returns which validation groups should be used for a certain state
   * of the object.
   *
   * @return string[]|GroupSequence An array of validation groups
   */
  public function getGroupSequence() {
    // TODO: Implement getGroupSequence() method.
  }

  /**
   * @return mixed
   */
  public function getImage() {
    return $this->image;
  }

  /**
   * @param mixed $image
   */
  public function setImage($image): void {
    $this->image = $image;
  }

  /**
   * @return mixed
   */
  public function getAuthor() {
    return $this->author;
  }

  /**
   * @param mixed $author
   */
  public function setAuthor($author): void {
    $this->author = $author;
  }

}