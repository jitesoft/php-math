<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  VectorMath.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math;

class VectorMath {

    /**
     * Vector multiplication.
     *
     * @param Vector $vector
     * @param Vector|float $value
     * @return Vector
     */
    public static function mul(Vector $vector, $value) : Vector {
        $type = get_class($vector);
        $out  = new $type();

        $count = count($out);
        if ($value instanceof Vector === false) {
            $value = new $type(...array_fill(0, $count , $value));
        }

        for ($i=$count;$i-->0;) {
            $out[$i] = $vector[$i] * $value[$i];
        }

        return $out;
    }

    /**
     * Vector division.
     *
     * @param Vector $vector
     * @param Vector|float $value
     * @return Vector
     */
    public static function div(Vector $vector, $value) : Vector {
        $type  = get_class($vector);
        $out   = new $type();
        $count = count($out);
        if ($value instanceof Vector === false) {
            $value = new $type(...array_fill(0, $count , $value));
        }

        for ($i=$count;$i-->0;) {
            $out[$i] = $vector[$i] / $value[$i];
        }

        return $out;
    }

    /**
     * Vector addition.
     *
     * @param Vector $vector
     * @param Vector|float $value
     * @return Vector
     */
    public static function add(Vector $vector, $value) : Vector {
        $type = get_class($vector);
        $out  = new $type();

        $count = count($out);
        if ($value instanceof Vector === false) {
            $value = new $type(...array_fill(0, $count, $value));
        }

        for ($i=$count;$i-->0;) {
            $out[$i] = $vector[$i] + $value[$i];
        }

        return $out;
    }

    /**
     * Vector subtraction.
     *
     * @param Vector $vector
     * @param Vector|float $value
     * @return Vector
     */
    public static function sub(Vector $vector, $value) : Vector {
        $type = get_class($vector);
        $out  = new $type();

        $count = count($out);
        if ($value instanceof Vector === false) {
            $value = new $type(...array_fill(0, $count, $value));
        }

        for ($i=$count;$i-->0;) {
            $out[$i] = $vector[$i] - $value[$i];
        }

        return $out;
    }

    /**
     * Dot product of two vectors/points.
     *
     * @param Vector $vector1
     * @param Vector $vector2
     * @return float
     */
    public static function dot(Vector $vector1, Vector $vector2) : float {
        $count = count($vector1);
        $value = 0;
        for ($i=0;$i<$count;$i++) {
            $value += ($vector1[$i] * $vector2[$i]);
        }
        return $value;
    }

    /**
     * Cross product of two vectors.
     *
     * @param Vector3D $value1
     * @param Vector3D $value2
     * @return Vector3D
     */
    public static function cross(Vector3D $value1, Vector3D $value2) : Vector3D {
        return new Vector3D(
            ($value1->getY() * $value2->getZ()) - ($value1->getZ() * $value2->getY()),
            -(($value1->getX() * $value2->getZ()) - ($value1->getZ() * $value2->getX())),
            ($value1->getX() * $value2->getY()) - ($value1->getY() * $value2->getX())
        );
    }

    /**
     * Distance between two vectors/points.
     *
     * @param Vector $value1
     * @param Vector $value2
     * @return float
     */
    public static function distance(Vector $value1, Vector $value2) : float {
        return sqrt(self::distance2($value1, $value2));
    }

    /**
     * Squared distance between two vectors/points.
     *
     * @param Vector $vector1
     * @param Vector $vector2
     * @return float
     */
    public static function distance2(Vector $vector1, Vector $vector2) : float {
        $value = 0;
        $count = count($vector1);
        for ($i = 0;$i<$count;$i++) {
            $value += ($vector1[$i] - $vector2[$i]) * ($vector1[$i] - $vector2[$i]);
        }
        return $value;
    }
}
