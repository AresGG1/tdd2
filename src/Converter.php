<?php

declare(strict_types=1);

namespace Taras\Lab2;

class Converter
{
    private array $romanToArabicMapping = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    ];

    /**
     * @param string $roman
     * @return int
     */
    public function convertRomanToArabic(string $roman): int
    {
        if (! $roman) {
            throw new \InvalidArgumentException('Empty sting value provided');
        }

        $roman = strtoupper($roman);

        foreach (str_split($roman) as $char) {
            if (!array_key_exists($char, $this->romanToArabicMapping)) {
                throw new \InvalidArgumentException('Invalid character provided: ' . $char);
            }
        }

        if (! preg_match('/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/', $roman)) {
            throw new \InvalidArgumentException('Wrong sequence');

        }


        $res = 0;

        foreach ($this->romanToArabicMapping as $key => $value) {
            while (strpos($roman, $key) === 0) {
                $res += $value;
                $roman = substr($roman, strlen($key));
            }
        }


        return $res;
    }
}
