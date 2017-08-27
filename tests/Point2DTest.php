<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  PointTests.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\Math\Tests;

use Jitesoft\Utilities\Math\Point2D;
use PHPUnit\Framework\TestCase;

class Point2DTest extends TestCase {

    public function testGetX() {
        $p = new Point2D(1,3);
        $this->assertEquals(1, $p->getX());
    }

    public function testGetY() {
        $p = new Point2D(1, 3);
        $this->assertEquals(3, $p->getY());
    }

    public function testSetX() {
        $p = new Point2D(1,3);
        $p->setX(3);
        $this->assertEquals(3, $p->getX());
    }

    public function testSetY() {
        $p = new Point2D(1,1);
        $p->setY(1);
        $this->assertEquals(1, $p->getY());
    }
}
