<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Owner;
use App\Domain\OwnerId;
use App\Domain\Criteria\Criteria;
use App\Domain\OwnerRepository;
use App\Infrastructure\Doctrine\DoctrineRepository;
use App\Infrastructure\Doctrine\DoctrineCriteriaConverter;

final class MySQLOwnerRepository extends DoctrineRepository implements OwnerRepository
{
    public function save(Owner $owner): void
    {
        $this->persist($owner);
    }
}
