<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Tienvx\AssignmentsEvaluator\AssignmentsEvaluator;
use Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntax;
use Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntaxValidator;

return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set('assignments_evaluator.expression_language', ExpressionLanguage::class)
        ->set(AssignmentsEvaluator::class)
            ->args([
                service('assignments_evaluator.expression_language'),
            ])

        ->set(AssignmentsSyntax::class)
        ->set(AssignmentsSyntaxValidator::class)
            ->args([
                service(AssignmentsEvaluator::class),
            ])
            ->tag('validator.constraint_validator', [
                'alias' => AssignmentsSyntaxValidator::class,
            ])
    ;
};
