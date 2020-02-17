<?php

declare(strict_types=1);

namespace App\Tests\Advertisement\Domain;

use Faker\Factory;

abstract class MockFactory
{
    private static $faker;

    public static function random()
    {
        return self::$faker = self::$faker ?: Factory::create('es_ES');
    }
}
