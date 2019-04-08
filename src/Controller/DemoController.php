<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
  /**
   * @Route("/demo/{name}", name="demo")
   */
    public function index($name)
    {
        return $this->render('demo/index.html.twig', [
            'name' => $name,
        ]);
    }

  /**
   * @Route("/details/{name}", name="details")
   */
    public function details($name, SessionInterface $session)
    {
      $session->set('name', $name);
      return $this->render('demo/details.html.twig', [
        'name' => $name,
      ]);
    }

  /**
   * @Route("/list-names", name="list_names")
   */
    public function listNames(SessionInterface $session, Request $request)
    {
      $route = $request->get('_route');
      $previous_name = $session->get('name');
      $names = ['John', 'Smaine', 'Fabien', 'Nicolas'];
      return $this->render('demo/list_names.html.twig', [
        'route' => $route,
        'previous_name' => $previous_name,
        'names' => $names,
      ]);
    }

}
