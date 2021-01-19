<?php

namespace Tests\Unit;

use App\Models\Person;
use App\Models\ShipOrder;
use App\Utils\XML\XMLParser;
use App\Utils\XML\XMLReader;
use SimpleXMLElement;
use Tests\TestCase;

class XMLTest extends TestCase
{

    const PEOPLE_XML = 'public/people.xml';
    const SHIP_ORDERS_XML = 'public/shiporders.xml';


    /**
     * Checks the reading of the XML file.
     *
     * @return void
     */
    public function testReadXML()
    {
        $xml = XMLReader::read(XMLTest::PEOPLE_XML);
        $this->assertTrue($xml != FALSE && $xml instanceof SimpleXMLElement);
    }

    /**
     * Tests the type verification of the xml that was loaded in the system
     *
     * @return void
     */
    public function testCheckXML()
    {
        $xml = XMLReader::read(XMLTest::PEOPLE_XML);
        $this->assertEquals(Person::class, XMLParser::check($xml));
        $xml = XMLReader::read(XMLTest::SHIP_ORDERS_XML);
        $this->assertEquals(ShipOrder::class, XMLParser::check($xml));
    }

    /**
     * Tests if the contents of the files loaded in the system are of the correct
     * type and checks the size of the returned array (this value must be equal to three)
     *
     * @return void
     */
    public function testXMLParser()
    {
        $xml = XMLReader::read(XMLTest::PEOPLE_XML);
        $people = XMLParser::toPerson($xml);
        $this->assertContainsOnlyInstancesOf(Person::class, $people);
        $this->assertCount(3, $people);
        $xml = XMLReader::read(XMLTest::SHIP_ORDERS_XML);
        $shiporders = XMLParser::toShiporder($xml);
        $this->assertContainsOnlyInstancesOf(ShipOrder::class, $shiporders);
        $this->assertCount(3, $shiporders);
    }


}
