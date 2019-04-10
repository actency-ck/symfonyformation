<?php

namespace App\Services;

use Symfony\Contracts\Translation\TranslatorInterface;

class SayHello {

  private $translator;

  /**
   * SayHello constructor.
   *
   * @param \Symfony\Contracts\Translation\TranslatorInterface $translator
   */
  public function __construct(TranslatorInterface $translator) {
    $this->translator = $translator;
  }

  /**
   * @return string
   */
  public function sayHello(): string {
    return 'Hello';
  }

  /**
   * @return string
   */
  public function saySfIsGreat(): string {
    return $this->translator->trans('symfony_is_great');
  }

}