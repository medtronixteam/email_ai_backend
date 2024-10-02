<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Contact;
use Validator;
class GroupController extends Controller
{
    public function list(){

       $group= Group::where('user_id', auth('sanctum')->id())->latest()->get();
       $response=['status'=>"success",'code'=>200,'data'=>$group];
       return response($response,$response['code']);
    }
    public function store(Request $request){

            $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'type'=>'required',
                    'file' => 'required_if:type,file|mimes:csv,txt',
                ]);
            if ($validator->fails()) {
                $messages = $validator->messages()->first();
                $response = ['message' => $messages,
                    'status' => 'error', 'code' => 500];

            }else{
                $emails =$nameList = [];
                if($request->type=='file'){
                    if ($request->hasFile('file') && $request->file('file')->isValid()) {

                        $file = $request->file('file');

                        if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
                            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                                if (filter_var( $data[1], FILTER_VALIDATE_EMAIL)) {
                                    $emails[] =  $data[1];
                                    $nameList[] = $data[0];
                                }
                            }
                            fclose($handle);
                        }
                    } else {
                        $response = [
                            'message' => 'Invalid file upload.',
                            'status' => 'error',
                            'code' => 500,
                        ];
                        return response($response, $response['code']);
                    }

                }else{
                    $jsonStrings = str_replace("'", '"', $request->groupUsers);
                    $groupusers=json_decode($jsonStrings,true);
                    if(count($groupusers)==0 && $groupusers==null){
                        return response([
                            'message' => 'There is no email .',
                            'status' => 'error',
                            'code' => 500,
                        ],500);
                    }
                    foreach($groupusers as $key => $value){

                        if (filter_var($value['email'], FILTER_VALIDATE_EMAIL)) {
                            $emails[] =$value['email'];
                            $nameList[] =$value['username'];
                        }

                    }

                }
                if(count($emails)==0){

                    return response([
                        'message' => 'There is no email .',
                        'status' => 'error',
                        'code' => 500,
                    ],500);
                }
            //    return response($emails, 200);

                $group= Group::create([
                    'name'=>$request->name,
                    'status'=>1,
                    'user_id'=>auth('sanctum')->id(),
                ]);
                foreach ($emails as $key => $value) {
                    Contact::create([
                        'group_id'=>$group->id,
                        'name'=>$nameList[$key],
                        'email'=>$value,
                    ]);
                }
                $group= Group::where('user_id', auth('sanctum')->id())->latest()->get();
                $response=[
                    'message'=>'Group has been created',
                    'groups'=>$group,
                    'status'=>'success',
                    'code'=>200,
                ];
            }
        return response($response, $response['code']);
    }
    public function delete($id)
    {
        $group = Group::where('id', $id)->delete();
        $response = [
            'message' => 'Group has been deleted',
            'status' => 'success',
            'code' => 200,
        ];
        return response($response, $response['code']);
    }


}
