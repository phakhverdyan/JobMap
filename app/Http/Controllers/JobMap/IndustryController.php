<?php

namespace App\Http\Controllers\JobMap;

use App\Http\Controllers\Controller;
use App\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class IndustryController extends Controller
{
    public function index($letter = null)
    {
        $items = Industry::query()
            ->orderBy('name', 'asc')
            ->where('parent_id', '=', null)
            ->get()->all();
        if (App::isLocale('fr')) {
            foreach ($items as $key=>$item) {
                $items[$key]->name = $item->name_fr;
            }
        }
        $items = collect($items)->sortBy('name')->toArray();
        
        $newData = array();
        $def = '';
        foreach ($items as $item) {
            $l = strtoupper(substr($item['name'], 0, 1));
            if ($l != $def) {
                $newData[] = $l;
                $def = $l;
            }
        }
        
        if ($letter) {
            $itemsByLetter = Industry::query()
                ->where('parent_id', '=', null)
                ->where('name', 'like', $letter . '%')
                ->get()->all();
            if (App::isLocale('fr')) {
                foreach ($itemsByLetter as $key=>$item) {
                    $itemsByLetter[$key]->name = $item->name_fr;
                }
            }
            $itemsByLetter = collect($itemsByLetter)->sortBy('name')->toArray();
            
            return view('common.jobmap.explore_industries_in_letter', [
                'letters' => $newData,
                'current' => $letter,
                'itemsByLetter' => $itemsByLetter
            ]);
        } else {
            $itemsAll = Industry::query()
                ->where('parent_id', '=', null)
                ->orderBy('created_at', 'desc')
                ->paginate(60);
            if (App::isLocale('fr')) {
                foreach ($itemsAll as $key=>$item) {
                    $itemsAll[$key]->name = $item->name_fr;
                }
            }
            //$itemsAll = collect($itemsAll)->sortBy('name')->toArray();

            return view('common.jobmap.explore_industries', [
                'letters' => $newData,
                'all' => $itemsAll
            ]);
        }
    }
}
