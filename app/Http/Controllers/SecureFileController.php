<?php

namespace App\Http\Controllers;

use App\Models\SecureFile;
use Illuminate\Http\Request;

class SecureFileController extends Controller
{
    public function download(Request $request, $token)
    {
        $file = SecureFile::query()->where('token', $token)->first();
        $filePath = storage_path('app/' . $file->file_path . $file->file_name);

        if (file_exists($filePath)) {
            return response()->download($filePath, $file->file_name);
        }

        abort(404, 'File not found');
    }
}
