<?php

namespace App\Controller;

use App\Repository\WorkoutExerciceRepository;
use App\Repository\WorkoutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(WorkoutRepository  $workouts,WorkoutExerciceRepository  $exercises): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $work_id_array = [];
        $test_array = [];
        // dd($user);
        $user_id = $this->getUser()->getId();
        $user_workout = $workouts->findBy(["user"=> $user_id]);
        // $work_id = $user_workout[0]->getId();
        // $work_id = 4;


        foreach ($user_workout as $value) {
            array_push($work_id_array,$value->getId());           
        }


        foreach ($work_id_array as  $value) {
            $test =  $exercises->findOneBy(
                ["workout" => $value]
            );
            array_push($test_array, $test);
        }
        $s = array_merge(
            $work_id_array,
            $test_array
        );
    //     dd(
    //     $user_workout,
    //     // $work_id,
    //     // $exercice_of_workout,
    //     $work_id_array,
    //     $test_array,
    //     $s
    // );
    //concatener les deux tableaus en fonction des clés

    
        // dd($workouts->findCurrentWeekUserWorkout($user_id));
        return $this->render('dashboard/index.html.twig', [
            'user_workouts' => $user_workout,
            'user_details' => $test_array,
        ]);
    }
}
