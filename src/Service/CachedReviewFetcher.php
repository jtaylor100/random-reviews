<?php


namespace App\Service;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

use App\Entity\Hotel;
use App\Entity\Review;
use App\Repository\HotelRepository;

class CachedReviewFetcher
{
    private $hotelRespository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository; 
    }

    /**
     * Returns a random review belonging to the given hotel, applying caching.
     *
     * @return Review Returns a random review belonging to the given hotel.
     */
    public function getRandomReview(Hotel $hotel) : ?Review
    {
        $cache = new FilesystemAdapter();

        // Attempt cache fetch
        $randomReviewCache = $cache->getItem('hotel.'.$hotel->getId().'.random_review');
        $randomReviewCache->expiresAfter(10);

        // If a Cache miss occurs
        if(!$randomReviewCache->isHit()) {
            // Query database
            $randomReview = $this->hotelRepository->getRandomReview($hotel);
            $randomReviewCache->set($randomReview);
            $cache->save($randomReviewCache);
        }

        return $randomReviewCache->get();
    }
}
