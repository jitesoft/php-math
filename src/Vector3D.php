<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector3D.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math;

/**
 * Class Vector3D
 *
 * Vector structure in 3D space.
 *
 * A vector consists of three floating point numbers and can be accessed through
 * either their get-accessors (getX, getY, getZ) or through array access.
 * (x/X/0, y/Y/1, z/Z/2).
 */
class Vector3D extends Vector {

    /**
     * Create a Vector3D.
     *
     * Vector3D constructor.
     *
     * @param float $x
     * @param float $y
     * @param float $z
     */
    public function __construct(float $x = 0, float $y = 0, float $z = 0) {
        $this->elements[0] = $x;
        $this->elements[1] = $y;
        $this->elements[2] = $z;
    }

    /**
     * Calculates the cross product of two vectors.
     *
     * @param Vector3D $vector
     */
    public function cross(Vector3D $vector) {
        $this->copy(VectorMath::cross($this, $vector));
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
     * Get the Z-Coordinate.
     *
     * @return float
     */
    public function getZ() : float {
        return $this->elements[2];
    }

    /**
     * Set the X-Coordinate of the point.
     *
     * @param float $x
     */
    public function setX(float $x) {
        $this->elements[0] = $x;
    }

    /**
     * Set the Y-Coordinate of the point.
     * @param float $y
     */
    public function setY(float $y) {
        $this->elements[1] = $y;
    }

    /**
     * Get the X-Coordinate of the point.
     *
     * @return float
     */
    public function getX() : float {
        return $this->elements[0];
    }

    /**
     * Get tye Y-Coordinate of the point.
     *
     * @return float
     */
    public function getY() : float {
        return $this->elements[1];
    }

}
