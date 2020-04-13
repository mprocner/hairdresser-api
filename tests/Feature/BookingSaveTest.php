<?php
declare(strict_types=1);
/**
 * File: BookingSaveTest.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Tests\Feature;

use App\Entity\Booking;
use App\Entity\HairdresserPosition;
use App\Entity\User;
use App\Tests\RefreshDatabase;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\ScopingHttpClient;

/**
 * Class BookingSaveTest
 * @package App\Tests\Feature
 */
class BookingSaveTest extends FeatureTestCase
{

    /**
     * @test
     */
    public function testAddBooking()
    {
        $kernel = self::createKernel();
        $kernel->boot();
        $user = $this->entityManager->getRepository(User::class)
            ->find(1);
        $jwtManager = $kernel->getContainer()->get('lexik_jwt_authentication.jwt_manager');
        $token = $jwtManager->create($user);
        $request = $this->client->request(
            'POST',
            '/api/bookings',
            [
                'json' => [
                    "hairdresserPosition" => "/api/hairdresser_positions/1",
                    "startTime"=> "12:00",
                    "endTime"=> "13:00",
                    "date"=> "12.05.2020"
                ],
                'headers' => [
                    'CONTENT_TYPE' => 'application/json',
                    'HTTP_ACCEPT' => 'application/json',
                ],
                'auth_bearer' => $token,
            ]
        );
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $booking = $this->entityManager->getRepository(Booking::class)->find(1);
        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertEquals('12:00', $booking->getStartTime());
    }
}