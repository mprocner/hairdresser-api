<?php
declare(strict_types=1);
/**
 * File: BookingDataPersister.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class BookingDataPersister
 * @package App\DataPersister
 */
class BookingDataPersister implements DataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var Security
     */
    private $security;

    /**
     * BookingDataPersister constructor.
     * @param EntityManagerInterface $entityManager
     * @param Security $security
     */
    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    /**
     * @param $data
     * @return bool
     */
    public function supports($data): bool
    {
        return $data instanceof Booking;
    }

    /**
     * @param $data
     * @return object|void
     */
    public function persist($data)
    {
        /** @var Booking $data */
        $data->setUser($this->security->getUser());
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }

    /**
     * @param $data
     */
    public function remove($data)
    {
        // TODO: Implement remove() method.
    }

}