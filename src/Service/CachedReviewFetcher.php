<?php


namespace App\Service;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use App\Entity\Hotel;
use App\Entity\Review;
use App\Repository\HotelRepository;

class CachedReviewFetcher
{
    private $hotelRespository;
    private $cache;

    public function __construct(
        HotelRepository $hotelRepository, 
        AdapterInterface $cacheInterface)
    {
        $this->hotelRepository = $hotelRepository; 
        $this->cache = $cacheInterface;
    }

    /**
     * Returns a random review belonging to the given hotel, applying caching.
     *
     * @return Review Returns a random review belonging to the given hotel.
     */
    public function getRandomReview(Hotel $hotel) : ?Review
    {
        // Attempt cache fetch
        $randomReviewCache = $this->cache->getItem('hotel.'.$hotel->getId().'.random_review');
        $randomReviewCache->expiresAfter(60);

        // If a Cache miss occurs
        if(!$randomReviewCache->isHit()) {
            // Query database
            $randomReview = $this->hotelRepository->getRandomReview($hotel);
            $randomReviewCache->set($randomReview);
            $this->cache->save($randomReviewCache);
        }

        return $randomReviewCache->get();
    }
}
