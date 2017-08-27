<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Point.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math;

/**
 * Class Point2D
 *
 * A point in a two dimensional space.
 */
class Point2D {

    /** @var float */
    protected $x;
    /** @var float */
    protected $y;

    /**
     * Initialize a point object.
     *
     * Point2D constructor.
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x = 0, float $y = 0) {
        $this->x = $x;
        $this->y = $y;
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
