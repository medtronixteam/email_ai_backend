<?php
namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Templet;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrackingController extends Controller
{
    public function track($emailId)
    {
        // Log or store the tracking information
        Log::info("Email opened. ID: " . $emailId);
        Tracking::where('email_id', $emailId)->update(['open_at' => now()]);
        // Serve a 1x1 transparent pixel
        $image = Storage::disk('local')->get('pixel.png'); // Store this image in `storage/app/pixel.png`
        return response($image)->header('Content-Type', 'image/png');
    }

    public function renderTemp(Request $request,$temId)
    {
        $tamplate=Templet::find($temId);  $contents=[];
        $title='NEWSLETTER DESIGN';
        if($request->has('contents')){
            $contents=json_decode($request->query('contents'),true)?json_decode($request->query('contents'),true):[];
        }
        return view('template.simple', compact('tamplate','contents'));
    }
}
