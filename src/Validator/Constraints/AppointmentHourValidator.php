<?php
declare(strict_types=1);
/**
 * File: AppointmentHourValidator.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

/**
 * Class AppointmentHourValidator
 * @package App\Validator\Constraints
 */
final class AppointmentHourValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /** @var $value \DateTime */
        $regex = '/^([01][0-9]|2[0-3]):(00|30)$/';
        if (!preg_match($regex, $value->format('H:i')) ) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }


}