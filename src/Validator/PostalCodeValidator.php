<?php
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class PostalCodeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof PostalCode) {
            throw new UnexpectedTypeException($constraint, PostalCode::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!preg_match('/^(0[1-9]|[1-8][0-9]|9[0-8])\d{3}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}


/**
 * @Annotation
 */
class PostalCode extends Constraint
{
    public $message = 'Le code postal doit être un code postal français valide.';
}

