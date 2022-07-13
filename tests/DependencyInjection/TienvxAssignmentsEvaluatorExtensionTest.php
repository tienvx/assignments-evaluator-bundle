<?php

namespace Tienvx\Bundle\MbtBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tienvx\AssignmentsEvaluator\AssignmentsEvaluator;
use Tienvx\Bundle\AssignmentsEvaluatorBundle\DependencyInjection\TienvxAssignmentsEvaluatorExtension;
use Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntax;
use Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntaxValidator;

/**
 * @covers \Tienvx\Bundle\AssignmentsEvaluatorBundle\DependencyInjection\TienvxAssignmentsEvaluatorExtension
 */
class TienvxMbtExtensionTest extends TestCase
{
    protected ContainerBuilder $container;
    protected TienvxAssignmentsEvaluatorExtension $loader;

    protected function setUp(): void
    {
        $this->container = new ContainerBuilder();
        $this->loader = new TienvxAssignmentsEvaluatorExtension();
    }

    public function testLoad(): void
    {
        $this->loader->load([], $this->container);
        $this->assertTrue($this->container->has(AssignmentsEvaluator::class));
        $this->assertTrue($this->container->has(AssignmentsSyntax::class));
        $this->assertTrue($this->container->has(AssignmentsSyntaxValidator::class));
        $this->assertTrue(
            $this->container
                ->getDefinition(AssignmentsSyntaxValidator::class)
                ->hasTag('validator.constraint_validator')
        );
    }
}
