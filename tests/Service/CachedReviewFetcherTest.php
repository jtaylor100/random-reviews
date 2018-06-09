<?php


namespace App\Tests\Service;

use App\Entity\Review;
use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Service\CachedReviewFetcher;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class CachedReviewFetcherTest extends TestCase
{
    public function testReviewFetch()
    {
        // Mock review respository
        $review = new Review();
        $review->setAuthorName("Josh Taylor");
        $review->setReviewRating(7);
        $review->setReviewBody("Lorem ipsum.");

        $hotelRepository = $this->createMock(HotelRepository::class);
        $hotelRepository->expects($this->once())
            ->method("getRandomReview")
            ->willReturn($review);

        $hotel = new Hotel();
        $hotel->setId(500);

        // Mock cache
        $cacheItem = $this->createMock(CacheItemInterface::class);
        $cacheItem->expects($this->any())
            ->method("expiresAfter")
            ->with(60);

        $cacheItem->expects($this->any())
            ->method("isHit")
            ->willReturnOnConsecutiveCalls(false,true);

        $cache = $this->createMock(AdapterInterface::class);
        $cache->expects($this->any())
            ->method("getItem")
            ->with("hotel.500.random_review")
            ->willReturn($cacheItem);

        // Construct service
        $cachedReviewFetcher = new CachedReviewFetcher($hotelRepository,$cache);

        $firstResult = $cachedReviewFetcher->getRandomReview($hotel);
        $secondResult = $cachedReviewFetcher->getRandomReview($hotel);

        // Fetched reviews should be equivalent
        $this->assertEquals($firstResult,$secondResult);

        // After 60 seconds fetch again and repository should be hit
    }
}
