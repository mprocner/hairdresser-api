<?php
declare(strict_types=1);
/**
 * File: BookingController.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{
    public function number()
    {
        $number = random_int(0, 100);
        $em = $this->getDoctrine()->getManager();
        $em->getConnection()->connect();
        $connected = $em->getConnection()->isConnected();
        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}