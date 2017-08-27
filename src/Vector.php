<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math;

use ArrayAccess;
use Countable;
use Jitesoft\Utilities\Math\Traits\VectorAccessTrait;

/**
 * Class Vector
 *
 * Baseclass for all vector structures.
 */
abstract class Vector  implements ArrayAccess, Countable {
    use VectorAccessTrait;

    /**
     * {@inheritDoc}
     */
    public function count() {
        return count($this->elements);
    }

    /** @var string[] */
    protected static $offsets = [
        'x', 'y', 'z', 'w'
    ];

    /** @var float[] */
    protected $elements;

    /**
     * @param Vector $vector
     */
    protected function copy(Vector $vector) {
        $count = count($this->elements);
        for ($i=0;$i<$count;$i++) {
            $this[$i] = $vector[$i];
        }
    }

    /**
     * Vector length.
     *
     * @return float
     */
    public function length() : float {
        return sqrt($this->length2());
    }

    /**
     * Squared vector length.
     *
     * @return float
     */
    public function length2() : float {
        $value = 0;
        $count = count($this->elements);
        for ($i=0;$i<$count;$i++) {
            $value += ($this[$i] * $this[$i]);
        }
        return $value;
    }


    /**
     * Vector multiplication.
     *
     * @param float|int|Vector $value
     */
    public function mul($value) {
        $this->copy(VectorMath::mul($this, $value));

    }

    /**
     * Vector division.
     *
     * @param float|int|Vector $value
     */
    public function div($value) {
        $this->copy(VectorMath::div($this, $value));
    }

    /**
     * Vector addition.
     *
     * @param Vector|float|int $value
     */
    public function add($value) {
        $this->copy(VectorMath::add($this, $value));
    }

    /**
     * Vector subtraction.
     *
     * @param Vector|float|int $value
     */
    public function sub($value) {
        $this->copy(VectorMath::sub($this, $value));
    }

    /**
     * Calculate dot product of two vectors.
     *
     * @param Vector $value
     * @return float
     */
    public function dot(Vector $value) {
        return VectorMath::dot($this, $value);
    }

    /**
     * Calculate distance between two vectors.
     *
     * @param Vector $value
     * @return float
     */
    public function distance(Vector $value) : float {
        return VectorMath::distance($this, $value);
    }

    /**
     * Calculate square distance between two vectors.
     *
     * @param Vector $value
     * @return float
     */
    public function distance2(Vector $value) {
        return VectorMath::distance2($this, $value);
    }

    /**
     * Normalizes the vector.
     */
    public function normalize() {
        $len =  $this->length();

        if ($len === 0.0) {
            return;
        }
        $count = count($this->elements);
        for ($i=0;$i<$count;$i++) {
            $this[$i] /= $len;
        }
    }

    /**
     * Convert the vector to an array.
     */
    public function toArray() {
        $result = [];
        $count  = count($this->elements);
        for ($i=0;$i<$count;$i++) {
            $result[] = $this->elements[$i];
        }
        return $result;
    }

    /**
     * Set vector to values from passed array.
     *
     * @param float[] $vector
     */
    public function fromArray(array $vector) {
        $count = count($vector);
        for ($i=0;$i<$count;$i++) {
            $this->elements[$i] = $vector[$i];
        }
    }

}
