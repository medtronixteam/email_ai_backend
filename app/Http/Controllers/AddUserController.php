<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Contact;
use App\Models\AddUser;
use Faker\Guesser\Name;
use Validator;
class AddUserController extends Controller
{
    public function listUser($group)
    {
        $AddUser = Contact::where('group_id', $group)->latest()->get();
        $response = ['status' => "success", 'code' => 200, 'data' => $AddUser];
        return response($response, $response['code']);
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:groups,id',
            'type' => 'required|in:file,json',
            'file' => 'required_if:type,file|mimes:csv,txt',
            'groupUsers' => 'required_if:type,json|json',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages()->first();
            $response = [
                'message' => $messages,
                'status' => 'error',
                'code' => 500
            ];
            return response($response, $response['code']);
        }

        $emails = $nameList = [];

        if ($request->type == 'file') {
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');

                if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
                    while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                        if (filter_var($data[1], FILTER_VALIDATE_EMAIL)) {
                            $emails[] = $data[1];
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
        } else {
            $groupUsers = json_decode($request->groupUsers, true);

            if (is_null($groupUsers) || count($groupUsers) == 0) {
                return response([
                    'message' => 'There are no valid users provided.',
                    'status' => 'error',
                    'code' => 500,
                ], 500);
            }

            foreach ($groupUsers as $user) {
                if (filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                    $emails[] = $user['email'];
                    $nameList[] = $user['username'];
                }
            }
        }

        if (count($emails) == 0) {
            return response([
                'message' => 'No valid emails found.',
                'status' => 'error',
                'code' => 500,
            ], 500);
        }

        foreach ($emails as $key => $email) {
            Contact::create([
                'group_id' => $request->group_id,
                'name' => $nameList[$key],
                'email' => $email,
            ]);
        }

        $response = [
            'message' => 'Users have been created successfully.',
            'status' => 'success',
            'code' => 200,
        ];

        return response($response, $response['code']);
    }

    public function delete($id)
    {
        $AddUser = Contact::findOrFail($id);
        $AddUser->delete();

        $response = [
            'message' => 'User has been deleted successfully.',
            'status' => 'success',
            'code' => 200,
        ];

        return response($response, $response['code']);
    }
}

