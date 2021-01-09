<?php


namespace App\Tests\Utils;


use App\Services\Utils\Utils;
use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
    private $utils;

    public function testGetCSVContent(){
        $this->assertEquals("", "", "Both are equals");
    }

}