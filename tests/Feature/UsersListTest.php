<?php
declare(strict_types=1);
/**
 * File: UsersListTest.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Tests\Feature;

use App\Tests\RefreshDatabase;

/**
 * Class UsersListTest
 * @package App\Tests\Feature
 */
class UsersListTest extends FeatureTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */

    /**
     * @test
     */
    public function testGetUsersList() {

        if (empty($this->client)) {
            $this->client = static::createClient();
        }

        $this->client->request('GET', 'http://localhost/api/users', [], [], ['CONTENT_TYPE' => 'application/json']);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}