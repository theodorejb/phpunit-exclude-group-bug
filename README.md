# PHPUnit 10 exclude-group bug

This project demonstrates a bug in PHPUnit 10+ where the `--exclude-group` option no longer works as expected.

With PHPUnit 9, running `phpunit --exclude-group myGroup` would completely skip testing classes with this group.
However, in PHPUnit 10 and 11, data providers in these classes still run, and if one of them throws an exception
(e.g. due to a missing dependency), this results in a PHPUnit error, as well as the warning:
No tests found in class "FooTest".


## Reproduction steps

1. Clone this project, and ensure that the `intl` extension is *not enabled* in `php.ini`.
2. Check out the `phpunit-9` branch, and run the following commands (they should succeed):

        composer install
        composer test-skip-intl

3. Check out the `phpunit-10` branch, and repeat the above commands. This time the tests fail with an exception from the `IntlStringTest` data provider, as well as the warning:
> No tests found in class "PhpunitExcludeGroupBug\Test\IntlStringTest".
4. Check out the `phpunit-11` branch, and repeat the above commands. Note that the same errors occur.

> [!NOTE]  
> If the `intl` extension is enabled, the tests pass since the data provider in `IntlStringTest.php`
> does not throw an exception. However, it is quite unexpected that the data provider runs in
> this case when the class it is in has been skipped via `--exclude-group`.

## Use case

In another project I have an abstract test case class with shared tests, which is extended by several concrete test classes, each of which has its own data provider for the shared tests.

I need to be able to skip individual test classes on platforms which don't support that implementation/extension.


## Author

Theodore Brown
