<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    /**
     * @Route("/todos", name="todo_list")
     */
    public function listTasks()
    {
        $repository = $this->getDoctrine()->getRepository(Task::class);

        $incompleteTasks = $repository->findBy(['status' => 'Incomplete']);
        $completeTasks = $repository->findBy(['status' => 'Complete']);

        if (!$incompleteTasks && !$completeTasks) {
            throw $this->createNotFoundException('No tasks were found sorry');
        }

        return $this->render('todo/index.html.twig', [
            'incompleteTasks' => $incompleteTasks,
            'completeTasks' => $completeTasks
        ]);
    }

    /**
     * @Route("/todo/{id}", name="todo_show")
     */
    public function showTask($id)
    {
        $todo = $this->getDoctrine()->getRepository(Task::class)->find($id);

        if (!$todo) {
            throw $this->createNotFoundException('There is no task at that id sorry');
        }
        return $this->render('todo/show.html.twig', ['todo' => $todo]);
    }

    /**
     * @Route("/todos/new", name="todo_new")
     */
    public function createTask(Request $request)
    {
        $todo = new Task();

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
     * @Route("/todo/complete/{id}", name="todo_complete")
     */
    public function updateTask($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $todo = $entityManager->getRepository(Task::class)->find($id);

        if (!$todo) {
            throw $this->createNotFoundException('There is no task at that id sorry');
        }

        $todo->setStatus('complete');
        $entityManager->flush();

        return $this->redirectToRoute('todo_index');
    }
}
