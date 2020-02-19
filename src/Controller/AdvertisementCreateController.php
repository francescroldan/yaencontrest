<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\Create\CreateAdvertisementCommand;
use App\Application\Create\CreateAdvertisementCommandHandler;

class AdvertisementCreateController extends BusController
{
    protected $handler;

    public function __construct(CreateAdvertisementCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request = $this->validateAdvertisementRequest($request, false);
        } catch (\Exception $e) {
            return $this->respondValidationError($e->getMessage());
        }

        $createAdvertisementCommand = new CreateAdvertisementCommand();
        $createAdvertisementCommand->__invoke(
            $request['title'],
            $request['description'],
            $request['price'],
            $request['locality'],
            $request['owner']
        );

        try {
            $this->handler->__invoke($createAdvertisementCommand);
        } catch (\Exception $e) {
            return $this->respondValidationError('Fail on creation');
        }

        return $this->respondCreated();
    }
}
