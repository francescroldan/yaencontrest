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

        return $this->repository(Advertisement::class)->matching($doctrineCriteria)->toArray();
    }
}
