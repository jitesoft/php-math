<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Math.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math;

/**
 * Class Math
 *
 * Misc math methods.
 */
class Math {

    public const DEGREES = "degree";
    public const RADIANS = "radians";

    private const ONE_DEG_PI = 57.2957795131;

    /**
     * Convert degrees to radians.
     *
     * @param float $deg
     * @return float
     */
    public static function degToRad(float $deg) {
        return $deg / self::ONE_DEG_PI;

    }

    /**
     * Convert radians to degrees.
     *
     * @param float $rad
     * @return float
     */
    public static function radToDeg(float $rad) {
        return $rad * self::ONE_DEG_PI;
    }
}
