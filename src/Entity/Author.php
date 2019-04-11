<?php

namespace App\Entity;

class Author {

  private $userName;
  private $email;

  /**
   * @return mixed
   */
  public function getUserName() {
    return $this->userName;
  }

  /**
   * @param mixed $userName
   */
  public function setUserName($userName): void {
    $this->userName = $userName;
  }

  /**
   * @return mixed
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param mixed $email
   */
  public function setEmail($email): void {
    $this->email = $email;
  }

}