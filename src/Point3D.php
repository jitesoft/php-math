<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Point3D.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\Math;

/**
 * Class Point3D
 *
 * A point in a three dimensional space.
 */
class Point3D {

    /** @var float */
    protected $x;
    /** @var float */
    protected $y;
    /** @var float */
    protected $z;

    /**
     * Initialize a point object.
     *
     * Point3D constructor.
     * @param float $x
     * @param float $y
     * @param float $z
     */
    public function __construct(float $x = 0, float $y = 0, float $z = 0) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * Set the Z-Coordinate.
     *
     * @param float $z
     */
    public function setZ(float $z) {
        $this->z = $z;
    }

    /**
     * Get the Z-Coordinate.
     *
     * @return float
     */
    public function getZ() : float {
        return $this->z;
    }

    /**
     * Set the X-Coordinate of the point.
     *
     * @param float $x
     */
    public function setX(float $x) {
        $this->x = $x;
    }

    /**
     * Set the Y-Coordinate of the point.
     * @param float $y
     */
    public function setY(float $y) {
        $this->y = $y;
    }

    /**
     * Get the X-Coordinate of the point.
     *
     * @return float
     */
    public function getX() : float {
        return $this->x;
    }

    /**
     * Get tye Y-Coordinate of the point.
     *
     * @return float
     */
    public function getY() : float {
        return $this->y;
    }
}
