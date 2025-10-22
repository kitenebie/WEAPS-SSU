<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Serve private files with temporary signed URLs
     *
     * @param string $path
     * @return \Illuminate\Http\Response
     */
    public function servePrivateFile($path)
    {
        // Validate the signed URL
        if (!request()->hasValidSignature()) {
            abort(403, 'Unauthorized access to private file');
        }

        // Construct the full file path
        $filePath = storage_path('app/private/' . $path);

        // Check if file exists
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        // Return the file with appropriate headers
        return response()->file($filePath);
    }
}