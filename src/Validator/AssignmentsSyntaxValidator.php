<?php

namespace Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Tienvx\AssignmentsEvaluator\AssignmentsEvaluator;
use Tienvx\AssignmentsEvaluator\SyntaxError;

class AssignmentsSyntaxValidator extends ConstraintValidator
{
    private AssignmentsEvaluator $assignmentsEvaluator;

    public function __construct(AssignmentsEvaluator $assignmentsEvaluator)
    {
        $this->assignmentsEvaluator = $assignmentsEvaluator;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($expression, Constraint $constraint): void
    {
        if (!$constraint instanceof AssignmentsSyntax) {
            throw new UnexpectedTypeException($constraint, AssignmentsSyntax::class);
        }

        if (null === $expression || '' === $expression) {
            return;
        }

        if (!\is_string($expression)) {
            throw new UnexpectedValueException($expression, 'string');
        }

        try {
            $this->assignmentsEvaluator->lint($expression, $constraint->allowedVariables);
        } catch (SyntaxError $exception) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ syntax_error }}', $this->formatValue($exception->getMessage()))
                ->setInvalidValue((string) $expression)
                ->setCode(AssignmentsSyntax::ASSIGNMENTS_SYNTAX_ERROR)
                ->addViolation();
        }
    }
}
