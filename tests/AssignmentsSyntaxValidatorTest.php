<?php

namespace Tienvx\Bundle\AssignmentsEvaluatorBundle\Tests\Validator;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Tienvx\AssignmentsEvaluator\AssignmentsEvaluator;
use Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntax;
use Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntaxValidator;

/**
 * @covers \Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntaxValidator
 *
 * @uses \Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntax
 */
class AssignmentsSyntaxValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new AssignmentsSyntaxValidator(new AssignmentsEvaluator(new ExpressionLanguage()));
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new AssignmentsSyntax());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new AssignmentsSyntax());

        $this->assertNoViolation();
    }

    public function testExpressionValid()
    {
        $this->validator->validate('sum = 1 + 1', new AssignmentsSyntax([
            'message' => 'myMessage',
            'allowedVariables' => [],
        ]));

        $this->assertNoViolation();
    }

    public function testExpressionWithoutNames()
    {
        $this->validator->validate('sum = 1 + 1', new AssignmentsSyntax([
            'message' => 'myMessage',
        ]));

        $this->assertNoViolation();
    }

    public function testExpressionWithAllowedVariableName()
    {
        $this->validator->validate('a = a + 1', new AssignmentsSyntax([
            'message' => 'myMessage',
            'allowedVariables' => ['a'],
        ]));

        $this->assertNoViolation();
    }

    public function testExpressionIsNotValid()
    {
        $this->validator->validate('a = a + 1', new AssignmentsSyntax([
            'message' => 'myMessage',
            'allowedVariables' => [],
        ]));

        $this->buildViolation('myMessage')
            ->setParameter(
                '{{ syntax_error }}',
                '"Expression "a + 1" is invalid: Variable "a" is not valid around position 1 for expression `a + 1`.."'
            )
            ->setInvalidValue('a = a + 1')
            ->setCode(AssignmentsSyntax::ASSIGNMENTS_SYNTAX_ERROR)
            ->assertRaised();
    }
}
