<?php
declare(strict_types=1);
/**
 * File: PasswordValidator.php
 *
 * @author Mateusz Procner<mateusz.procner@gmail.com>
 * @copyright Copyright (C) 2020 Mateusz Procner
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class PasswordValidator
 * @package App\Validator\Constraints
 */
final class PasswordValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!is_string($value) || (strlen($value) < 8) ) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}