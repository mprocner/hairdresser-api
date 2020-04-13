<?php
declare(strict_types=1);
/**
 * File: AppointmentHour.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class AppointmentHour
 * @Annotation
 * @package App\Validator\Constraints
 */
class AppointmentHour extends Constraint
{
    /**
     * @var string
     */
    public $message = 'You can only make an appointment at full or half hour';
}