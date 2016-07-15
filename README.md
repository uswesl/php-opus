# PHP-Opus

PHP-Opus is an abstraction layer for Opus(tm) applications that adhere to Opus/JSON specification.

## Setup

### Requirements

In order to use all features you need to install [node.js](https://nodejs.org/en/) and [composer](https://getcomposer.org/).

### Installing

After requirements met, clone the project:

`$ git clone https://github.com/capesesp/php-opus.git`

And run:

`$ composer install`
`$ npm install`

## Running tests

`$ ./bin/phpunit --filter FuncionalWs`

### Output test results to HTML

`$ ./bin/phpunit --filter FuncionalWs | ./bin/ansi2html > test_result.html`


## Utilities

### JSON Schema Faker with colored pretty printed output

`$ ./node jsf.js ./tests/tt/schemas/fttj01.schema.json`
`$ ./node jsf.js ./tests/tt/schemas/fttj01.schema.json > example.json`

### Ansi to HTML conversor

`$ ./bin/phpunit --filter Fttj01Test | ./bin/ansi2html > json.html`
`$ ./node jsf.js ./tests/tt/schemas/fttj01.schema.json | ./bin/ansi2html > json.html`


# References

[PHP the right way](http://www.phptherightway.com)
[Fixing PHP errors automatically](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Fixing-Errors-Automatically)
[PHP SPL Exceptions](http://www.php.net/manual/en/spl.exceptions.php)
[What exception subclasses are buit in](http://stackoverflow.com/questions/10838257/what-exception-subclasses-are-built-into-php)
