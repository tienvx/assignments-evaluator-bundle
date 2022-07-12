<?php

namespace Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class AssignmentsSyntax extends Constraint
{
    public const ASSIGNMENTS_SYNTAX_ERROR = 'dac4973f-43aa-40fc-9d20-660ccc5e9f9b';

    protected const ERROR_NAMES = [
        self::ASSIGNMENTS_SYNTAX_ERROR => 'EXPRESSION_SYNTAX_ERROR',
    ];

    public $message = 'This value should be a valid assignments expression.';
    public $allowedVariables;

    public function __construct(array $options = null, string $message = null, array $allowedVariables = null, array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->allowedVariables = $allowedVariables ?? $this->allowedVariables;
    }
}
