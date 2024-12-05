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
    public function edit($id)
    {
        $templet = Templet::findOrFail($id);
        return view('admin.users.edittemplete', compact('templet'));
    }
    public function update(Request $request, $id)
    {
        $templet = Templet::findOrFail($id);
    
        
        $request->validate([
            'name' => 'required|string|max:255',
            'content_number' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);
    
    
        $templet->name = $request->name;
        $templet->content_number = $request->content_number;
        $templet->description = $request->description;
    
      
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('templets', 'public');
            $templet->image = $imagePath;
        }
    
       
        try {
            $templet->save();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update template: ' . $e->getMessage()]);
        }
    
       
        return redirect()
            ->route('admin.users.templets', $templet->id)
            ->with('success', 'Template updated successfully!');
    }
    
        public function delete($templateId)
        {
            $templet = Templet::findOrFail($templateId);
            $templet->delete();
            return redirect()->route('admin.users.templets')->with('success', 'Template deleted successfully!');
        }
}
