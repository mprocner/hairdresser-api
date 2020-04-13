<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package App\Tests
 */
class UserTest extends TestCase
{
    /**
     * @test
     */
    public function testSetEmail()
    {
        $user = new User();
        $user->setEmail('mateusz.procner@gmail.com');

        $this->assertSame('mateusz.procner@gmail.com', $user->getEmail());
    }

}
