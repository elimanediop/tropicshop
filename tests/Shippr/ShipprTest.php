<?php


namespace App\Tests\Shippr;


use App\Services\Shippr\Shippr;
use PHPUnit\Framework\TestCase;

class ShipprTest extends TestCase
{
    public function testHealth(){
        $shippr = new Shippr();
        $health = $shippr->getHealth();
        $this->assertEquals("pong", json_decode($health)->data, "Get health API");
    }

    public function testDeliveries(){
        $shippr = new Shippr();
        $deliveries = $shippr->getDeliveries(10, Shippr::CREATED);
        $this->assertEquals(0, count(json_decode($deliveries)->data), "Get health API");
    }

}