<?php

namespace App\Controller;

use App\Controller\BusController;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\AdvertisementNotExistException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\Delete\DeleteAdvertisementCommand;
use App\Application\Delete\DeleteAdvertisementCommandHandler;

class AdvertisementDeleteController extends BusController
{
    protected $handler;

    public function __construct(DeleteAdvertisementCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {

        try {
            $request = $this->transformJsonBody($request);
            $id = $request->get('id');
            $createAdvertisementCommand = new DeleteAdvertisementCommand();
            $createAdvertisementCommand->__invoke(
                $id
            );
        } catch (\Exception $e) {
            return $this->respondValidationError($e->getMessage());
        }


        try {
            $this->handler->__invoke($createAdvertisementCommand);
        } catch (AdvertisementNotExistException $e) {
            return $this->respondNotFound('Advertisement not found');
        } /* catch (\Exception $e) {
            return $this->respondNotFound('Something is wrong');
        } */

        return $this->respondWithSuccess(sprintf('Avertisement with id %s deleted successfully', $id));
    }
}
