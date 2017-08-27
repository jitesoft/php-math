<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  VectorAccessTrait.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math\Traits;

use Exception;
use InvalidArgumentException;
use Jitesoft\Utilities\Math\Exceptions\NotImplementedException;
use OutOfBoundsException;

/**
 * Trait VectorAccessTrait
 *
 * Trait used by Vector structures to enable array access by any type of offset set in the $offset variable.
 */
trait VectorAccessTrait {

    /**
     * @param mixed $offset
     * @param mixed $default
     * @return null|string|bool
     * @throws Exception
     */
    private function convertOffset($offset, $default = null) {
        if (!is_int($offset)) {
            $val    = array_search(mb_strtolower($offset), self::$offsets);
            $offset = $val === false ? -1 : $val;
        }

        if ($offset >= 0 && $offset < count($this->elements)) {
            return $offset;
        }

        if ($default !== null) {
            return $default;
        }
        throw new OutOfBoundsException("Out of range. Invalid offset.");
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset) {
        return $this->convertOffset($offset, false) !== false;
    }

    /**
     * @param mixed $offset
     * @return float
     * @throws Exception
     */
    public function offsetGet($offset) {
        $offset = $this->convertOffset($offset);
        return $this->elements[$offset];
    }

    /**
     * @param int $offset
     * @param float $value
     * @throws Exception
     */
    public function offsetSet($offset, $value) {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException("Invalid value. Value must be a number.");
        }
        $offset                  = $this->convertOffset($offset);
        $this->elements[$offset] = $value;
    }

    /**
     * @param mixed $offset
     * @throws Exception
     */
    public function offsetUnset($offset) {
        throw new NotImplementedException("Invalid method.");
    }
}
