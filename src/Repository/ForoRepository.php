<?php

namespace App\Repository;

use App\Entity\Foro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Foro>
 *
 * @method Foro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Foro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Foro[]    findAll()
 * @method Foro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Foro::class);
    }

    public function save(Foro $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Foro $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findOneById($value): ?Foro
    {
            return $this->createQueryBuilder('t')
               ->andWhere('t.id = :val')
              ->setParameter('val', $value)
               ->getQuery()
               ->getOneOrNullResult()
        ;
    }
    public function findMyUsers(): array
    {   
        return $this->createQueryBuilder('e')
        ->orderBy('e.creadate', 'ASC')
        ->getQuery()
        ->getResult();
        ;
 }
    
    
    
//    /**
//     * @return Foro[] Returns an array of Foro objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Foro
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }









}
