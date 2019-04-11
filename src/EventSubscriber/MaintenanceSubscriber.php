<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class MaintenanceSubscriber implements EventSubscriberInterface {

  private $twig;

  public function __construct(Environment $twig) {
    $this->twig = $twig;
  }

  /**
   * Returns an array of event names this subscriber wants to listen to.
   *
   * The array keys are event names and the value can be:
   *
   *  * The method name to call (priority defaults to 0)
   *  * An array composed of the method name to call and the priority
   *  * An array of arrays composed of the method names to call and respective
   *    priorities, or 0 if unset
   *
   * For instance:
   *
   *  * ['eventName' => 'methodName']
   *  * ['eventName' => ['methodName', $priority]]
   *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
   *
   * @return array The event names to listen to
   */
  public static function getSubscribedEvents() {
    return [
      //KernelEvents::RESPONSE => 'methodCallOnKernelResponseEvent',
    ];
  }

  public function methodCallOnKernelResponseEvent(FilterResponseEvent $event) {
    $view = $this->twig->render('demo/maintenance.html.twig');
    $response = $event->getResponse();
    $response->setStatusCode(Response::HTTP_SERVICE_UNAVAILABLE);
    $response->setContent($view);
  }

}