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
        $this->assertEquals(0, count(json_decode($deliveries)->data), "Get all deliveries API");
    }

    public function testCreateDelivery(){
        $shippr = new Shippr();
        $delivery = $shippr->createDelivery(1,1,1,5);
        $this->assertEquals(true, count(json_decode($delivery)->has_return), "Get health API");
    }

    public function testGetSingleDelivery(){
        $shippr = new Shippr();
        $delivery = $shippr->getDelivery("a8-dhi");
        $this->assertEquals(true, count(json_decode($delivery)->has_return), "Get single delivery API");
    }

    public function testCancelDelivery(){
        $shippr = new Shippr();
        $delivery = $shippr->cancelDelivery("a8-dhi");
        $this->assertEquals(true, $delivery, "Canceled ! delivery API");
    }
}