<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Link;
use PHPUnit\Exception;

class LinkController extends Controller
{
    public function index()
    {
        $Links = Link::all()->toArray();
        return array_reverse($Links);
    }

    public function store(Request $request)
    {
        try {
            $Link = new Link([
                'title' => $request->input('title'),
                'url' => $request->input('url'),
                'opens_new_tab' => $request->input('opens_new_tab'),
            ]);
            $Link->save();

            return response()->json('Link created!');
        }catch (\Exception $e) {
            return response()->json('error');
        }

    }


    public function update($id, Request $request)
    {
        try {
            $Link = Link::find($id);
            $Link->update($request->all());

            return response()->json('Link updated!');
        } catch (\Exception $e) {
            return response()->json('error');
        }
    }

    public function destroy($id)
    {
        try {
            $Link = Link::find($id);
            $Link->delete();

            return response()->json('Link deleted!');
        } catch (\Exception $e) {
            return response()->json('error');
        }
    }

}
