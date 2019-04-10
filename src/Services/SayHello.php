<?php

namespace App\Services;

use Symfony\Contracts\Translation\TranslatorInterface;

class SayHello {

  private $translator;

  public function __construct(TranslatorInterface $translator) {
    $this->translator = $translator;
  }

  public function sayHello() {
    return 'Hello';
  }

  public function saySfIsGreat() {
    return $this->translator->trans('symfony_is_great');
  }

}