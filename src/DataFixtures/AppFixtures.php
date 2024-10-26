<?php

namespace App\DataFixtures;

use App\Factory\MicroPostFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use UserFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(10);
        MicroPostFactory::createMany(50);

        $manager->flush();
    }
}
