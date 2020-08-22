<?php

namespace App\Http\Controllers;
use App\Item;

use Illuminate\Http\Request;
use Mockery\Exception;

class ItemController extends Controller {
    public function index() {
        try {
            $items = Item::all();
            $aItems = ['right' => [],'left' => []];
            foreach ($items as $item) {
                $aItems[$item->selected == 1 ? 'right' : 'left'][] = ['id' => $item->id, 'name' => $item->name];
            }
            return response()->json(['success' => true, 'data' => $aItems]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Unable to get items']);
        }
    }

    public function save(Request $request) {
        try {
            $itemFound = Item::where('name', $request->item)->count();
            if ($itemFound > 0) {
                return response()->json(['success' => false, 'message' => 'Record already exists']);
            }
            $Item = Item::create(['name' => $request->item]);
            return response()->json(['success' => true, 'message' => 'Record successfully created']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Unable to add this item']);
        }
    }

    public function update(Request $request, $id) {
        try {
            $item = Item::find($id);
            $item->selected = $request->selected;
            $item->save();
            return response()->json(['success' => true, 'data' => []]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Unable to move this item']);
        }
    }
}
