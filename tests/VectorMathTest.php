<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  VectorMathTest.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math\Tests;

use Jitesoft\Utilities\Math\Vector2D;
use Jitesoft\Utilities\Math\Vector3D;
use Jitesoft\Utilities\Math\Vector4D;
use Jitesoft\Utilities\Math\VectorMath;
use PHPUnit\Framework\TestCase;

class VectorMathTest extends TestCase {

    public function testMul() {
        $res = VectorMath::mul(
            new Vector2D(1, 2),
            new Vector2D(3, 4)
        );
        $this->assertEquals(new Vector2D(3,8), $res);

        $res = VectorMath::mul(
            new Vector3D(1, 2, 3),
            new Vector3D(4, 5, 6)
        );
        $this->assertEquals(new Vector3D(4, 10, 18), $res);

        $res = VectorMath::mul(
            new Vector4D(1, 2, 3, 4),
            new Vector4D(5, 6, 7, 8)
        );
        $this->assertEquals(new Vector4D(5, 12, 21, 32), $res);
    }

    public function testMulScalar() {
        $res = VectorMath::mul(
            new Vector2D(1, 2),
            5
        );
        $this->assertEquals(new Vector2D(5,10), $res);

        $res = VectorMath::mul(
            new Vector3D(1, 2, 3),
            5
        );
        $this->assertEquals(new Vector3D(5, 10, 15), $res);

        $res = VectorMath::mul(
            new Vector4D(1, 2, 3, 4),
            5
        );
        $this->assertEquals(new Vector4D(5, 10, 15, 20), $res);
    }

    public function testDiv() {
        $res = VectorMath::div(
            new Vector2D(1, 2),
            new Vector2D(3, 4)
        );
        $this->assertEquals(new Vector2D(0.3333,0.5), $res, "", 4);

        $res = VectorMath::div(
            new Vector3D(1, 2, 3),
            new Vector3D(4, 5, 6)
        );
        $this->assertEquals(new Vector3D(0.25, 0.4, 0.5), $res);

        $res = VectorMath::div(
            new Vector4D(1, 2, 3, 4),
            new Vector4D(5, 6, 7, 8)
        );
        $this->assertEquals(new Vector4D(0.2, 0.333, 0.428, 0.5), $res, "", 3);
    }

    public function testDivScalar() {
        $res = VectorMath::div(
            new Vector2D(1, 2),
            5
        );
        $this->assertEquals(new Vector2D(0.2,0.4), $res);

        $res = VectorMath::div(
            new Vector3D(1, 2, 3),
            5
        );
        $this->assertEquals(new Vector3D(0.2, 0.4, 0.6), $res);

        $res = VectorMath::div(
            new Vector4D(1, 2, 3, 4),
            5
        );
        $this->assertEquals(new Vector4D(0.2, 0.4, 0.6, 0.8), $res);
    }

    public function testAdd() {
        $res = VectorMath::add(
            new Vector2D(1, 2),
            new Vector2D(3, 4)
        );
        $this->assertEquals(new Vector2D(4,6), $res);

        $res = VectorMath::add(
            new Vector3D(1, 2, 3),
            new Vector3D(4, 5, 6)
        );
        $this->assertEquals(new Vector3D(5, 7, 9), $res);

        $res = VectorMath::add(
            new Vector4D(1, 2, 3, 4),
            new Vector4D(5, 6, 7, 8)
        );
        $this->assertEquals(new Vector4D(6, 8, 10, 12), $res);
    }

    public function testAddScalar() {
        $res = VectorMath::add(
            new Vector2D(1, 2),
            5
        );
        $this->assertEquals(new Vector2D(6,7), $res);

        $res = VectorMath::add(
            new Vector3D(1, 2, 3),
            5
        );
        $this->assertEquals(new Vector3D(6, 7, 8), $res);

        $res = VectorMath::add(
            new Vector4D(1, 2, 3, 4),
            5
        );
        $this->assertEquals(new Vector4D(6, 7, 8, 9), $res);
    }

    public function testSub() {
        $res = VectorMath::sub(
            new Vector2D(1, 2),
            new Vector2D(3, 4)
        );
        $this->assertEquals(new Vector2D(-2,-2), $res);

        $res = VectorMath::sub(
            new Vector3D(1, 2, 3),
            new Vector3D(4, 5, 6)
        );
        $this->assertEquals(new Vector3D(-3, -3, -3), $res);

        $res = VectorMath::sub(
            new Vector4D(1, 2, 3, 4),
            new Vector4D(5, 6, 7, 8)
        );
        $this->assertEquals(new Vector4D(-4, -4, -4, -4), $res);
    }

    public function testSubScalar() {
        $res = VectorMath::sub(
            new Vector2D(10, 20),
            5
        );
        $this->assertEquals(new Vector2D(5,15), $res);

        $res = VectorMath::sub(
            new Vector3D(1, 2, 3),
            5
        );
        $this->assertEquals(new Vector3D(-4, -3, -2), $res);

        $res = VectorMath::sub(
            new Vector4D(1, 2, 3, 4),
            3
        );
        $this->assertEquals(new Vector4D(-2, -1, 0, 1), $res);
    }

    public function testDot() {
        $dot = VectorMath::dot(
            new Vector2D(10, 15),
            new Vector2D(20, 25)
        );
        $this->assertEquals(575, $dot);


        $dot = VectorMath::dot(
            new Vector3D(10, 15, 20),
            new Vector3D(25, 30, 35)
        );
        $this->assertEquals(1400, $dot);


        $dot = VectorMath::dot(
            new Vector4D(10, 15, 20, 25),
            new Vector4D(30, 35, 40, 45)
        );
        $this->assertEquals(2750, $dot);

    }

    public function testCross() {
        $cross = VectorMath::cross(
            new Vector3D(10, 20, 30),
            new Vector3D(40, 50, 60)
        );
        $this->assertEquals(new Vector3D(-300, 600, -300), $cross);
    }

    public function testDistance() {
        $dist = VectorMath::distance(
            new Vector2D(1, 2),
            new Vector2D(3, 4)
        );
        $this->assertEquals(2.8282, $dist, "", 4);

        $dist = VectorMath::distance(
            new Vector3D(1, 2, 3),
            new Vector3D(4, 5, 6)
        );
        $this->assertEquals(5.1961, $dist, "", 4);
        $dist = VectorMath::distance(
            new Vector4D(1, 2, 3, 4),
            new Vector4D(5, 6, 7, 8)
        );
        $this->assertEquals(8, $dist, "", 4);
    }

    public function testDistance2() {
        $dist = VectorMath::distance(
            new Vector2D(1, 2),
            new Vector2D(3, 4)
        );
        $this->assertEquals(2.8282^2, $dist, "", 4);

        $dist = VectorMath::distance(
            new Vector3D(1, 2, 3),
            new Vector3D(4, 5, 6)
        );
        $this->assertEquals(5.1961^2, $dist, "", 4);
        $dist = VectorMath::distance(
            new Vector4D(1, 2, 3, 4),
            new Vector4D(5, 6, 7, 8)
        );
        $this->assertEquals(8^2, $dist, "", 4);
    }

}
