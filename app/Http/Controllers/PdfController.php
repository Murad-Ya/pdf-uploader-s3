<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdfRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function make(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:pdf|max:10000'
            ]);
            $file = $request->file('file');
            $fileName = time() . $file->getClientOriginalName();
            $result = Storage::disk('s3')->put(
                $fileName,
                file_get_contents($file)
            );
            return response()->json([
                'message' => $result ?
                    Storage::disk('s3')->url($fileName) : 's3 временно недоступен'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
