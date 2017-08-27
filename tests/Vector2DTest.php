<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector2DTest.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math\Tests;

use Exception;
use Jitesoft\Utilities\Math\Vector2D;
use Jitesoft\Utilities\Math\VectorMath;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class Vector2DTest extends TestCase {

    public function testVectorAccessGetException() {
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Out of range. Invalid offset.");
        $v = new Vector2D(1,2);
        $v["j"];
    }

    public function testGetXY() {
        $v = new Vector2D(5,15);
        $this->assertEquals(5, $v->getX());
        $this->assertEquals(15, $v->getY());
    }

    public function testSetXY() {
        $v = new Vector2D(1,10);

        $this->assertEquals(1, $v->getX());
        $this->assertEquals(10, $v->getY());

        $v->setX(10);
        $v->setY(20);

        $this->assertEquals(10, $v->getX());
        $this->assertEquals(20, $v->getY());
    }

    public function testSet() {
        $v = new Vector2D(1,10);

        $this->assertEquals(1, $v->getX());
        $this->assertEquals(10, $v->getY());

        $v->set(10, 20);

        $this->assertEquals(10, $v->getX());
        $this->assertEquals(20, $v->getY());
    }

    public function testAdd() {
        $v1 = new Vector2D(10, 20);
        $v2 = new Vector2D(20, 20);

        $result = VectorMath::add($v1, $v2);
        $v1->add($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(30, $result["x"]);
        $this->assertEquals(40, $result["y"]);
    }

    public function testAddScalar() {
        $v1  = new Vector2D(1,2);
        $val = VectorMath::add($v1, 1);
        $v1->add(1);
        $this->assertEquals($val, $v1);


        $this->assertEquals(new Vector2D(2,3), $v1);
    }

    public function testSub() {
        $v1 = new Vector2D(10, 20);
        $v2 = new Vector2D(3, 12);

        $result = VectorMath::sub($v1, $v2);
        $v1->sub($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(7, $v1->getX());
        $this->assertEquals(8, $v1->getY());
    }

    public function testSubScalar() {
        $v1  = new Vector2D(1,2);
        $val = VectorMath::sub($v1, 2);
        $v1->sub(2);

        $this->assertEquals($v1, $val);
        $this->assertEquals(new Vector2D(-1, 0), $v1);
    }

    public function testMul() {
        $v1 = new Vector2D(10, 20);
        $v2 = new Vector2D(2, 3);

        $result = VectorMath::mul($v1, $v2);
        $v1->mul($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(20, $v1->getX());
        $this->assertEquals(60, $v1->getY());
    }

    public function testDiv() {
        $v1 = new Vector2D(10, 12);
        $v2 = new Vector2D(2, 3);

        $result = VectorMath::div($v1, $v2);
        $v1->div($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(5, $v1->getX());
        $this->assertEquals(4, $v1->getY());
    }

    public function testMulF() {
        $v1     = new Vector2D(10, 1);
        $result = VectorMath::mul($v1, 5);
        $v1->mul(5);

        $this->assertEquals($result, $v1);
        $this->assertEquals(50, $v1->getX());
        $this->assertEquals(5, $v1->getY());
    }

    public function testDivF() {
        $v1     = new Vector2D(100, 10);
        $result = VectorMath::div($v1, 10);
        $v1->div(10);

        $this->assertEquals($result, $v1);
        $this->assertEquals(10, $v1->getX());
        $this->assertEquals(1, $v1->getY());
    }

    public function testLength() {
        $v1  = new Vector2D(10, 5);
        $len = $v1->length();

        $this->assertEquals(sqrt(125), $len);
    }

    public function testLength2() {
        $v   = new Vector2D(10, 5);
        $len = $v->length2();

        $this->assertEquals(125, $len);
    }

    public function testNormalize() {
        $v = new Vector2D(10, 5);
        $v->normalize();

        $this->assertEquals(1, $v->length());
        $this->assertequals(0.89, $v->getX(), "", 2);
        $this->assertEquals(0.44, $v->getY(), "", 2);
    }

    public function testNormalizeLenZero() {
        $vector1 = new Vector2D(0,0);
        $vector1->normalize();
        $this->assertEquals(new Vector2D(0,0), $vector1);
    }

    public function testDot() {
        $v1     = new Vector2D(10, 15);
        $v2     = new Vector2D(20, 25);
        $result = $v1->dot($v2);

        $this->assertEquals(575, $result);
    }

    public function testDistance() {
        $v1 = new Vector2D(10, 15);
        $v2 = new Vector2D(20, 25);

        $dist = $v1->distance($v2);

        $this->assertEquals(sqrt(200), $dist);
    }

    public function testDistanceSquared() {
        $v1 = new Vector2D(10, 15);
        $v2 = new Vector2D(20, 25);

        $dist = $v1->distance2($v2);

        $this->assertEquals(200, $dist);
    }

    public function testOffsetExists() {
        $vector = new Vector2D(1,2);

        $this->assertFalse($vector->offsetExists(2));
        $this->assertFalse($vector->offsetExists(-1));

        $this->assertTrue($vector->offsetExists(0));
        $this->assertTrue($vector->offsetExists('x'));
        $this->assertTrue($vector->offsetExists('X'));

        $this->assertTrue($vector->offsetExists(1));
        $this->assertTrue($vector->offsetExists('y'));
        $this->assertTrue($vector->offsetExists('Y'));
    }


    public function testOffsetGet() {
        $vector = new Vector2D(1,2);

        $this->assertEquals(1, $vector[0]);
        $this->assertEquals(1, $vector['x']);
        $this->assertEquals(1, $vector['X']);

        $this->assertEquals(2, $vector[1]);
        $this->assertEquals(2, $vector['y']);
        $this->assertEquals(2, $vector['Y']);
    }

    public function testOffsetSet() {
        $vector = new Vector2D(10,20);

        $vector[0] = 1;
        $this->assertEquals(1, $vector->getX());
        $vector['x'] = 10;
        $this->assertEquals(10, $vector->getX());
        $vector['X'] = 100;
        $this->assertEquals(100, $vector->getX());

        $vector[1] = 1;
        $this->assertEquals(1, $vector->getY());
        $vector['y'] = 10;
        $this->assertEquals(10, $vector->getY());
        $vector['Y'] = 100;
        $this->assertEquals(100, $vector->getY());

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid value. Value must be a number.");

        $vector['x'] = "HI!";
    }

    public function testOffsetUnset() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Invalid method.");

        (new Vector2D(1,2))->offsetUnset(1);
    }


    public function testToArray() {
        $v   = new Vector2D(1,2);
        $out = $v->toArray();

        $this->assertEquals([1,2], $out);
    }

    public function testFromArray() {
        $v = new Vector2D(0,0);
        $v->fromArray([1,2]);

        $this->assertEquals(new Vector2D(1,2), $v);
    }

}
