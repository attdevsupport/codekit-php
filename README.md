# PHP Codekit

## Description

The AT&T PHP Codekit allows you to interact with AT&T's APIs.

## Requirements

- PHP 5.4 or higher
- PHP CURL extension

## Installation

Clone the latest version of the [Codekit](https://github.com/attdevsupport/codekit-php)
to a folder.

From the Codekit folder, copy the 'lib' folder to the _DocumentRoot_
folder; for example, this folder might be: _/var/www/_

## Usage

Include or require the relevant parts of the Codekit. For example, if the
Codekit is installed in the _/var/www/lib/_ directory and there is a file
called app.php in the _/var/www/app/_ folder, you can require the OAuth library
by adding the following line of code to the app.php file:

    require_once __DIR__ . '../lib/OAuth/OAuthTokenService.php';

Both the example code and the
[PHP sample applications](https://developer.att.com/developer/forward.jsp?passedItemId=13200286&parentItemId=13100236)
can be used as references to see usage.

## Example Code

Examples can be found in the 'examples' folder. Each example must be modified
before it can be executed, and each example file contains comments detailing
the changes needed.

## Test Code

To run the test code, PHPUnit is required. For directions on installing
PHPUnit, refer to [PHPUnit github page.](https://github.com/sebastianbergmann/phpunit/)

Test code can be found in the 'tests' folder for unit tests and
'integration\_tests' for integration tests. The `phpunit` command can be used
to run these tests. For example, to run unit tests:

    phpunit tests

To run integration tests, the configuration values in 'integration\_tests/cfgs/'
must be configured.

## Documentation

The Codekit contains inline documentation, which can be generated using
phpDocumentor via the phpdoc command. For directions on installing
phpDocumentor, refer to its [website.](http://www.phpdoc.org/) For example, to
generate the documentation to the 'output' folder, the following command can be
used:

    phpdoc run -d lib -t output

## Coding Standards

The Codekit follows the [PEAR](http://pear.php.net/manual/en/coding-standards.php)
coding standards.
