<?php

namespace App\Tests\Advertisement\Application\SearchByCriteria;

use App\Domain\AdvertisementId;
use PHPUnit\Framework\TestCase;
use App\Domain\Criteria\Criteria;
use App\Domain\Criteria\OrderType;
use App\Domain\AdvertisementRepository;
use App\Domain\Criteria\FilterOperator;
use App\Tests\Advertisement\Domain\AdvertisementMockFactory;
use App\Application\SearchByCriteria\AdvertisementsByCriteriaSearcher;
use App\Application\SearchByCriteria\SearchAdvertisementsByCriteriaQuery;
use App\Application\SearchByCriteria\SearchAdvertisementsByCriteriaQueryHandler;

class SearchAdvertisementsByCriteriaQueryHandlerTest extends TestCase
{
    public function testItShouldSearchForAdvertisements()
    {
        for ($i = 0; $i < 5; $i++) {
            $expectedAdvertisements[] = AdvertisementMockFactory::GenerateRandom();
        }

        $filters = [
            ['field' => 'price', 'operator' => FilterOperator::LT, 'value' => '500'],
            ['field' => 'locality', 'operator' => FilterOperator::EQUAL, 'value' => 'Barcelona'],
            ['field' => 'text', 'operator' => FilterOperator::CONTAINS, 'value' => 'lorem'],
        ];
        $searchAdvertisementsByCriteriaQuery = new SearchAdvertisementsByCriteriaQuery(
            $filters,
            'price',
            OrderType::DESC
        );

        $advertisementRepositoryMock = $this->createMock(AdvertisementRepository::class);
        $advertisementRepositoryMock->expects($this->once())
            ->method('matching')
            ->willReturn($expectedAdvertisements);

        $advertisementByCriteriaSearcher = new AdvertisementsByCriteriaSearcher($advertisementRepositoryMock);
        $searchAdvertisementsByCriteriaQueryHandler = new SearchAdvertisementsByCriteriaQueryHandler($advertisementByCriteriaSearcher);

        $this->assertEquals(5, count($searchAdvertisementsByCriteriaQueryHandler($searchAdvertisementsByCriteriaQuery)->advertisements()));
    }
}
