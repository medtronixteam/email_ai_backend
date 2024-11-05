<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'description' => 'required|max:100',

        ]);
        if ($validator->fails()) {

            $response = ['message' => $validator->messages()->first(),
                'status' => 'error', 'code' => 500];

        } else {
            $ticket = Ticket::create([
                'title' => $request->title,
                'user_id' => auth('sanctum')->id(),
            ]);
            $ticket = TicketMessage::create([
                'ticket_id' => $ticket->id,
                'description' => $request->description,
            ]);

            $response = [
                'message' => "Tick has been generated Successfully.",
                'status' => 'success',
                'code' => 200,

            ];
        }
        return response($response, $response['code']);
    }
    public function list(Request $request)
    {

        $tickets = Ticket::where('user_id', auth('sanctum')->id())->latest()->get();
        $response = [
            'data' => $tickets,
            'message' => "",
            'status' => 'success',
            'code' => 200,

        ];

        return response($response, $response['code']);
    }
    public function listById($id)
    {

        $tickets = TicketMessage::where('ticket_id', $id)->latest()->get();
        $response = [
            'data' => $tickets,
            'message' => "",
            'status' => 'success',
            'code' => 200,
        ];

        return response($response, $response['code']);
    }
}
