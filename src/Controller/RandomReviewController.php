<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Hotel;

class RandomReviewController extends Controller
{
    /**
     * @Route("/{hotelId}/today/review", name="random_review")
     */
    public function index($hotelId)
    {
        $hotelRepo = $this->getDoctrine()
            ->getRepository(Hotel::Class);

        // Validate hotel Id and fetch Hotel entity
        $hotel = $hotelRepo->find($hotelId);
        if($hotel == null)
        {
            throw $this->createNotFoundException(
                "No Hotel found for id ".$hotelId
            );
        }
        
        // Choose random review out of review set
        $review = $hotelRepo->getRandomReview($hotel);

        // Render chosen review
        return $this->render('random_review/index.html.twig', [
          'controller_name' => 'RandomReviewController',
          'random_review' => $review,
        ]);
    }
}
