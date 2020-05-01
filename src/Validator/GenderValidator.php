<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GenderValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\Gender */

        if (null === $value || '' === $value) {
            return;
        }

        // TODO: implement the validation here

        $allowed = [
            'male',
            'female'
        ];
        if (!in_array($value, $allowed)) {

            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
