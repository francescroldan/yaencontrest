<?php

declare(strict_types=1);

namespace App\Tests\Advertisement\Domain;

use Faker\Factory;
use App\Domain\Uuid;
use App\Domain\Owner;
use App\Domain\OwnerId;
use App\Domain\OwnerName;
use App\Domain\OwnerType;
use App\Domain\OwnerEmail;
use App\Domain\OwnerPhoneNumber;
use App\Tests\Advertisement\Domain\MockFactory;

final class OwnerMockFactory
{
    public static function GenerateRandom(): Owner
    {
        $faker = Factory::create();

        $id = new OwnerId((string) Uuid::random());
        $type = new OwnerType(MockFactory::random()->randomDigit());
        $name = new OwnerName(MockFactory::random()->firstName() . ' ' . MockFactory::random()->lastName());
        $phonenumber = new OwnerPhoneNumber(MockFactory::random()->tollFreeNumber());
        $email = new OwnerEmail(MockFactory::random()->email());

        return new Owner($id, $type, $name, $phonenumber, $email);
    }

    public static function GenerateRandomData(): array
    {
        $id = (string) Uuid::random();
        $type = MockFactory::random()->randomDigit();
        $name = MockFactory::random()->firstName() . ' ' . MockFactory::random()->lastName();
        $phonenumber = MockFactory::random()->tollFreeNumber();
        $email = MockFactory::random()->email();

        return ['id' => $id, 'type' => $type, 'name' => $name, 'phonenumber' => $phonenumber, 'email' => $email];
    }
}
