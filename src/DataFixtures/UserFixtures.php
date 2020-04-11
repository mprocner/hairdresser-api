<?php
declare(strict_types=1);
/**
 * File: UserFixtures.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('mateusz.procner@gmail.com');
        $user->setPassword('123456');
        $manager->persist($user);

        $manager->flush();

    }
}