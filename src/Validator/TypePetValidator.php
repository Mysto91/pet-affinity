<?php

namespace App\Validator;

use App\Entity\TypePet;
use App\Repository\TypePetRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TypePetValidator extends ConstraintValidator
{
    private $typeRepo;

    public function __construct(TypePetRepository $typeRepo)
    {
        $this->typeRepo = $typeRepo;
    }

    public function validate($value, Constraint $constraint)
    {

        if ($value instanceof TypePet) {
            if ($value->isEmpty()) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}
