<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    public function showTask($id)
    {
        $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);

        if (!$todo) {
            throw $this->createNotFoundException('There is no task at that id sorry');
        }
        return $this->render('todo/show.html.twig', ['todo' => $todo]);
    }

    public function createTask(Request $request)
    {
        $todo = new Task();

        $form = $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
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
}
