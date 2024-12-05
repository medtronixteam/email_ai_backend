<?php

namespace App\Http\Controllers;

use App\Models\TemplateContent;
use Illuminate\Http\Request;
use Validator;
use App\Models\Templet;
use Illuminate\Support\Str;

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
    public function content(Request $request)
    {
   
        $validator = Validator::make($request->all(), [
            'contents' => 'required',
            'template_id' => 'required|exists:templets,id',

        ]);
        if ($validator->fails()) {
            $messages = $validator->messages()->first();
            $response = ['message' => $messages,
                'status' => 'error', 'code' => 500];
            return response($response, $response['code']);
        }
           $contents= json_decode($request->contents,true);

          if(!is_array($contents)){
           
            $response = ['message' => "Contents is not a valid array",
            'status' => 'error', 'code' => 500];
            return response($response, $response['code']);

          }
          $token=Str::random(30);
          TemplateContent::updateOrCreate([
            'template_id'   => $request->template_id,
            'user_id'   => auth('sanctum')->id(),
            ],[
                'contents' =>$request->contents,
                'token' =>$token,
            ]);
          $template=Templet::find($request->template_id);
       
          $other=str_replace(array_keys($contents),array_values($contents), $template->description);
        $response = [
            'message'=>"Template Updated  Successfully.",
            'template'=>$other,
            'token'=>$token,
            'status'=>'success',
            'code'=>200,

        ];
    
    return response($response, $response['code']);
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
            'image' => 'required|image',
        ]);
        $templet->name = $request->name;
        $templet->content_number = $request->content_number;
        $templet->description = $request->description;
    
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('templets', 'public');
            $templet->image = $imagePath;
        }
    
        $templet->save();
    
        return redirect()->route('admin.users.templets', $templet->id)->with('success', 'Template updated successfully!');
    }
        public function delete($templateId)
        {
            $templet = Templet::findOrFail($templateId);
            $templet->delete();
            return redirect()->route('admin.users.templets')->with('success', 'Template deleted successfully!');
        }
}
