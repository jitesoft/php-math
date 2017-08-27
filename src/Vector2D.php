<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector2D.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math;

/**
 * Class Vector2D
 *
 * Vector structure in 2D space.
 *
 * A vector consists of two floating point numbers and can be accessed through
 * either their get-accessors (getX, getY) or through array access.
 * (x/X/0, y/Y/1).
 */
class Vector2D extends Vector {

    /**
     * Create a Vector2D instance.
     *
     * Vector2D constructor.
     *
     * @param float $x Initial X-Coordinate.
     * @param float $y Initial Y-Coordinate.
     */
    public function __construct(float $x = 0, float $y = 0) {
        $this->elements[0] = $x;
        $this->elements[1] = $y;
    }

    /**
     * Set the X and Y coordinate of the vector.
     *
     * @param float $x X-Coordinate.
     * @param float $y Y-Coordinate.
     */
    public function set(float $x, float $y) {
        $this->setX($x);
        $this->setY($y);
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

}
