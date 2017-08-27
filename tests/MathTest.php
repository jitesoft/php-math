<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  MathTest.php - Part of the php-math project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Math\Tests;

use Jitesoft\Utilities\Math\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase {

    public function testDegToRad() {
        $out = Math::degToRad(1);
        $this->assertEquals(0.01745329252, $out);

        $out = Math::degToRad(180);
        $this->assertEquals(3.1415926536, $out);
    }

    public function testRadToDeg() {
        $out = Math::radToDeg(0.01745329252);
        $this->assertEquals(1, $out);

        $out = Math::radToDeg(6.283185307177647);
        $this->assertEquals(360, $out);
    }
}
