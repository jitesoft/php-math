<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix44.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math;

/**
 * Class Matrix44
 *
 * A 4x4 matrix structure.
 */
class Matrix44 extends Matrix {

    public const COLUMNS = 4;
    public const ROWS    = 4;

    public function __construct(
        float $x1 = 1, float $y1 = 0, float $z1 = 0, float $w1 = 0,
        float $x2 = 0, float $y2 = 1, float $z2 = 0, float $w2 = 0,
        float $x3 = 0, float $y3 = 0, float $z3 = 1, float $w3 = 0,
        float $x4 = 0, float $y4 = 0, float $z4 = 0, float $w4 = 1) {

        $this->vectors[0] = new Vector4D($x1, $y1, $z1, $w1);
        $this->vectors[1] = new Vector4D($x2, $y2, $z2, $w2);
        $this->vectors[2] = new Vector4D($x3, $y3, $z3, $w3);
        $this->vectors[3] = new Vector4D($x4, $y4, $z4, $w4);
    }

    /**
     * {@inheritdoc}
     */
    public function setRotationX(float $angle, string $type = Math::DEGREES) {
        $rot33 = MatrixMath::makeRotationX($angle, $type);
        $rot44 = new Matrix44(
            $rot33[0][0], $rot33[0][1], $rot33[0][2], 0,
            $rot33[1][0], $rot33[1][1], $rot33[1][2], 0,
            $rot33[2][0], $rot33[2][1], $rot33[2][2], 0,
            0, 0, 0, 1
        );

        $this->mul($rot44);
    }

    /**
     * {@inheritdoc}
     */
    public function setRotationY(float $angle, string $type = Math::DEGREES) {
        $rot33 = MatrixMath::makeRotationY($angle, $type);
        $rot44 = new Matrix44(
            $rot33[0][0], $rot33[0][1], $rot33[0][2], 0,
            $rot33[1][0], $rot33[1][1], $rot33[1][2], 0,
            $rot33[2][0], $rot33[2][1], $rot33[2][2], 0,
            0, 0, 0, 1
        );

        $this->mul($rot44);
    }

    /**
     * {@inheritdoc}
     */
    public function setRotationZ(float $angle, string $type = Math::DEGREES) {
        $rot33 = MatrixMath::makeRotationZ($angle, $type);
        $rot44 = new Matrix44(
            $rot33[0][0], $rot33[0][1], $rot33[0][2], 0,
            $rot33[1][0], $rot33[1][1], $rot33[1][2], 0,
            $rot33[2][0], $rot33[2][1], $rot33[2][2], 0,
            0, 0, 0, 1
        );

        $this->mul($rot44);
    }
}
