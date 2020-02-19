<?php

declare(strict_types=1);

namespace App\Application\SearchByCriteria;

use App\Application\AdvertisementsResponse;
use App\Domain\Criteria\Filters;
use App\Domain\Criteria\Order;

final class SearchAdvertisementsByCriteriaQueryHandler
{
    private $searcher;

    public function __construct(AdvertisementsByCriteriaSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchAdvertisementsByCriteriaQuery $query): AdvertisementsResponse
    {
        $filters = Filters::fromValues($query->filters());
        $order   = Order::fromValues($query->orderBy(), $query->order());

        // return $this->searcher->search($query->filters(), $query->orderBy(), $query->order(), $query->limit(), $query->offset());
        return $this->searcher->search($filters, $order, $query->limit(), $query->offset());
    }
}
