<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class DemoController extends AbstractController
{

  /**
   * @Route("/demo/{name}", name="demo")
   * @param $name
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function index($name)
    {
        return $this->render('demo/index.html.twig', [
            'name' => $name,
        ]);
    }

  /**
   * @Route("/details/{name}", name="details")
   * @param $name
   * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function details($name, SessionInterface $session)
    {
      $session->set('name', $name);
      return $this->render('demo/details.html.twig', [
        'name' => $name,
      ]);
    }

  /**
   * @Route("/{_locale}/list-names", name="list_names", requirements={"_locale": "en|fr"})
   * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function listNames(SessionInterface $session, Request $request)
    {
      $route = $request->get('_route');
      $previous_name = $session->get('name');
      $names = ['John', 'Smaine', 'Fabien', 'Nicolas', 'Christophe'];
      return $this->render('demo/list_names.html.twig', [
        'route' => $route,
        'previous_name' => $previous_name,
        'names' => $names,
      ]);
    }

}
