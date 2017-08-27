<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix33Test.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math\Tests;

use Jitesoft\Utilities\Math\Exceptions\InvalidOperationException;
use Jitesoft\Utilities\Math\Math;
use Jitesoft\Utilities\Math\Matrix33;
use Jitesoft\Utilities\Math\MatrixMath;
use Jitesoft\Utilities\Math\Vector3D as Vector;
use OutOfBoundsException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class Matrix33Test extends TestCase {


    public function testGetInnerVector() {
        $matrix = new Matrix33(1,2,3,4,5,6,7,8,9);
        $this->assertInstanceOf(Vector::class, $matrix[0]);
        $this->assertInstanceOf(Vector::class, $matrix[1]);
        $this->assertInstanceOf(Vector::class, $matrix[2]);
    }

    public function testGetValue() {
        $matrix = new Matrix33(1,2,3,4,5,6,7,8,9);

        $this->assertEquals(1, $matrix[0][0]);
        $this->assertEquals(2, $matrix[0][1]);
        $this->assertEquals(3, $matrix[0][2]);

        $this->assertEquals(4, $matrix[1][0]);
        $this->assertEquals(5, $matrix[1][1]);
        $this->assertEquals(6, $matrix[1][2]);

        $this->assertEquals(7, $matrix[2][0]);
        $this->assertEquals(8, $matrix[2][1]);
        $this->assertEquals(9, $matrix[2][2]);
    }

    public function testGetValueOutOfRange() {
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Out of range. This matrix has 3 * 3 indexes.");

        $matrix = new Matrix33();
        $matrix[10];
    }

    public function testSetValues() {

        $matrix = new Matrix33(1,2,3,4,5,6,7,8,9);

        $matrix[0][0] = 10;
        $matrix[0][1] = 20;
        $matrix[0][2] = 30;
        $matrix[1][0] = 40;
        $matrix[1][1] = 50;
        $matrix[1][2] = 60;
        $matrix[2][0] = 70;
        $matrix[2][1] = 80;
        $matrix[2][2] = 90;

        $this->assertEquals(10, $matrix[0][0]);
        $this->assertEquals(20, $matrix[0][1]);
        $this->assertEquals(30, $matrix[0][2]);
        $this->assertEquals(40, $matrix[1][0]);
        $this->assertEquals(50, $matrix[1][1]);
        $this->assertEquals(60, $matrix[1][2]);
        $this->assertEquals(70, $matrix[2][0]);
        $this->assertEquals(80, $matrix[2][1]);
        $this->assertEquals(90, $matrix[2][2]);
    }

    public function testSetInnerError() {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage("Invalid operation.");

        $matrix    = new Matrix33();
        $matrix[0] = "value";
    }

    public function testUnsetError() {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage("Invalid operation.");

        $matrix = new Matrix33();
        unset($matrix[0]);
    }

    public function testSetIdentity() {
        $matrix = new Matrix33();

        $static = MatrixMath::identity(Matrix33::class);
        $matrix->identity();

        $this->assertEquals($static, $matrix);
        $this->assertEquals(1, $matrix[0][0]);
        $this->assertEquals(0, $matrix[0][1]);
        $this->assertEquals(0, $matrix[0][2]);

        $this->assertEquals(0, $matrix[1][0]);
        $this->assertEquals(1, $matrix[1][1]);
        $this->assertEquals(0, $matrix[1][2]);

        $this->assertEquals(0, $matrix[2][0]);
        $this->assertEquals(0, $matrix[2][1]);
        $this->assertEquals(1, $matrix[2][2]);
    }

    public function testTranspose() {
        $m = new Matrix33(
            1, 2, 3,
            4, 5, 6,
            7, 8, 9
        );

        $m->transpose();

        $this->assertEquals(new Matrix33(
            1, 4, 7,
            2, 5, 8,
            3, 6, 9
        ), $m);
    }

    public function testDeterminant() {
        $matrix = new Matrix33(
            2,1,0,
            2,0,0,
            2,0,1
        );

        $this->assertEquals(-2, $matrix->determinant());

        $matrix = new Matrix33(
            6,1,1,
            4,-2,5,
            2,8,7
        );

        $this->assertEquals(-306, $matrix->determinant());
    }

    public function testGetAdjoinMatrix() {
        $matrix = new Matrix33(
            9, 3, 5,
            -6, -9, 7,
            -1, -8, 1
        );

        $minors = $matrix->getAdjoinMatrix();
        $this->assertEquals($minors, new Matrix33(
            47, 1, 39,
            43, 14, -69,
            66, 93, -63
        ));
    }

    public function testInverse() {
        $matrix = new Matrix33(
            9,3,5,
            -6,-9,7,
            -1,-8, 1
        );

        $matrix->inverse();
        $d = 1/615;

        $this->assertEquals(new Matrix33(
            47 * $d, -43 * $d, 66 * $d,
            -1 * $d, 14 * $d, -93 * $d,
            39 * $d, 69 * $d, -63 * $d
        ), $matrix);
    }

    public function testInverseWithZeroDeterminant() {
        $matrix = new Matrix33(
            1,2,3,
            4,5,6,
            7,8,9
        );
        $this->assertEquals(0, $matrix->determinant());
        $matrix->inverse();
        $this->assertEquals(new Matrix33(1,2,3,4,5,6,7,8, 9), $matrix);
    }

    public function testMulMatrix() {
        $matrix1 = new Matrix33(1,2,3,4,5,6,7,8,9);
        $matrix2 = new Matrix33(1,2,3,4,5,6,7,8,9);

        $result = MatrixMath::mul($matrix1, $matrix2);
        $matrix1->mul($matrix2);

        $this->assertEquals($matrix1, $result);
        $this->assertEquals(new Matrix33(
            30, 36, 42,
            66, 81, 96,
            102, 126, 150
        ), $matrix1);
    }

    public function testMulFloat() {
        $matrix = new Matrix33(1,2,3,4,5,6,7,8,9);
        $scalar = 10;

        $result = MatrixMath::mul($matrix, $scalar);
        $matrix->mul($scalar);

        $this->assertEquals($result, $matrix);
        $this->assertEquals(new Matrix33(
            10 ,20, 30,
            40, 50, 60,
            70, 80, 90
        ), $matrix);
    }

    public function testMulError() {
        $matrix = new Matrix33();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid type. Can not multiply a matrix with string.");

        $matrix->mul("aaa");
    }

    public function testAdd() {
        $matrix  = new Matrix33(-5, -1, 5, 1, -2, 1, 1, 9, -5);
        $matrix2 = new Matrix33(2, 2, 9, -3, 5, 2, 3, 8 ,3);

        $result = MatrixMath::add($matrix, $matrix2);
        $matrix->add($matrix2);

        $this->assertEquals($matrix, $result);
        $this->assertEquals(new Matrix33(
            -3, 1, 14,
            -2, 3, 3,
            4, 17, -2

        ), $matrix);
    }

    public function testSub() {
        $matrix  = new Matrix33(9, 0, -2, 3, 4, 9, 7, 2, 9);
        $matrix2 = new Matrix33(-5, 4, 7, -1, -1, 8, 2, 8, -5);

        $result = MatrixMath::sub($matrix, $matrix2);
        $matrix->sub($matrix2);

        $this->assertEquals($matrix, $result);
        $this->assertEquals(new Matrix33(
            14, -4, -9,
            4, 5, 1,
            5, -6, 14
        ), $matrix);
    }

    public function testRotationX() {
        $matrix  = MatrixMath::makeRotationX(90);
        $matrix2 = MatrixMath::makeRotationX(90 * (pi() / 180), Math::RADIANS);

        $this->assertEquals($matrix, $matrix2);
        $this->assertEquals(new Matrix33(
            1,0,0,
            0,0,-1,
            0,1,0
        ), $matrix);
    }

    public function testRotationY() {
        $matrix  = MatrixMath::makeRotationY(90);
        $matrix2 = MatrixMath::makeRotationY(90 * (pi() / 180), Math::RADIANS);

        $this->assertEquals($matrix, $matrix2);
        $this->assertEquals(new Matrix33(
            0,0,1,
            0,1,0,
            -1,0,0
        ), $matrix);
    }

    public function testRotationZ() {
        $matrix  = MatrixMath::makeRotationZ(90);
        $matrix2 = MatrixMath::makeRotationZ(90 * (pi() / 180), Math::RADIANS);

        $this->assertEquals($matrix, $matrix2);
        $this->assertEquals(new Matrix33(
            0,-1,0,
            1,0,0,
            0,0,1
        ), $matrix);
    }


    public function testSetRotationX() {
        $matrix  = new Matrix33(10, 2, -4, 91, 7, 2, 11, 41, 52);
        $matrix2 = new Matrix33(10, 2, -4, 91, 7, 2, 11, 41, 52);

        $matrix->setRotationX((90 * (pi()/180)), Math::RADIANS);
        $matrix2->roll(90);

        $this->assertEquals($matrix2, $matrix);
        $this->assertEquals(new Matrix33(
            10, -4, -2,
            91, 2, -7,
            11, 52, -41
        ), $matrix);

    }

    public function testSetRotationY() {
        $matrix  = new Matrix33(10, 2, -4, 91, 7, 2, 11, 41, 52);
        $matrix2 = new Matrix33(10, 2, -4, 91, 7, 2, 11, 41, 52);

        $matrix->setRotationY((90 * (pi()/180)), Math::RADIANS);
        $matrix2->pitch(90);

        $this->assertEquals($matrix2, $matrix);
        $this->assertEquals(new Matrix33(
            4, 2, 10,
            -2, 7, 91,
            -52, 41, 11
        ), $matrix);
    }

    public function testSetRotationZ() {
        $matrix  = new Matrix33(10, 2, -4, 91, 7, 2, 11, 41, 52);
        $matrix2 = new Matrix33(10, 2, -4, 91, 7, 2, 11, 41, 52);

        $matrix->setRotationZ((90 * (pi()/180)), Math::RADIANS);
        $matrix2->yaw(90);

        $this->assertEquals($matrix2, $matrix);
        $this->assertEquals(new Matrix33(
            2, -10, -4,
            7, -91, 2,
            41, -11, 52
        ), $matrix);
    }

    public function testFromArray() {
        $matrixAsArray = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8]
        ];

        $matrix = new Matrix33();
        $matrix->fromArray($matrixAsArray);

        $this->assertEquals(new Matrix33(
            0, 1, 2,
            3, 4, 5,
            6,7,8
        ), $matrix);
    }

    public function testToArray() {
        $matrix = new Matrix33(
            0, 1, 2,
            3, 4, 5,
            6, 7, 8
        );

        $matrixAsArray = $matrix->toArray();

        $this->assertEquals(
            [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8]
            ],
            $matrixAsArray
        );
    }

}
