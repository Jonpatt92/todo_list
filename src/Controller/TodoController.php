<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\Type\TodoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo/{id}", name="todo_show")
     */
    public function show($id)
    {
      $todo = $this->getDoctrine()
        ->getRepository(Todo::class)
        ->find($id);

      if (!$todo) {
        throw $this->createNotFoundException('No todo found for id '.$id);
      }

      return $this->render('todo/show.html.twig', ['todo' => $todo]);
    }

    /**
    * @Route("/todos/new", name="todo_new")
    */
    public function new(Request $request)
    {
      $todo = new Todo();

      $form = $this->createForm(TodoType::class, $todo);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {

          $task = $form->getData();

          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($task);
          $entityManager->flush();

          return $this->redirectToRoute('todo_index');
      }
      return $this->render('todo/new.html.twig', [
        'form' => $form->createView(),
      ]);
    }

    /**
    * @Route("/todos", name="todo_index")
    */
    public function index()
    {
      $repository = $this->getDoctrine()->getRepository(Todo::class);

      $incompleteTodos = $repository
      ->findBy(['status' => 'Incomplete']);

      $completeTodos = $repository
      ->findBy(['status' => 'Complete']);

      if (!$incompleteTodos && !$completeTodos) {
        throw $this->createNotFoundException('No todos were found');
      }

      return $this->render('todo/index.html.twig', [
        'incompleteTodos' => $incompleteTodos,
        'completeTodos' => $completeTodos
       ]);
    }

    /**
    * @Route("/todo/complete/{id}", name="todo_complete")
    */
    public function update($id)
    {
      $entityManager = $this->getDoctrine()->getManager();
      $todo = $entityManager->getRepository(Todo::class)->find($id);

      if (!$todo) {
          throw $this->createNotFoundException(
              'No todo found for id '.$id
          );
      }

      $todo->setStatus('Complete');
      $entityManager->flush();

      return $this->redirectToRoute('todo_index');
    }
}
