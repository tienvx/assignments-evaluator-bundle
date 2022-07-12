# Assignments Evaluator Bundle [![Build Status][actions_badge]][actions_link] [![Coverage Status][coveralls_badge]][coveralls_link] [![Version][version-image]][version-url] [![PHP Version][php-version-image]][php-version-url]

This library is a Symfony Bundle for [Assignments Evaluator][assignments-evaluator].
It register `AssignmentsEvaluator` service and add `AssignmentsSyntax` constraint.

## Installation

```shell
composer require tienvx/assignments-evaluator-bundle
```

## Documentation

```php
use Tienvx\Bundle\AssignmentsEvaluatorBundle\Validator\AssignmentsSyntax;

class Business
{
    /**
     * @AssignmentsSyntax
     */
    protected string $expression;
}
```

## License

[MIT](https://github.com/tienvx/assignments-evaluator-bundle/blob/main/LICENSE)

[actions_badge]: https://github.com/tienvx/assignments-evaluator-bundle/workflows/main/badge.svg
[actions_link]: https://github.com/tienvx/assignments-evaluator-bundle/actions

[coveralls_badge]: https://coveralls.io/repos/tienvx/assignments-evaluator-bundle/badge.svg?branch=main&service=github
[coveralls_link]: https://coveralls.io/github/tienvx/assignments-evaluator-bundle?branch=main

[version-url]: https://packagist.org/packages/tienvx/assignments-evaluator-bundle
[version-image]: http://img.shields.io/packagist/v/tienvx/assignments-evaluator-bundle.svg?style=flat

[php-version-url]: https://packagist.org/packages/tienvx/assignments-evaluator-bundle
[php-version-image]: http://img.shields.io/badge/php-7.4.0+-ff69b4.svg

[assignments-evaluator]: https://github.com/tienvx/assignments-evaluator
