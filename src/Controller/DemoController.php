<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use App\Services\SayHello;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
    public function addTask(Request $request, SessionInterface $session)
    {
      $task = new Task();

      $options = [];

      $form = $this->createForm(TaskType::class, $task, $options);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $file = $task->getImage();

        $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

        // Move the file to the directory where brochures are stored
        try {
          $file->move(
            $this->getParameter('images_directory'),
            $fileName
          );
        } catch (FileException $e) {
          // ... handle exception if something happens during file upload
        }

        // updates the 'brochure' property to store the PDF file name
        // instead of its contents
        $task->setImage($fileName);

        $session->set('task', $form->getData());
        return $this->redirectToRoute('show_task');
      }

      return $this->render('demo/add_task.html.twig', [
        'form' => $form->createView(),
      ]);
    }

  /**
   * @Route("/show-task", name="show_task")
   * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function showTask(SessionInterface $session)
    {
      $task = $session->get('task');
      return $this->render('demo/show_task.html.twig', [
        'task' => $task,
      ]);
    }

  /**
   * @Route("/say-hello", name="say_hello")
   * @param \App\Services\SayHello $sayHello
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function sayHello(SayHello $sayHello) {
      $word = $sayHello->saySfIsGreat();
      return $this->render('demo/say_hello.html.twig', [
        'word' => $word,
      ]);
    }

  /**
   * @Route("/send-mail", name="send_mail")
   * @param \Swift_Mailer $swift_Mailer
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function sendMail(\Swift_Mailer $swift_Mailer) {
      $message = (new \Swift_Message())
        ->setFrom('noreply@actency.fr')
        ->setTo('christophe.klein.67+symfony@gmail.com')
        ->setSubject('Formation Symfony')
        ->setBody('Envoyer un mail depuis Symfony');
      $swift_Mailer->send($message);

      return new Response('Email sent');
    }

    public function generateUniqueFileName() {
      return md5(uniqid());
    }

}
