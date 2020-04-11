<?php

namespace App\DataFixtures;

use App\Entity\HairdresserPosition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HairdresserPositionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 5; $i++) {
            $position = new HairdresserPosition();
            $position->setName('Stanowisko '.$i);
            $manager->persist($position);
        }

        $manager->flush();
    }
}
