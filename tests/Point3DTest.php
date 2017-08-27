<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Point3DTest.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math\Tests;

use Jitesoft\Utilities\Math\Point3D;
use PHPUnit\Framework\TestCase;

class Point3DTest extends TestCase {

    public function testGetX() {
        $p = new Point3D(1,3, 5);
        $this->assertEquals(1, $p->getX());
    }

    public function testGetY() {
        $p = new Point3D(1, 3, 5);
        $this->assertEquals(3, $p->getY());
    }

    public function testGetZ() {
        $p = new Point3D(1, 3, 5);
        $this->assertEquals(5, $p->getZ());
    }

    public function testSetX() {
        $p = new Point3D(1, 3, 5);
        $p->setX(3);
        $this->assertEquals(3, $p->getX());
    }

    public function testSetY() {
        $p = new Point3D(1, 3, 5);
        $p->setY(1);
        $this->assertEquals(1, $p->getY());
    }

    public function testSetZ() {
        $p = new Point3D(1, 3, 5);
        $p->setZ(1);
        $this->assertEquals(1, $p->getZ());
    }

}
