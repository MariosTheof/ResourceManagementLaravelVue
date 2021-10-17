<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        $Links = Link::all()->toArray();
        return array_reverse($Links);
    }

    public function store(Request $request)
    {
        $Link = new Link([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'opens_new_tab' => $request->input('opens_new_tab'),
        ]);
        $Link->save();

        return response()->json('Link created!');
    }


    public function update($id, Request $request)
    {
//        dd($request->all(), $id);
        $Link = Link::find($id);
        $Link->update($request->all());

        return response()->json('Link updated!');
    }

    public function destroy($id)
    {
        $Link = Link::find($id);
        $Link->delete();

        return response()->json('Link deleted!');
    }

}
