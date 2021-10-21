<?php

namespace App\Http\Controllers;

use App\Models\PdfFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    public function index()
    {
        $files = PdfFile::all()->toArray();
        return array_reverse($files);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:pdf|max:2048',
                'title' => 'required'
            ]);

            $fileModel = new PdfFile;

            if($request->file()) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public_uploads');

                $fileModel->name = $request->all()['title'];
                $fileModel->file_path = '/public/' . $filePath;
                $fileModel->save();

                return response()->json('PdfFile uploaded!');

            }
        } catch (\Exception $e) {
            return response()->json('error');
        }

    }

    public function updateFile($id, Request $request)
    {
        try {
            $PdfFile = PdfFile::find($id);
            if ($request->all()['file_path'] != null) {
                $request->validate([
                    'file_path' => 'required|mimes:pdf|max:2048'
                ]);
                $fileModel = new PdfFile;
                if($request->file()) {
                    $fileName = time().'_'.$request->file_path->getClientOriginalName();
                    $filePath = $request->file('file_path')->storeAs('uploads', $fileName, 'public_uploads');

                    $fileModel->name = $request->all()['name'];
                    $fileModel->file_path =  '/public/' . $filePath;

                    if (!File::delete(base_path() .'/'. $PdfFile['file_path']) ){
                        return back()->with('error', 'failed to delete file');
                    } else {
                        dump('1231');
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
        } catch (\Exception $e) {
            return response()->json('error');
        }


    }

    public function destroy($id)
    {
        try {
            $PdfFile = PdfFile::find($id);

            if (!File::delete(base_path() . $PdfFile['file_path']) ){
                return back()->with('error', 'failed to delete file');
            } else {
                $PdfFile->delete();
                return response()->json('PdfFile deleted!');
            }
        } catch (\Exception $e) {
            return response()->json('error');
        }

    }

    public function getDownload($filename)
    {
        $file= public_path(). "/uploads/" . $filename;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $filename, $headers);
    }

}
