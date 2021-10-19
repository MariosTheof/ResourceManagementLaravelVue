<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Snippet;

class SnippetController extends Controller
{
    public function index()
    {
        $snippets = Snippet::all()->toArray();
        return array_reverse($snippets);
    }

    public function store(Request $request)
    {
        $Snippet = new Snippet([
            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
            'snip' => $request->input('snip'),
        ]);
        $Snippet->save();

        return response()->json('Snippet created!');
    }


    public function update($id, Request $request)
    {
        $Snippet = Snippet::find($id);
        $Snippet->update($request->all());

        return response()->json('Snippet updated!');
    }

    public function destroy($id)
    {
        $Snippet = Snippet::find($id);
        $Snippet->delete();

        return response()->json('Snippet deleted!');
    }
}
