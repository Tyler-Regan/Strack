<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    public function showTask($id)
    {
        $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);

        if(!$todo) {
            throw $this->createNotFoundException('There is no task at that id sorry');
        }
        return $this->render('todo/show.html.twig', ['todo' => $todo]);
    }
}
