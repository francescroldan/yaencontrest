<?php

namespace App\Controller;

use App\Application\AdvertisementResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Application\Find\FindAdvertisementCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\Find\FindAdvertisementCommandHandler;

class AdvertisementGetController extends BusController
{
    protected $handler;

    public function __construct(FindAdvertisementCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {

        try {
            $request = $this->transformJsonBody($request);
            $id = $request->get('id');
            $createAdvertisementCommand = new FindAdvertisementCommand();
            $createAdvertisementCommand->__invoke(
                $id
            );
        } catch (\Exception $e) {
            return $this->respondValidationError($e->getMessage());
        }


        try {
            $response = $this->handler->__invoke($createAdvertisementCommand);
        } catch (\Exception $e) {
            return $this->respondNotFound('Advertisement not found');
        }

        return $this->response($response->__toArray(), $headers = []);
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
}
