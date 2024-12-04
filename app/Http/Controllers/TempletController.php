<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Templet;
class TempletController extends Controller
{
   
    public function list(){

        $templates= Templet::all();
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
            'description' => 'required',
            'image' => 'required|image',
        ]);
    
        $picturePath = null;
        if ($request->hasFile('image')) {
            $picture = $request->file('image');
            $picturePath = $picture->store('storage', 'public');
        }
    
        $templets = Templet::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $picturePath,
        ]);
        return redirect()->back()->with('success', 'Template created successfully!');
    }
    
}
