<?php

namespace App\Controller;

use App\Controller\BusController;
use function Lambdish\Phunctional\map;
use App\Domain\Criteria\FilterOperator;
use App\Application\AdvertisementResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\SearchByCriteria\SearchAdvertisementsByCriteriaQuery;
use App\Application\SearchByCriteria\SearchAdvertisementsByCriteriaQueryHandler;

class AdvertisementSearchByCriteriaController extends BusController
{
    protected $handler;

    public function __construct(SearchAdvertisementsByCriteriaQueryHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {

        try {
            $request = $this->parseParameters($request);
        } catch (\Exception $e) {
            return $this->respondValidationError($e->getMessage());
        }

        try {
            $searchAdvertisementsByCriteriaQuery = new SearchAdvertisementsByCriteriaQuery(
                $request['filters'],
                $request['order_by'],
                $request['order'],
                $request['limit'],
                $request['offset'],
            );
            $response = $this->handler->__invoke($searchAdvertisementsByCriteriaQuery);
        } catch (\Exception $e) {
            return $this->respondNotFound('Advertisement not found');
        }

        return new JsonResponse(
            map($this->toArray(), $response->advertisements()),
            200,
            ['Access-Control-Allow-Origin' => '*']
        );
    }

    private function toArray(): callable
    {
        return static function (AdvertisementResponse $advertisement) {
            return [
                'id'            => $advertisement->id(),
                'title'         => $advertisement->title(),
                'description'   => $advertisement->description(),
                'price'         => $advertisement->price(),
                'locality'      => $advertisement->locality(),
                'owner'         => $advertisement->owner()
            ];
        };
    }

    private function parseParameters(Request $request): array
    {
        $request = $this->transformJsonBody($request);

        $filters = [];
        if (!empty($request->get('text'))) {
            $filters = [
                ['field' => 'title', 'operator' => FilterOperator::CONTAINS, 'value' => $request->get('text')],
                ['field' => 'description', 'operator' => FilterOperator::CONTAINS, 'value' => $request->get('text')],
            ];
        }
        if (!empty($request->get('locality'))) {
            $filters[] = ['field' => 'locality', 'operator' => FilterOperator::EQUAL, 'value' => $request->get('locality')];
        }
        if (!empty($request->get('price'))) {
            $filters[] = ['field' => 'price', 'operator' => FilterOperator::EQUAL, 'value' => $request->get('price')];
        }
        $orderBy = $request->get('order_by');
        $order = $request->get('order', 'DESC');
        $limit = $request->get('limit');
        $offset = $request->get('offset');

        $filters[] = ['field' => 'deletedAt', 'operator' => FilterOperator::EQUAL, 'value' => null];

        return ['filters' => $filters, 'order_by' => $orderBy, 'order' => $order, 'limit' => $limit, 'offset' => $offset];
    }
}
