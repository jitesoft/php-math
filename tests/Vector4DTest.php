<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector4DTest.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math\Tests;

use Exception;
use InvalidArgumentException;
use Jitesoft\Utilities\Math\Vector4D;
use Jitesoft\Utilities\Math\VectorMath;
use PHPUnit\Framework\TestCase;

class Vector4DTest extends TestCase {

    public function testGet() {
        $v = new Vector4D(1,2,3,4);

        $this->assertEquals(1, $v->getX());
        $this->assertEquals(2, $v->getY());
        $this->assertEquals(3, $v->getZ());
        $this->assertEquals(4, $v->getW());
    }

    public function testSet() {
        $v = new Vector4D(5,6,7,8);

        $v->setX(1);
        $v->setY(2);
        $v->setZ(3);
        $v->setW(4);

        $this->assertEquals(1, $v->getX());
        $this->assertEquals(2, $v->getY());
        $this->assertEquals(3, $v->getZ());
        $this->assertEquals(4, $v->getW());
    }

    public function testMul() {
        $v1 = new Vector4D(1,2,3,4);
        $v2 = new Vector4D(2,3,4,5);

        $result = VectorMath::mul($v1, $v2);
        $v1->mul($v2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(2, $v1->getX());
        $this->assertEquals(6, $v1->getY());
        $this->assertEquals(12, $v1->getZ());
        $this->assertEquals(20, $v1->getW());
    }


    public function testDiv() {
        $v1 = new Vector4D(2,12,6,25);
        $v2 = new Vector4D(2,4,3,5);

        $result = VectorMath::div($v1, $v2);
        $v1->div($v2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(1, $v1->getX());
        $this->assertEquals(3, $v1->getY());
        $this->assertEquals(2, $v1->getZ());
        $this->assertEquals(5, $v1->getW());
    }

    public function testAdd() {
        $v1 = new Vector4D(1,2,3,4);
        $v2 = new Vector4D(2,3,4,5);

        $result = VectorMath::add($v1, $v2);
        $v1->add($v2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(3, $v1->getX());
        $this->assertEquals(5, $v1->getY());
        $this->assertEquals(7, $v1->getZ());
        $this->assertEquals(9, $v1->getW());
    }

    public function testAddScalar() {
        $v1  = new Vector4D(1,2,3,4);
        $val = VectorMath::add($v1, 1);
        $v1->add(1);
        $this->assertEquals($val, $v1);

        $this->assertEquals(new Vector4D(2,3,4,5), $v1);
    }

    public function testSub() {
        $v1 = new Vector4D(1,5,12,100);
        $v2 = new Vector4D(2,3,4,5);

        $result = VectorMath::sub($v1, $v2);
        $v1->sub($v2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(-1, $v1->getX());
        $this->assertEquals(2, $v1->getY());
        $this->assertEquals(8, $v1->getZ());
        $this->assertEquals(95, $v1->getW());
    }

    public function testSubScalar() {
        $v1  = new Vector4D(1,2,3,4);
        $val = VectorMath::sub($v1, 2);
        $v1->sub(2);

        $this->assertEquals($v1, $val);
        $this->assertEquals(new Vector4D(-1, 0, 1, 2), $v1);
    }

    public function testMulF() {
        $v1 = new Vector4D(1,2,3,4);

        $result = VectorMath::mul($v1, 4);
        $v1->mul(4);

        $this->assertEquals($result, $v1);
        $this->assertEquals(4, $v1->getX());
        $this->assertEquals(8, $v1->getY());
        $this->assertEquals(12, $v1->getZ());
        $this->assertEquals(16, $v1->getW());
    }


    public function testDivF() {
        $v1 = new Vector4D(1,2,3,4);

        $result = VectorMath::div($v1, 2);
        $v1->div(2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(0.5, $v1->getX(), "", 1);
        $this->assertEquals(1, $v1->getY());
        $this->assertEquals(1.5, $v1->getZ(), "", 1);
        $this->assertEquals(2, $v1->getW());

    }

    public function testDot() {
        $v1 = new Vector4D(1,2,3,4);
        $v2 = new Vector4D(10,20,30,40);

        $result1 = VectorMath::dot($v1, $v2);
        $result2 = $v1->dot($v2);

        $this->assertEquals($result1, $result2);
        $this->assertEquals(300, $result2);
    }

    public function testDistance() {
        $v1 = new Vector4D(1,2,3,4);
        $v2 = new Vector4D(10,20,30,40);

        $result1 = VectorMath::distance($v1, $v2);
        $result2 = $v1->distance($v2);

        $this->assertEquals($result1, $result2);
        $this->assertEquals(sqrt(2430), $result2);
    }

    public function testDistance2() {
        $v1 = new Vector4D(1,2,3,4);
        $v2 = new Vector4D(10,20,30,40);

        $result1 = VectorMath::distance2($v1, $v2);
        $result2 = $v1->distance2($v2);

        $this->assertEquals($result1, $result2);
        $this->assertEquals(2430, $result2);
    }

    public function testNormalize() {
        $vector = new Vector4D(10,20,30,40);
        $vector->normalize();
        $this->assertEquals(1, $vector->length());

        $this->assertEquals(0.18, $vector->getX(), "", 2);
        $this->assertEquals(0.36, $vector->getY(), "", 2);
        $this->assertEquals(0.54, $vector->getZ(), "", 2);
        $this->assertEquals(0.73, $vector->getW(), "", 2);
        
    }

    public function testLength() {
        $vector = new Vector4D(10,20,30,40);
        $this->assertEquals(sqrt(3000), $vector->length());
    }

    public function testLength2() {
        $vector = new Vector4D(10,20,30,40);
        $this->assertEquals(3000, $vector->length2());
    }

    public function testOffsetExists() {
        $vector = new Vector4D(1,2,3, 4);

        $this->assertFalse($vector->offsetExists(4));
        $this->assertFalse($vector->offsetExists(-1));

        $this->assertTrue($vector->offsetExists(0));
        $this->assertTrue($vector->offsetExists('x'));
        $this->assertTrue($vector->offsetExists('X'));

        $this->assertTrue($vector->offsetExists(1));
        $this->assertTrue($vector->offsetExists('y'));
        $this->assertTrue($vector->offsetExists('Y'));

        $this->assertTrue($vector->offsetExists(2));
        $this->assertTrue($vector->offsetExists('z'));
        $this->assertTrue($vector->offsetExists('Z'));

        $this->assertTrue($vector->offsetExists(3));
        $this->assertTrue($vector->offsetExists('w'));
        $this->assertTrue($vector->offsetExists('W'));
    }


    public function testOffsetGet() {
        $vector = new Vector4D(1,2,3, 4);

        $this->assertEquals(1, $vector[0]);
        $this->assertEquals(1, $vector['x']);
        $this->assertEquals(1, $vector['X']);

        $this->assertEquals(2, $vector[1]);
        $this->assertEquals(2, $vector['y']);
        $this->assertEquals(2, $vector['Y']);

        $this->assertEquals(3, $vector[2]);
        $this->assertEquals(3, $vector['z']);
        $this->assertEquals(3, $vector['Z']);

        $this->assertEquals(4, $vector[3]);
        $this->assertEquals(4, $vector['w']);
        $this->assertEquals(4, $vector['W']);
    }

    public function testOffsetSet() {

        $vector = new Vector4D(10,20,30, 40);

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

        $vector[2] = 1;
        $this->assertEquals(1, $vector->getZ());
        $vector['z'] = 10;
        $this->assertEquals(10, $vector->getZ());
        $vector['Z'] = 100;
        $this->assertEquals(100, $vector->getZ());

        $vector[3] = 1;
        $this->assertEquals(1, $vector->getW());
        $vector['w'] = 10;
        $this->assertEquals(10, $vector->getW());
        $vector['W'] = 100;
        $this->assertEquals(100, $vector->getW());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid value. Value must be a number.");

        $vector['x'] = "HI!";
    }

    public function testOffsetUnset() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Invalid method.");

        (new Vector4D(1,2,3,4))->offsetUnset(1);
    }


    public function testToArray() {
        $v   = new Vector4D(1,2,3, 4);
        $out = $v->toArray();

        $this->assertEquals([1,2,3, 4], $out);
    }

    public function testFromArray() {
        $v = new Vector4D(0,0,0, 0);
        $v->fromArray([1,2,3,4]);

        $this->assertEquals(new Vector4D(1,2,3, 4), $v);
    }
}
