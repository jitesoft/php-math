<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector4D.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math;

/**
 * Class Vector4D
 *
 * A vector structure in four dimensional space.
 *
 *
 * A vector consists of four floating point numbers and can be accessed through
 * either their get-accessors (getX, getY, getZ, getW) or through array access.
 * (x/X/0, y/Y/1, z/Z/2, w/W/3).
 */
class Vector4D extends Vector {

    /**
     * Create a 4 dimensional vector.
     *
     * Vector4D constructor.
     * @param float $x
     * @param float $y
     * @param float $z
     * @param float $w
     */
    public function __construct(float $x = 0, float $y = 0, float $z = 0, float $w = 0) {
        $this->elements[0] = $x;
        $this->elements[1] = $y;
        $this->elements[2] = $z;
        $this->elements[3] = $w;
    }

    /**
     * Get the X-Coordinate.
     *
     * @return float
     */
    public function getX(): float {
        return $this->elements[0];
    }

    /**
     * Set the X-Coordinate.
     *
     * @param float $x
     */
    public function setX(float $x) {
        $this->elements[0] = $x;
    }

    /**
     * Get the Y-Coordinate.
     *
     * @return float
     */
    public function getY(): float {
        return $this->elements[1];
    }

    /**
     * Set the Y-Coordinate.
     *
     * @param float $y
     */
    public function setY(float $y) {
        $this->elements[1] = $y;
    }

    /**
     * Get the Z-Coordinate.
     *
     * @return float
     */
    public function getZ(): float {
        return $this->elements[2];
    }

    /**
     * Set the Z-Coordinate.
     *
     * @param float $z
     */
    public function setZ(float $z) {
        $this->elements[2] = $z;
    }

    /**
     * Get the W-Coordinate.
     *
     * @return float
     */
    public function getW(): float {
        return $this->elements[3];
    }

    /**
     * Set the W-Coordinate.
     *
     * @param float $w
     */
    public function setW(float $w) {
        $this->elements[3] = $w;
    }
}
