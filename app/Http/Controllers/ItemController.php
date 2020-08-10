<?php

namespace App\Http\Controllers;
use App\Item;

use Illuminate\Http\Request;

class ItemController extends Controller {
    public function index() {
        $items = Item::all();
        $aItems = ['right' => [],'left' => []];
        foreach ($items as $item) {
            $aItems[$item->selected == 1 ? 'right' : 'left'][] = ['id' => $item->id, 'name' => $item->name];
        }
        return response()->json(['success' => true, 'data' => $aItems]);
    }

    public function save(Request $request) {
        $itemFound = Item::where('name', $request->item)->count();
        if ($itemFound > 0) {
            return response()->json(['success' => true, 'message' => 'Record already exists']);
        }
        $Item = Item::create(['name' => $request->item]);
        return response()->json(['success' => true, 'message' => 'Record successfully created']);
    }

    public function update(Request $request, $id) {
        $item = Item::find($id);
        $item->selected = $request->selected;
        $item->save();
        return response()->json(['success' => true, 'data' => []]);
    }
}
