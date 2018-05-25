<?php


namespace App\Repository;

use App\Entity\Hotel;
use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Hotel::class);
    }

    /*
     * Returns a random review belonging to the given hotel
     *
     * Current implementation may not scale well
     * See: http://jan.kneschke.de/projects/mysql/order-by-rand/
     *      https://github.com/doctrine/doctrine2/issues/5479#issuecomment-230503415
     */
    public function getRandomReview(Hotel $hotel) : ?Review
    {
        // Select all Review Ids belonging to Hotel
        $reviews = $hotel->getReviews();
        $reviewCount = count($reviews); 
        $randomIndex = mt_rand(0,$reviewCount-1);
        $randomReview = $reviews[$randomIndex];

        return $randomReview;
    }

//    /**
//     * @return Hotel[] Returns an array of Hotel objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hotel
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
