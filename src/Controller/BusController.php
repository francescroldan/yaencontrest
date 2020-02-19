<?php

namespace App\Controller;

use App\Controller\ApiController;
use App\Application\CommandHandler;
use Symfony\Component\HttpFoundation\Request;

abstract class BusController extends ApiController
{
    protected $handler;

    public function __construct(CommandHandler $handler)
    {
        $this->handler = $handler;
    }

    protected function validateAdvertisementRequest(Request $request, ?bool $allowNull = true, ?bool $withoutOwner = false): array
    {
        $data = [];
        $request = $this->transformJsonBody($request);


        if (empty($request->get('title')) && !$allowNull) {
            throw new \Exception("Title field is empty");
        }
        if (empty($request->get('description')) && !$allowNull) {
            throw new \Exception("Description field is empty");
        }
        if (empty($request->get('price')) && !$allowNull) {
            throw new \Exception("Price field is empty");
        }
        if (!empty($request->get('price')) && !is_numeric($request->get('price'))) {
            throw new \Exception("Price field has no valid value");
        }
        if (empty($request->get('locality')) && !$allowNull) {
            throw new \Exception("Locality field is empty");
        }

        $owner = $request->get('owner');
        if (!$withoutOwner) {

            if (!is_array($owner) && !$allowNull) {
                throw new \Exception("Owner data is empty");
            }
            if (empty($owner['type']) && !$allowNull) {
                throw new \Exception("Owner type field is empty");
            }
            if (!is_numeric($owner['type'])) {
                throw new \Exception("Owner type must be a number");
            }
            if (empty($owner['name']) && !$allowNull) {
                throw new \Exception("Owner name field is empty");
            }
            if (empty($owner['phonenumber']) && !$allowNull) {
                throw new \Exception("Owner phonenumber field is empty");
            }
            if (empty($owner['email']) && !$allowNull) {
                throw new \Exception("Owner email field is empty");
            }
        }

        $data['title'] = $request->get('title') ?: null;
        $data['description'] = $request->get('description') ?: null;
        $data['price'] = $request->get('price') ? floatval($request->get('price')) : null;
        $data['locality'] = $request->get('locality') ?: null;
        $data['owner']['type'] = $owner['type'] ? intval($owner['type']) : null;
        $data['owner']['name'] = $owner['name'] ?: null;
        $data['owner']['phonenumber'] = $owner['phonenumber'] ?: null;
        $data['owner']['email'] = $owner['email'] ?: null;

        return $data;
    }
}
