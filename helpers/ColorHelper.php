<?php

namespace helpers;

class ColorHelper
{
    private const float BREAKPOINT = 0.03928;

    private const float OFFSET = 0.055;
    private const float SLOPE = 12.92;
    private const float NORMALIZATION = 1.055;
    private const float GAMMA_EXPONENT = 2.4;
    private const float LUMINANCE_RED   = 0.2126;
    private const float LUMINANCE_GREEN = 0.7152;
    private const float LUMINANCE_BLUE  = 0.0722;

    private const float DARKER_END_APPROXIMATION = 0.85;
    private const float WCAG_OFFSET = 0.05;

    static public function powerLawCurve(float $color): float {
        return pow(($color + self::OFFSET) / self::NORMALIZATION, self::GAMMA_EXPONENT);
    }

    static public function relativeLuminance(int $red, int $green, int $blue): float
    {
        $y = array_map(function($color) {
            $x = $color / 255;
            return $x <= self::BREAKPOINT
                ? $x / self::SLOPE
                : self::powerLawCurve($x);
        }, [$red, $green, $blue]);

        return self::LUMINANCE_RED * $y[0] + self::LUMINANCE_GREEN * $y[1] + self::LUMINANCE_BLUE * $y[2];
    }
    static public function contrastColor(string $hex): string {
        [$red, $green, $blue] = sscanf($hex, "%02X%02X%02X");

        $baseLuminance = self::relativeLuminance($red, $green, $blue);
        $darkerR = (int)($red * self::DARKER_END_APPROXIMATION);
        $darkerG = (int)($green * self::DARKER_END_APPROXIMATION);
        $darkerB = (int)($blue * self::DARKER_END_APPROXIMATION);
        $darkLuminance = self::relativeLuminance($darkerR, $darkerG, $darkerB);

        $luminance = min($baseLuminance, $darkLuminance);
        $contrastWithDark = ($luminance + self::WCAG_OFFSET) / self::WCAG_OFFSET;
        $contrastWithWhite = (1 + self::WCAG_OFFSET) / ($luminance + self::WCAG_OFFSET);

        error_log("hex: $hex | R:$red G:$green B:$blue");
        error_log("baseLum: $baseLuminance | darkLum: $darkLuminance | worstCase: $luminance");
        error_log("contrastWhite: $contrastWithWhite | contrastDark: $contrastWithDark");
        error_log("result: " . ($contrastWithWhite > $contrastWithDark ? 'WHITE' : 'DARK'));
        error_log("============");

        return $contrastWithWhite > $contrastWithDark ? "#ffffff" : "#1a1a2e";
    }

    static public function extractHsl(string $hsl): array {
        preg_match('/hsl\(\s*(\d+)\s*,\s*(\d+)%?\s*,\s*(\d+)%?\s*\)/', $hsl, $matches);

        return [
            'hue'        => (float) $matches[1],
            'saturation' => (float) $matches[2],
            'lightness'  => (float) $matches[3],
        ];
    }

    static public function hslToHex(float $hue, float $saturation, float $lightness): string
    {
        $saturation /= 100;
        $lightness  /= 100;

        $chroma   = (1 - abs(2 * $lightness - 1)) * $saturation;
        $huePrime = $hue / 60;
        $x        = $chroma * (1 - abs(fmod($huePrime, 2) - 1));

        [$r, $g, $b] = match(true) {
            $huePrime < 1 => [$chroma, $x,      0],
            $huePrime < 2 => [$x,      $chroma, 0],
            $huePrime < 3 => [0,       $chroma, $x],
            $huePrime < 4 => [0,       $x,      $chroma],
            $huePrime < 5 => [$x,      0,       $chroma],
            default       => [$chroma, 0,       $x],
        };

        $m = $lightness - $chroma / 2;

        return sprintf('%02X%02X%02X',
            (int)(($r + $m) * 255),
            (int)(($g + $m) * 255),
            (int)(($b + $m) * 255),
        );
    }

    /**
     * @param int $bgr a color value set as bgr number
     * @return string converted value into rgb hex string without "#"
     */
    static public function bgrIntToHex(int $bgr): string
    {
        $blue = ($bgr >> 16) & 0xFF;
        $green = ($bgr >> 8) & 0xFF;
        $red = ($bgr & 0xFF);

        return sprintf('%02X%02X%02X', $red, $green, $blue);
    }


    static public function generateGradient(int|string $color): string
    {
        $hex = is_int($color) ? self::bgrIntToHex($color) : $color;

        [$red, $green, $blue] = sscanf($hex, "%02X%02X%02X");

        $red /= 255;
        $green /= 255;
        $blue /= 255;

        $max = max($red, $green, $blue);
        $min = min($red, $green, $blue);
        $light = ($max + $min) / 2;

        if ($max === $min) {
            $hue = $saturation = 0;
        } else {
            $diff = $max - $min;
            $saturation = $light > 0.5 ? $diff / (2 - $max - $min) : $diff / ($max + $min);
            $hue = match ($max) {
                $red => ($green - $blue) / $diff + ($green < $blue ? 6 : 0),
                $green => ($blue - $red) / $diff + 2,
                $blue => ($red - $green) / $diff + 4,
            };
            $hue = round($hue / 6 * 360);
        }
        $saturation = round($saturation * 100);
        $light = round($light * 100);

        $from = "hsl($hue, $saturation%, " . min($light + 10, 90) . "%)";
        $to = "hsl(" . (($hue + 20) % 360) . ", " . min($saturation + 10, 100) . "%, " . max($light - 10, 10) . "%)";

        $textColor = self::contrastColor($hex);

        return implode("; ", [
            "background: linear-gradient(-135deg, $from 0%, $to 100%)",
            "color: $textColor",
        ]);
    }
}
