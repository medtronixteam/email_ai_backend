<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AttachmentController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file_name' => 'mimes:jpg,jpeg,png,pdf',
        ]);

        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('attachments', $fileName, 'public');

            $attachment = Attachment::create([
                'user_id' => auth('sanctum')->id(),
                'file_name' => $fileName,
            ]);


            return response()->json(['message' => 'File uploaded successfully', 'attachment' => $attachment], 200);
        }
        return response()->json(['message' => 'No file was uploaded or file upload failed'], 400);
    }


    public function list()
    {
        $attachments = Attachment::all();
        return response()->json(['attachments' => $attachments]);
    }
}
