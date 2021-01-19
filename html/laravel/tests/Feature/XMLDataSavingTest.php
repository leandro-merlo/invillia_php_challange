<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Person;
use App\Models\ShipOrder;
use App\Services\DataSavingService;
use App\Utils\XML\XMLParser;
use App\Utils\XML\XMLReader;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Unit\XMLTest;

class XMLDataSavingTest extends TestCase
{

    use DatabaseTransactions;

    const PEOPLE_XML = 'public/people.xml';
    const SHIP_ORDERS_XML = 'public/shiporders.xml';

    private DataSavingService $service;

    public function setUp():void
    {
        parent::setUp();

        $this->service = resolve(DataSavingService::class);
    }

        /**
     * Tests the recording of a Person object in the database
     *
     * @return void
     */
    public function testPersonSaving() {
        $person = factory(Person::class, 1)->create();
        $this->assertNotNull(Person::find($person[0]->id));
    }

    /**
     * Tests the recording in the database of objects of type Person
     * that were read from the xml inserted in the system. These records
     * will be inserted through the DataSavingService service
     *
     * @return void
     */
    public function testPeopleSavingFromService()
    {
        $xml = XMLReader::read(XMLTest::PEOPLE_XML);
        $people = XMLParser::toPerson($xml);
        $this->service->savePeople($people);
        $peopleFromDatabase = Person::all();
        $this->assertCount(3, $peopleFromDatabase);
        $this->assertContainsOnlyInstancesOf(Person::class, $peopleFromDatabase);
    }

    /**
     * Tests the recording of a Shiporder object in the database
     *
     * @return void
     */
    public function testShiporderSaving()
    {
        $shiporder = factory(ShipOrder::class, 1)->create()->each(function($so){
            $so->items()->saveMany(factory(Item::class, 5)->make());
        });
        $this->assertNotNull(ShipOrder::find($shiporder[0]->id));
    }

    /**
     * Tests the recording in the database of objects of type Shiporder
     * that were read from the xml inserted in the system. These records
     * will be inserted through the DataSavingService service
     *
     * @return void
     */
    public function testShiporderSavingFromService()
    {
        /**
         * The insertion of people is done in the database before
         * due to the dependency that the Shiporder object has in
         * relation to the Person object
         */
        $xml = XMLReader::read(XMLTest::PEOPLE_XML);
        $people = XMLParser::toPerson($xml);
        $this->service->savePeople($people);


        $xml = XMLReader::read(XMLTest::SHIP_ORDERS_XML);
        $shiporders = XMLParser::toShiporder($xml);
        $this->service->saveShiporders($shiporders);
        $shipordersFromDatabase = ShipOrder::all();

        $this->assertCount(3, $shipordersFromDatabase);
        $this->assertContainsOnlyInstancesOf(ShipOrder::class, $shipordersFromDatabase);
    }
}
