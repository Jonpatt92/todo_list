<?php

namespace App\Controller;

use App\Entity\Todo;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo/{id}", name="todo_show")
     */
    public function show()
    {
      $todo = $this->getDoctrine()
        ->getRepository(Todo::class)
        ->find($id);

      if (!$todo) {
        throw $this->createNotFoundException('No todo found for id '.$id);
      }

      return $this->render('todo/show.html.twig', ['todo' => $todo]); //Need to create Template to display queried $todo object

    }
}
