<?php

declare(strict_types=1);

namespace App\Application\SearchByCriteria;

use App\Application\AdvertisementResponse;
use App\Application\AdvertisementsResponse;
use App\Domain\Advertisement;
use App\Domain\AdvertisementRepository;
use App\Domain\Criteria\Criteria;
use App\Domain\Criteria\Filters;
use App\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class AdvertisementsByCriteriaSearcher
{
    private $advertisementRepository;

    public function __construct(AdvertisementRepository $advertisementRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
    }

    public function search(Filters $filters, Order $order, ?int $limit, ?int $offset): AdvertisementsResponse
    {
        $criteria = new Criteria($filters, $order, $offset, $limit);

        return new AdvertisementsResponse(...map($this->toResponse(), $this->advertisementRepository->matching($criteria)));
    }

    private function toResponse(): callable
    {
        return static function (Advertisement $advertisement) {
            return new AdvertisementResponse(
                $advertisement->id()->value(),
                $advertisement->title()->value(),
                $advertisement->description()->value(),
                $advertisement->price()->value(),
                $advertisement->locality()->value(),
                $advertisement->owner()->__toArray()
            );
        };
    }
}
