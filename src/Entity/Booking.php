<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\WorkingTime as WorkingTimeValidator;
use App\Validator\Constraints\AppointmentHour as AppointmentHourValidator;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={
 *             "requirements"={
 *                 "hairdresserPosition",
 *                 "startTime",
 *                 "endTime",
 *                 "date"
 *             }
 *         }
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HairdresserPosition", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hairdresserPosition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="time")
     * @WorkingTimeValidator
     * @AppointmentHourValidator
     * @var \DateTime
     */
    private $startTime;

    /**
     * @ORM\Column(type="time")
     * @Assert\GreaterThan(propertyPath="startTime", message="Value should be greater than 'startTime' ")
     * @WorkingTimeValidator
     * @AppointmentHourValidator
     */
    private $endTime;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHairdresserPosition(): ?HairdresserPosition
    {
        return $this->hairdresserPosition;
    }

    public function setHairdresserPosition(?HairdresserPosition $hairdresserPosition): self
    {
        $this->hairdresserPosition = $hairdresserPosition;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStartTime(): ?string
    {
        return $this->startTime->format('H:i');
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?string
    {
        return $this->endTime->format('H:i');
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date->format('Y-m-d');
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
