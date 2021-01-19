<?php

namespace App\Services;

use App\Models\ShipOrder;
use Exception;
use Illuminate\Support\Facades\DB;

class DataSavingService {

    /**
     * @param populatedData data from xml
     * Saves People to the database, based on populated data from xml
     * @return array returns an array with two positions: savedIds that contains the ids saved in
     * the database and errors, in case something went wrong with some person.
     */
    public function savePeople(array $populatedData) {
        $ids = [];
        $errors = [];
        foreach($populatedData as $p) {
            try {
                $validationData = [
                    'id' => $p->id,
                    'name' => $p->name,
                    'phones' => $p->phones,
                ];
                if ($p->validate($validationData)) {
                    $p->create($validationData);
                    $ids[] = $p->id;
                } else {
                    throw new Exception("The model failed validation");
                }
            } catch (\Exception $ex) {
                $errors[] = [
                    'id' => $p->id,
                    'error' => $ex->getMessage()
                ];
            }
        }
        return [
            'savedIds' => $ids,
            'errors' => $errors
        ];
    }

    /**
     * @param populatedData data from xml
     * Saves Shiporders to the database, based on populated data from xml
     * @return array returns an array with two positions: savedIds that contains the ids saved in
     * the database and errors, in case something went wrong with some shiporder.
     */
    public function saveShiporders(array $populatedData) {
        $ids = [];
        $errors = [];
        /**
         * @var ShipOrder $so
         */
        foreach($populatedData as $so) {
            DB::beginTransaction();
            try {
                $shipTo = $so->shipTo;
                $items = $so->items;
                $person_id = $so->person_id;
                $shipToData = [
                    'name' => $shipTo->name,
                    'address' => $shipTo->address,
                    'city' => $shipTo->city,
                    'country' => $shipTo->country,
                ];
                if (!$shipTo->validate($shipToData)) {
                    throw new Exception("Validation error on shipTo");
                }
                $shipTo = $so->shipTo()->create($shipToData);
                $validationData = [
                    'id' => $so->id,
                    'person_id' => $so->person_id,
                    'ship_to_id' => $shipTo->id
                ];
                if (!$so->validate($validationData)) {
                    throw new Exception("Validation error on shipOrder");
                }
                unset($so->shipTo);
                unset($so->items);
                $so->ship_to_id = $shipTo->id;
                $so->person_id = $person_id;
                $so = $so->create($validationData);
                $arr_items = [];
                foreach($items as $item) {
                    $it = [
                        'title' => $item->title,
                        'note' => $item->note,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'ship_order_id' => $so->id
                    ];
                    if (!$item->validate($it)) {
                        throw new Exception("Validation error on item");
                    }
                    $arr_items[] = $it;
                }
                $so->items()->createMany($arr_items);
                $ids[] = $so->id;
                DB::commit();
            } catch (\Exception $ex) {
                $errors[] = [
                    'id' => $so->id,
                    'error' => $ex->getMessage()
                ];
                DB::rollback();
            }
        }
        return [
            'savedIds' => $ids,
            'errors' => $errors
        ];
    }
}
