<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Templet;
class TempletController extends Controller
{
   
    public function list(){

        $templates= Templet::select('id','name','image')->get();
        $response=['status'=>"success",'code'=>200,'data'=>$templates];
        return response($response,$response['code']);
     }
   
    public function templets()
    {

        $templets = Templet::all();
        return view('admin.users.templates', compact('templets'));
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
            'content_number' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);
    
        $picturePath = null;
        if ($request->hasFile('image')) {
            $picture = $request->file('image');
            $picturePath = $picture->store('template', 'public');
        }
    
        $templets = Templet::create([
            'name' => $request->name,
            'content_number' => $request->content_number,
            'description' => $request->description,
            'image' => $picturePath,
        ]);
        return redirect()->back()->with('success', 'Template created successfully!');
    }
    
}
