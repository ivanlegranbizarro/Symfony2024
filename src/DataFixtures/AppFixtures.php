<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use App\Factory\CommentFactory;
use App\Factory\MicroPostFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(20);
        MicroPostFactory::createMany(100);
        CommentFactory::createMany(40);

        $manager->flush();
    }
}
