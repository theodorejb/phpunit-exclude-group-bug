<?php

namespace PhpunitExcludeGroupBug\Test;

use PHPUnit\Framework\TestCase;

/**
 * @group intl
 */
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

    /**
     * @dataProvider provider
     */
    public function test(string $value, int $expectedLen): void
    {
        $this->assertSame($expectedLen, grapheme_strlen($value));
    }
}
