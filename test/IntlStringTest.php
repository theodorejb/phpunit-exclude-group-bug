<?php

namespace PhpunitExcludeGroupBug\Test;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('intl')]
class IntlStringTest extends TestCase
{
    public static function provider(): array
    {
        if (!function_exists('grapheme_strlen')) {
            throw new \Exception('Please enable the intl extension to run these tests');
        }

        return [
            ["🐘", 1],
            ["🐧🐘", 2]
        ];
    }

    #[DataProvider('provider')]
    public function test(string $value, int $expectedLen): void
    {
        $this->assertSame($expectedLen, grapheme_strlen($value));
    }
}
