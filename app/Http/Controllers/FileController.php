<?php

namespace App\Http\Controllers;

use App\Models\PdfFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $files = PdfFile::all()->toArray();
        return array_reverse($files);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        $fileModel = new PdfFile;

        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = $request->all()['title'];
            $fileModel->file_path = '/storage/app/public/' . $filePath;
            $fileModel->save();

            return response()->json('PdfFile uploaded!');

        }
    }

    public function updateFile($id, Request $request)
    {
        $PdfFile = PdfFile::find($id);
        if ($request->all()['file_path'] != null) {
            $request->validate([
                'file_path' => 'required|mimes:pdf|max:2048'
            ]);
            $fileModel = new PdfFile;
            if($request->file()) {
                $fileName = time().'_'.$request->file_path->getClientOriginalName();
                $filePath = $request->file('file_path')->storeAs('uploads', $fileName, 'public');

                $fileModel->name = $request->all()['name'];
                $fileModel->file_path = '/storage/app/public/' . $filePath;
                if (!File::delete(base_path() . $PdfFile['file_path']) ){
                    return back()->with('error', 'failed to delete file');
                } else {
                    $PdfFile->update(
                        [
                            'name' => $fileModel->name,
                            'file_path' => $fileModel->file_path
                        ]
                    );

                    return response()->json('PdfFile edited!');
                }
            }
            return response()->json('PdfFile updated!');
        } else {
            $changes = $request->all();
            unset($changes['file_path']);
            $PdfFile->update($changes);

            return response()->json('PdfFile updated!');
        }

    }

    public function destroy($id)
    {
        $PdfFile = PdfFile::find($id);

        if (!File::delete(base_path() . $PdfFile['file_path']) ){
            return back()->with('error', 'failed to delete file');
        } else {
            $PdfFile->delete();
            return response()->json('PdfFile deleted!');
        }
    }
}
