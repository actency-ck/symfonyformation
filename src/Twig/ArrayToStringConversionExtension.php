<?php

namespace App\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ArrayToStringConversionExtension extends AbstractExtension {

  private $requestStack;

  public function __construct(RequestStack $requestStack) {
    $this->requestStack = $requestStack;
  }

  public function getFilters() {
    return [
      new TwigFilter('convert_to_string', [$this, 'arrayToString']),
    ];
  }

  public function arrayToString(array $content, string $glue = ',') {
    $getSeparator = $this->requestStack->getCurrentRequest()->get('separator');
    if ($getSeparator != '') {
      $glue = $getSeparator;
    }
    $toString = implode($glue, $content);
    return $toString;
  }

}