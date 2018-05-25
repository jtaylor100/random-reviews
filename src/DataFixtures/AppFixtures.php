<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\Review;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use joshtronic\LoremIpsum;

class AppFixtures extends Fixture 
{
    public function load(ObjectManager $manager) 
    {
        // Create 2 Hotels, each with 10 reviews
        $hilton = $this->generateHotelWithReviews("Hilton","Grove Street 23","12345","Berlin",false,"Mon-Sun 08:00-23:00");
        $manager->persist($hilton);

        $hostel = $this->generateHotelWithReviews("Cozy Hostel", "5th Avenue 65", "32345","Berlin",true,"Mon-Fri 06:00-22:00");
        $manager->persist($hostel);

        $manager->flush();
    }

    private function generateHotelWithReviews(string $name, string $address1, string $postcode,string $city,bool $petsAllowed,string $openingHours) : Hotel
    {

        $hotel = new Hotel();
        $hotel->setName($name);
        $hotel->setAddressline1($address1);
        $hotel->setPostcode($postcode);
        $hotel->setCity($city);
        $hotel->setPetsAllowed($petsAllowed);
        $hotel->SetOpeninghours($openingHours);

        $loremIpsum = new LoremIpsum();

        for($i = 0; $i < 20; $i++)
        {
            $review = new Review();
            $review->setReviewbody($loremIpsum->sentence());
            $review->setReviewrating(mt_rand(1,10));
            $review->setAuthorname($loremIpsum->words(2));
            $review->setDatepublished(new \DateTime());
            $hotel->addReview($review);
        }

        return $hotel;
    }
}
