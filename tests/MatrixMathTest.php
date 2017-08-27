<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  MatrixMathTest.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math\Tests;

use Jitesoft\Utilities\Math\Exceptions\NotImplementedException;
use Jitesoft\Utilities\Math\Math;
use Jitesoft\Utilities\Math\Matrix33;
use Jitesoft\Utilities\Math\Matrix44;
use Jitesoft\Utilities\Math\MatrixMath;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class MatrixMathTest extends TestCase {

    public function testIdentity33() {
        $this->assertEquals(new Matrix33(
            1, 0, 0,
            0, 1, 0,
            0, 0, 1
        ), MatrixMath::identity(Matrix33::class));
    }

    public function testIdentity44() {
        $this->assertEquals(new Matrix44(
            1, 0, 0, 0,
            0, 1, 0, 0,
            0, 0, 1,  0,
            0, 0, 0, 1
        ), MatrixMath::identity(Matrix44::class));
    }


    public function testCalculateDeterminant() {
        // 2x2
        $det = MatrixMath::calculateDeterminant(
            [
                [1, 2],
                [3, 4]
            ]
        );

        $this->assertEquals(-2, $det);

        // 3x3
        $det = MatrixMath::calculateDeterminant(
            [
                [1, 2, 3],
                [4, 5, 6],
                [7, 8, 9]
            ]
        );

        $this->assertEquals(0, $det);

        // 4x4
        $det = MatrixMath::calculateDeterminant(
            [
                [1, 3, 5, 9],
                [1, 3, 1, 7],
                [4, 4, 9, 7],
                [5, 2, 0, 9]
            ]
        );
        $this->assertEquals(-470, $det);
    }

    public function testCalculateDeterminantInvalidMatrix() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Can only calculate determinant from square matrix (same amount of rows as columns)."
        );


        MatrixMath::calculateDeterminant([
            [1,2],
            [3,4],
            [5,6]
        ]);
    }

    public function testGetSubMatrix() {
        // 2x2

        $co = MatrixMath::getSubMatrix(
            [
                [1, -4],
                [4, -7]
            ], 0, 0
        );

        $this->assertEquals([
            [-7]
        ], $co);

        // 3x3

        $co = MatrixMath::getSubMatrix(
            [
                [0, 9, 3],
                [2, 0, 4],
                [3, 7, 0]
            ], 1, 1
        );

        $this->assertEquals(
            [
               [0, 3],
               [3, 0]
            ],
        $co);


    }

    public function testMulScalar33() {
        $matrix = new Matrix33(
            4, 3, 2,
            32, 7, -14,
            9, 1, 3
        );

        $out = MatrixMath::mul($matrix, 3);
        $this->assertEquals($out, MatrixMath::mulScalar($matrix, 3));
        $this->assertEquals(new Matrix33(
            12, 9, 6,
            96, 21, -42,
            27, 3, 9
        ), $out);
    }

    public function testMulScalar44() {
        $matrix = new Matrix44(
            1, 9, 14, 4,
            9, 83, 11, -12,
            -5, 13, -14, 5,
            -5, 8, 3, 7
        );

        $out = MatrixMath::mul($matrix, 3);
        $this->assertEquals($out, MatrixMath::mulScalar($matrix, 3));
        $this->assertEquals(new Matrix44(
            3, 27, 42, 12,
            27, 249, 33, -36,
            -15, 39, -42, 15,
            -15, 24, 9, 21
        ), $out);
    }

    public function testMulMatrix33() {
        $m1 = new Matrix33(1,2,3, 4,5,6, 7,8,9);
        $m2 = new Matrix33(9, 8, 7, 6, 5, 4, 3, 2, 1);

        $out = MatrixMath::mul($m1, $m2);
        $this->assertEquals($out, MatrixMath::mulMatrix($m1, $m2));
        $this->assertEquals(new Matrix33(
            30, 24, 18,
            84, 69, 54,
            138, 114, 90
        ), $out);
    }

    public function testMulMatrix44() {
        $m1 = new Matrix44(1,2,3, 4,5,6, 7,8,9, 10, 11, 12, 13, 14, 15, 16);
        $m2 = new Matrix44(9, 8, 7, 6, 5, 4, 3, 2, 1, -1, -2, -3, -4, -5, -6, -7);

        $out = MatrixMath::mul($m1, $m2);
        $this->assertEquals($out, MatrixMath::mulMatrix($m1, $m2));
        $this->assertEquals(new Matrix44(
            6, -7, -17, -27,
            50, 17, -9, -35,
            94, 41, -1, -43,
            138, 65, 7, -51
        ), $out);
    }

    public function testMulMatrixNotSame() {
        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessage(
            "Matrix multiplication without same row/column count not yet implemented."
        );

        MatrixMath::mul(new Matrix44(), new Matrix33());
    }

    public function testAdd() {
        $m1 = new Matrix44(1,2,3, 4,5,6, 7,8,9, 10, 11, 12, 13, 14, 15, 16);
        $m2 = new Matrix44(1,2,3, 4,5,6, 7,8,9, 10, 11, 12, 13, 14, 15, 16);

        $out = MatrixMath::add($m1, $m2);
        $this->assertEquals(new Matrix44(
            2, 4, 6, 8,
            10, 12, 14, 16,
            18, 20, 22, 24,
            26, 28, 30, 32

        ), $out);

        $m1 = new Matrix33(1,2,3, 4,5,6, 7,8,9);
        $m2 = new Matrix33(9, 8, 7, 6, 5, 4, 3, 2, 1);


        $out = MatrixMath::add($m1, $m2);
        $this->assertEquals(new Matrix33(
            10, 10, 10,
            10, 10, 10,
            10, 10, 10
        ), $out);

    }

    public function testAddNotSame() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Can only add matrices of same size."
        );

        MatrixMath::add(new Matrix44(), new Matrix33());
    }

    public function testSub() {
        $m1 = new Matrix44(1,2,3, 4,5,6, 7,8,9, 10, 11, 12, 13, 14, 15, 16);
        $m2 = new Matrix44(1,2,3, 4,5,6, 7,8,9, 10, 11, 12, 13, 14, 15, 16);

        $out = MatrixMath::sub($m1, $m2);
        $this->assertEquals(new Matrix44(
            0,0,0,0,
            0,0,0,0,
            0,0,0,0,
            0,0,0,0
        ), $out);

        $m1 = new Matrix33(1,2,3, 4,5,6, 7,8,9);
        $m2 = new Matrix33(9, 8, 7, 6, 5, 4, 3, 2, 1);

        $out = MatrixMath::sub($m1, $m2);
        $this->assertEquals(new Matrix33(
            -8, -6, -4,
            -2, 0, 2,
            4, 6, 8
        ), $out);
    }

    public function testSubNotSame() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Can only subtract matrices of same size."
        );

        MatrixMath::sub(new Matrix44(), new Matrix33());
    }

    public function testMakeRotationDegX() {
        $out = MatrixMath::makeRotationX(40, Math::DEGREES);
        $rad = 40 / 57.2957795131;
        $this->assertEquals(
            new Matrix33(
                1, 0, 0,
                0, cos($rad), -sin($rad),
                0, sin($rad), cos($rad)
            ),
            $out
        );
    }

    public function testMakeRotationDegY() {
        $out = MatrixMath::makeRotationY(40, Math::DEGREES);
        $rad = 40 / 57.2957795131;

        $this->assertEquals(
            new Matrix33(
                cos($rad), 0, sin($rad),
                0, 1, 0,
                -sin($rad), 0, cos($rad)
            ),
            $out
        );
    }

    public function testMakeRotationDegZ() {
        $out = MatrixMath::makeRotationZ(40, Math::DEGREES);
        $rad = 40 / 57.2957795131;

        $this->assertEquals(
            new Matrix33(
                cos($rad), -sin($rad), 0,
                sin($rad), cos($rad), 0,
                0, 0, 1
            ),
            $out
        );
    }


    public function testMakeRotationRadX() {
        $rad = 1.04719755; // ~60deg.
        $out = MatrixMath::makeRotationX($rad, Math::RADIANS);

        $this->assertEquals(
            new Matrix33(
                1, 0, 0,
                0, cos($rad), -sin($rad),
                0, sin($rad), cos($rad)
            ),
            $out
        );
    }

    public function testMakeRotationRadY() {
        $rad = 1.04719755; // ~60deg.
        $out = MatrixMath::makeRotationY($rad, Math::RADIANS);

        $this->assertEquals(
            new Matrix33(
                cos($rad), 0, sin($rad),
                0, 1, 0,
                -sin($rad), 0, cos($rad)
            ),
            $out
        );
    }

    public function testMakeRotationRadZ() {
        $rad = 1.04719755; // ~60deg.
        $out = MatrixMath::makeRotationZ($rad, Math::RADIANS);

        $this->assertEquals(
            new Matrix33(
                cos($rad), -sin($rad), 0,
                sin($rad), cos($rad), 0,
                0, 0, 1
            ),
            $out
        );
    }

}
