<?php

namespace App\Http\Controllers\PCB;

use App\Http\Controllers\Controller;
use App\Http\Responses\Dashboard\DashboardResponse;
use App\Http\Responses\Dashboard\GeneralErrorResponse;
use App\Http\Responses\Dashboard\ValidationErrorResponse;
use App\Services\GerberProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class GerberController extends Controller
{
    public function uploadGerber(Request $request)
    {
        //Validate the incoming request
        $validator = Validator::make($request->all(), [
            'gerber_file' => 'required|mimes:zip,rar|max:20480', // Max size 20MB, adjust as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            // Process the Gerber file using GerberProcessor
            $filePath = $request->file('gerber_file')->storeAs('gerber_temp', $request->file('gerber_file')->getClientOriginalName(), 'public');
            return $this->downloadFile($filePath);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function downloadFile($filename)
    {
        $filePath = 'public/' . $filename;

        // Check if the file exists
        if (Storage::exists($filePath)) {
            $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

            // Determine the MIME type based on the file extension
            $mimeTypes = [
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
            ];

            $contentType = $mimeTypes[$fileExtension] ?? 'application/octet-stream';

            // Set headers for download
            $headers = [
                'Content-Type' => $contentType,
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];
            
            // Use response()->download() to trigger the file download
            return Storage::download($filePath, basename($filename), $headers);
        } else {
                // File not found, handle accordingly (redirect, show error, etc.)
                abort(404);
            }
        }
}