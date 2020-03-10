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
     * @Route("/todos/{id}", name="todo_show")
     */
    public function show($id)
    {
      $todo = $this->getDoctrine()
        ->getRepository(Todo::class)
        ->find($id);

      if (!$todo) {
        throw $this->createNotFoundException('No todo found for id '.$id);
      }

      return $this->render('todo/show.html.twig', ['todo' => $todo]); //Need to create Template to display queried $todo object

    }

    /**
    * @Route("/todos/new", name="todo_new")
    */
    public function new()
    {

    }
}
