<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

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

  /**
   * @Route("/add-task", name="add_task")
   */
    public function addTask(Request $request, SessionInterface $session)
    {
      $task = new Task();

      if ($currentTask = $session->get('task')) {
        $options['data'] = $currentTask;
      }

      $form = $this->createForm(TaskType::class, $task, $options);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $session->set('task', $form->getData());
        return $this->redirectToRoute('show_task');
      }

      return $this->render('demo/add_task.html.twig', [
        'form' => $form->createView(),
      ]);
    }

  /**
   * @Route("/show-task", name="show_task")
   */
    public function showTask(SessionInterface $session)
    {
      $task = $session->get('task');
      return $this->render('demo/show_task.html.twig', [
        'task' => $task,
      ]);
    }

}
