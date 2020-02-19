<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\Update\UpdateAdvertisementCommand;
use App\Application\Update\UpdateAdvertisementCommandHandler;

class AdvertisementUpdateController extends BusController
{
    protected $handler;

    public function __construct(UpdateAdvertisementCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $id = $request->get('id');
            $request = $this->validateAdvertisementRequest($request, false, true);
        } catch (\Exception $e) {
            return $this->respondValidationError($e->getMessage());
        }

        $updateAdvertisementCommand = new UpdateAdvertisementCommand();
        $updateAdvertisementCommand->__invoke(
            $id,
            $request['title'],
            $request['description'],
            $request['price'],
            $request['locality']
        );

        try {
            $this->handler->__invoke($updateAdvertisementCommand);
        } catch (\Exception $e) {
            return $this->respondValidationError('Fail updating advertisement');
        }

        return $this->respondUpdated();
    }
}
