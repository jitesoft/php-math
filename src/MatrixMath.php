<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  MatrixMath.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math;

use Exception;
use InvalidArgumentException;
use Jitesoft\Exceptions\LazyExceptions\NotImplementedException;

/**
 * Class MatrixMath
 *
 * Math helper class for all matrix implementations.
 */
class MatrixMath {

    /**
     * Create an identity matrix of given matrix type.
     *
     * @param string $type defaults to Matrix44
     * @return Matrix
     */
    public static function identity($type = Matrix44::class) : Matrix {
        $matrix = new $type();

        for ($i=0;$i<$type::ROWS;$i++) {
            for ($j=0;$j<$type::COLUMNS;$j++) {
                $matrix[$i][$j] = $i === $j ? 1 : 0;
            }
        }
        return $matrix;
    }

    /**
     * Get sub matrix for a given matrix in float[][] format.
     *
     * @param float[][] $matrix
     * @param int $skipRow
     * @param int $skipColumn
     * @return array|float[][]
     */
    public static function getSubMatrix($matrix, $skipRow = 0, $skipColumn = 0) : array {
        $size     = count($matrix);
        $newSize  = $size-1;
        $cfRow    = 0;
        $cfColumn = 0;
        $cfMatrix = [];

        for ($row=0;$row<$size;$row++) {
            for ($col=0;$col<$size;$col++) {

                if ($row !== $skipRow && $col !== $skipColumn) {
                    if (!isset($cfMatrix[$cfRow])) {
                        $cfMatrix[$cfRow] = [];
                    }
                    $cfMatrix[$cfRow][$cfColumn++] = $matrix[$row][$col];
                    if ($cfColumn === ($newSize)) {
                        $cfColumn = 0;
                        $cfRow++;
                    }
                }
            }
        }
        return $cfMatrix;
    }

    /**
     * Calculate the determinant of a matrix in float[][] format.
     * Only square matrices (same amount of rows and columns) can be calculated.
     *
     * @param float[][] $matrix
     * @return float
     * @throws Exception Throws a Exception if matrix is not square.
     */
    public static function calculateDeterminant($matrix) : float {
        // The ´rows´ args is the only needed one. Determinants can only be calculated
        // from a square matrix. Hence we use the row as size for both row and column.
        $determinant = 0;
        $rcCount     = count($matrix);
        if ($rcCount !== count($matrix[0])) {
            throw new InvalidArgumentException(
                "Can only calculate determinant from square matrix (same amount of rows as columns)."
            );
        }

        // If only one element, return the value from it.
        if ($rcCount === 1) {
            return $matrix[0][0];
        }

        $sign = 1;
        // Go through each element in first row.
        for ($counter=0;$counter<$rcCount;$counter++) {
            // Create a cofactor sub-matrix ($rcCount-1 in size).
            $subMatrix = self::getSubMatrix($matrix, 0, $counter);
            // Calculate the determinant of the sub-matrix.
            $determinant += $sign * $matrix[0][$counter] * self::calculateDeterminant($subMatrix);
            $sign         = -$sign;
        }

        return $determinant;
    }


    /**
     * Matrix multiplication.
     *
     * Multiplies the Matrix with either a scalar or another matrix.
     *
     * Currently only supports matrix multiplication with same type of matrices.
     *
     * @param Matrix $matrix
     * @param float|Matrix $value
     * @return Matrix
     * @throws Exception
     */
    public static function mul(Matrix $matrix, $value) : Matrix {

        if ($value instanceof Matrix) {
            return self::mulMatrix($matrix, $value);
        }

        if (is_numeric($value)) {
            return self::mulScalar($matrix, $value);
        }

        $type = gettype($value);
        throw new InvalidArgumentException("Invalid type. Can not multiply a matrix with {$type}.");
    }

    /**
     * Matrix multiplication.
     * Multiplies the first arg matrix with the second arg matrix and returns a result matrix.
     *
     * Currently only supports multiplication with same type of matrices.
     *
     * @param Matrix $matrix
     * @param Matrix $matrix2
     * @return Matrix
     * @throws Exception
     */
    public static function mulMatrix(Matrix $matrix, Matrix $matrix2) : Matrix {
        $type  = get_class($matrix);
        $type2 = get_class($matrix2);

        if ($type !== $type2) {
            throw new NotImplementedException(
                "Matrix multiplication without same row/column count not yet implemented."
            );
        }

        $result = new $type();

        for ($x=0;$x<$type::ROWS;$x++) {
            for ($y=0;$y<$type::ROWS;$y++) {
                $value = 0;
                for ($z=0;$z<$type::COLUMNS;$z++) {
                    $value += $matrix[$y][$z] * $matrix2[$z][$x];
                }
                $result[$y][$x] = $value;
            }
        }

        return $result;
    }

    /**
     * Matrix scalar multiplication.
     *
     * @param Matrix $matrix
     * @param float $scalar
     * @return Matrix
     */
    public static function mulScalar(Matrix $matrix, float $scalar) : Matrix {
        $type   = get_class($matrix);
        $result = new $type();

        for ($i=0;$i<$type::ROWS;$i++) {
            for ($j=0;$j<$type::COLUMNS;$j++) {
                $result[$i][$j] = $matrix[$i][$j] * $scalar;
            }
        }

        return $result;
    }


    /**
     * Matrix Matrix addition.
     *
     * @param Matrix $matrix
     * @param Matrix $matrix2
     * @return Matrix
     * @throws Exception
     */
    public static function add(Matrix $matrix, Matrix $matrix2) : Matrix {
        $type  = get_class($matrix);
        $type2 = get_class($matrix2);

        if ($type !== $type2) {
            throw new InvalidArgumentException("Can only add matrices of same size.");
        }

        $result = new $type();

        for ($i=0;$i<$type::ROWS;$i++) {
            for ($j=0;$j<$type::COLUMNS;$j++) {
                $result[$i][$j] = $matrix[$i][$j] + $matrix2[$i][$j];
            }
        }

        return $result;
    }

    /**
     * Matrix Matrix subtraction.
     *
     * @param Matrix $matrix
     * @param Matrix $matrix2
     * @return Matrix
     * @throws Exception
     */
    public static function sub(Matrix $matrix, Matrix $matrix2) : Matrix {
        $type  = get_class($matrix);
        $type2 = get_class($matrix2);

        if ($type !== $type2) {
            throw new InvalidArgumentException("Can only subtract matrices of same size.");
        }


        $result = new $type();

        for ($i=0;$i<$type::ROWS;$i++) {
            for ($j=0;$j<$type::COLUMNS;$j++) {
                $result[$i][$j] = $matrix[$i][$j] - $matrix2[$i][$j];
            }
        }

        return $result;
    }

    /**
     * Create a rotation matrix with given X angle rotation.
     *
     * @param float $angle
     * @param string $type If degrees or radians, see Math constants.
     * @return Matrix33
     */
    public static function makeRotationX(float $angle, string $type = Math::DEGREES) : Matrix33 {
        if ($type === Math::DEGREES) {
            $angle = Math::degToRad($angle);
        }

        return new Matrix33(
            1, 0, 0,
            0, cos($angle), - sin($angle),
            0, sin($angle), cos($angle)
        );
    }

    /**
     * Create a rotation matrix with given Y angle rotation.
     *
     * @param float $angle
     * @param string $type If degrees or radians, see Math constants.
     * @return Matrix33
     */
    public static function makeRotationY(float $angle, string $type = Math::DEGREES) : Matrix33 {
        if ($type === Math::DEGREES) {
            $angle = Math::degToRad($angle);
        }

        return new Matrix33(
            cos($angle), 0, sin($angle),
            0, 1, 0,
            - sin($angle), 0, cos($angle)
        );
    }

    /**
     * Create a rotation matrix with given Z angle rotation.
     *
     * @param float $angle
     * @param string $type If degrees or radians, see Math constants.
     * @return Matrix33
     */
    public static function makeRotationZ(float $angle, string $type = Math::DEGREES) : Matrix33 {
        if ($type === Math::DEGREES) {
            $angle = Math::degToRad($angle);
        }

        return new Matrix33(
            cos($angle), - sin($angle), 0,
            sin($angle), cos($angle), 0,
            0, 0, 1
        );
    }
}
