<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Advertisement;
use App\Domain\AdvertisementId;
use App\Domain\Criteria\Criteria;
use App\Domain\AdvertisementRepository;
use App\Infrastructure\Doctrine\DoctrineRepository;
use App\Infrastructure\Doctrine\DoctrineCriteriaConverter;

final class MySQLAdvertisementRepository extends DoctrineRepository implements AdvertisementRepository
{
    public function save(Advertisement $advertisement): void
    {
        $this->persist($advertisement);
    }

    public function search(AdvertisementId $id): ?Advertisement
    {
        return $this->repository(Advertisement::class)->find((string) $id);
    }

    public function searchAll(): array
    {
        return $this->repository(Advertisement::class)->findAll();
    }

    public function matching(Criteria $criteria): array
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);
        // var_dump($doctrineCriteria);

        return $this->repository(Advertisement::class)->matching($doctrineCriteria)->toArray();
    }

    // public function searchBy(array $criteria, $order = null, $orderBy = null, $limit = null, $offset = null): array
    // {
    //     // $this->repository(Advertisement::class)->findBy($criteria, $orderBy, $limit, $offset);
    //     $query = $this->createQueryNonDeletedAdvertisements($criteria, $order, $orderBy, $limit, $offset);
    //     var_dump($query);
    //     return $this->entityManager()
    //         ->createQuery(
    //             $query
    //         )
    //         ->getResult();
    // }


    // public function createQueryNonDeletedAdvertisements(array $criteria,  $order = null, $orderBy = null, $limit = null, $offset = null)
    // {
    //     $queryBase = 'SELECT * FROM advertisements a left join owners o on a.owner_id=o.id where a.deleted_at IS NULL';
    //     $where = '';
    //     foreach ($criteria as $subcriteria) {
    //         $where .= ' AND ';
    //         if (is_array($subcriteria)) {
    //             $orWhere = '';
    //             foreach ($subcriteria as $orCriteria) {
    //                 $orWhere .= $orWhere ? ' OR ' : '';
    //                 $orWhere .= $orCriteria;
    //             }
    //             $where .= $orWhere;
    //         } else {
    //             $where .= $subcriteria;
    //         }
    //     }

    //     if (!empty($order) && !empty($orderBy)) {
    //         $where .= ' ORDER BY ' . $order . ' ' . $orderBy;
    //     }
    //     if (!empty($limit)) {
    //         $where .= ' LIMIT ' . $limit;
    //     }
    //     if (!empty($offset)) {
    //         $where .= ' OFFSET ' . $offset;
    //     }

    //     return $queryBase . $where;
    // }
}
