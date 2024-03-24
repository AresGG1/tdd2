<?php

declare(strict_types=1);

namespace Unit;

use PHPUnit\Framework\TestCase;
use Taras\Lab2\Converter;

class ConverterTest extends TestCase
{
    private Converter $converter;
    public function setUp(): void
    {
        $this->converter = new Converter();
    }

    /*
     *
     * Implement validation
     *
     */

    public function test_exception_on_empty_string(): void
    {
        $this->expectException(\InvalidArgumentException::class);
 
        $this->converter->convertRomanToArabic('');
    }
    public function test_exception_on_wrong_characters(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->converter->convertRomanToArabic('SJ');
    }
    public function test_wrong_char_sequence_throws_exception(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->converter->convertRomanToArabic('XM');
    }

    public function test_no_exception_on_existing_numbers(): void
    {
        $res = $this->converter->convertRomanToArabic('XC');

        $this->assertNotNull($res);
    }

    public function test_lowercase_works(): void
    {
        $res = $this->converter->convertRomanToArabic('x');

        $this->assertNotNull($res);
    }

    /*
     *
     * Implement mapping
     *
     */

    public function test_10_returned_on_X(): void
    {
        $res = $this->converter->convertRomanToArabic('X');

        $this->assertSame(10, $res);
    }

    //Test 2 chars mapping
    public function test_40_returned_on_XL(): void
    {
        $res = $this->converter->convertRomanToArabic('XL');

        $this->assertSame(40, $res);
    }

    /*
     *
     * Implement multiple chars input
     *
     */

    public function test_414_returned_on_CDXIV(): void
    {
        $res = $this->converter->convertRomanToArabic('CDXIV');

        $this->assertSame(414, $res);
    }

    public function test_690_returned_on_DCXC(): void
    {
        $res = $this->converter->convertRomanToArabic('DCXC');

        $this->assertSame(690, $res);
    }
}
