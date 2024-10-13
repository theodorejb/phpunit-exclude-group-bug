<?php

namespace PhpunitExcludeGroupBug\Test;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    public static function provider(): array
    {
        return [
            ["🐘", 4],
            ["🐧🐘", 8]
        ];
    }

    #[DataProvider('provider')]
    public function test(string $value, int $expectedLen): void
    {
        $this->assertSame($expectedLen, strlen($value));
    }
}
