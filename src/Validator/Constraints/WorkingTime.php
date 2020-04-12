<?php
declare(strict_types=1);
/**
 * File: StartTime.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class StartTime
 * @Annotation
 * @package App\Validator\Constraints
 */
class WorkingTime extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Time should be after opening hour and before closing hour';
}