<?php

namespace Tienvx\Bundle\AssignmentsEvaluatorBundle\Tests\Validator;

use Doctrine\Common\Annotations\AnnotationReader;
use Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntax;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Mapping\Loader\AnnotationLoader;
use Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntaxValidator;

/**
 * @covers \Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntax
 */
class ExpressionSyntaxTest extends TestCase
{
    public function testValidatedBy()
    {
        $constraint = new AssignmentsSyntax();

        self::assertSame(AssignmentsSyntaxValidator::class, $constraint->validatedBy());
    }

    public function testAttributes()
    {
        $metadata = new ClassMetadata(AssignmentsSyntaxDummy::class);
        self::assertTrue((new AnnotationLoader(new AnnotationReader()))->loadClassMetadata($metadata));

        [$aConstraint] = $metadata->properties['a']->getConstraints();
        self::assertNull($aConstraint->allowedVariables);

        [$bConstraint] = $metadata->properties['b']->getConstraints();
        self::assertSame('myMessage', $bConstraint->message);
        self::assertSame(['Default', 'AssignmentsSyntaxDummy'], $bConstraint->groups);

        [$cConstraint] = $metadata->properties['c']->getConstraints();
        self::assertSame(['foo', 'bar'], $cConstraint->allowedVariables);
        self::assertSame(['my_group'], $cConstraint->groups);
    }
}

class AssignmentsSyntaxDummy
{
    /**
     * @AssignmentsSyntax
     */
    private $a;

    /**
     * @AssignmentsSyntax(message="myMessage")
     */
    private $b;

    /**
     * @AssignmentsSyntax(allowedVariables={"foo", "bar"}, groups={"my_group"})
     */
    private $c;
}
