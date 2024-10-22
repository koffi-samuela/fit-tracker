<?php

namespace App\Controller;

use App\Entity\WorkoutExercice;
use App\Form\WorkoutExerciceType;
use App\Repository\WorkoutExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/workout/exercice')]
class WorkoutExerciceController extends AbstractController
{
    #[Route('/', name: 'app_workout_exercice_index', methods: ['GET'])]
    public function index(WorkoutExerciceRepository $workoutExerciceRepository): Response
    {
        return $this->render('workout_exercice/index.html.twig', [
            'workout_exercices' => $workoutExerciceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_workout_exercice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $workoutExercice = new WorkoutExercice();
        $form = $this->createForm(WorkoutExerciceType::class, $workoutExercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($workoutExercice);
            $entityManager->flush();

            return $this->redirectToRoute('app_workout_exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('workout_exercice/new.html.twig', [
            'workout_exercice' => $workoutExercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workout_exercice_show', methods: ['GET'])]
    public function show(WorkoutExercice $workoutExercice): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('workout_exercice/show.html.twig', [
            'workout_exercice' => $workoutExercice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_workout_exercice_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WorkoutExercice $workoutExercice, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(WorkoutExerciceType::class, $workoutExercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_workout_exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('workout_exercice/edit.html.twig', [
            'workout_exercice' => $workoutExercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workout_exercice_delete', methods: ['POST'])]
    public function delete(Request $request, WorkoutExercice $workoutExercice, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($this->isCsrfTokenValid('delete'.$workoutExercice->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($workoutExercice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_workout_exercice_index', [], Response::HTTP_SEE_OTHER);
    }
}
