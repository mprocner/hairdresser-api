<?php
declare(strict_types=1);
/**
 * File: StartTimeValidator.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class WorkingTimeValidator
 * @package App\Validator\Constraints
 */
final class WorkingTimeValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint

     */
    public function validate($value, Constraint $constraint): void
    {
        $openingTime = strtotime($_ENV['OPENING_HOUR']);
        $closingTime = strtotime($_ENV['CLOSING_HOUR']);

        /** @var $value \DateTime */
        $bookingTime = strtotime($value->format('H:i'));
        if ($bookingTime < $openingTime || $bookingTime > $closingTime ) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}