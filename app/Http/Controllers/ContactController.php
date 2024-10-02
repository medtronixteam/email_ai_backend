<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;
class ContactController extends Controller
{
    public function listContact(){

        $contact= Contact::all();
        $response=['status'=>"success",'code'=>200,'data'=>$contact];
        return response($response,$response['code']);
     }

public function createContact(Request $request){

$validator= Validator::make($request->all(), [
    'group_id'=>'required',
    'name'=>'required',
    'email'=>'required',
]);
if($validator->fails()){
$message=$validator->message()->first();
$response=[
    'message'=>$message,'status'=>'error','code'=>500
];
} else{

    Contact::create([
        'group_id'=>$request->group_id,
        'name'=>$request->name,
        'email'=>$request->email,
    ]);
    $response=[
        'message'=>'Contact has been created',
        'status'=>'success',
        'code'=>200,
    ];
}
return response($response, $response['code']);
}
         function delete($id) {
         $contact = Contact::where('id', $id)->delete();
            $response = [
            'message' => 'Contact has been deleted',
            'status' => 'success',
            'code' => 200,
        ];
        return response($response, $response['code']);
}
}
