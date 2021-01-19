<?php

namespace App\Utils\XML;

use App\Models\Item;
use App\Models\Person;
use App\Models\ShipOrder;
use App\Models\ShipTo;
use SimpleXMLElement;

class XMLParser
{

    public static function check(SimpleXMLElement $xml): ?string
    {
        if ($xml->xpath('person')) {
            return Person::class;
        } else if ($xml->xpath('shiporder')) {
            return ShipOrder::class;
        }
        return null;
    }

    public static function toPerson(SimpleXMLElement $xml): ?array
    {
        $people = array();
        foreach($xml->xpath('person') as $p)
        {
            $person = new Person();
            $person->id = $p->personid;
            $name = $p->personname->__toString();
            $person->name = $name;
            $phones = [];
            foreach($p->phones->xpath('phone') as $phone) {
                $phones[] = $phone->__toString();
            }
            $person->phones = $phones;
            array_push($people, $person);
        }
        return count($people) > 0 ? $people : null;
    }

    public static function toShiporder(SimpleXMLElement $xml): ?array
    {
        $shiporders = array();
        foreach($xml->xpath('shiporder') as $so)
        {
            $shiporder = new ShipOrder();
            $shiporder->id = $so->orderid;
            $shiporder->person_id = (int) $so->orderperson->__toString();

            $shipTo = new ShipTo();
            $shipTo->name = $so->shipto->name->__toString();
            $shipTo->address = $so->shipto->address->__toString();
            $shipTo->city = $so->shipto->city->__toString();
            $shipTo->country = $so->shipto->country->__toString();
            $shiporder->shipTo = $shipTo;

            $items = [];
            foreach($so->xpath('items') as $is) {
                foreach($is->xpath('item') as $i) {
                    $item = new Item();
                    $item->title = $i->title->__toString();
                    $item->note = $i->note->__toString();
                    $item->quantity = (int) $i->quantity->__toString();
                    $item->price = (float) $i->price->__toString();
                    $items[] = $item;
                }
            }
            $shiporder->items = $items;

            array_push($shiporders, $shiporder);
        }
        return count($shiporders) > 0 ? $shiporders : null;
    }
}
