<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Create a message.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'content' => 'required|string',
            'discussion_id' => 'required',
        ]);

        try {
            $message = new Message();
            $message->content = $request->content;
            $message->discussion_id = $request->discussion_id;
            $message->user_id = $request->auth->id;

            $message->save();

            //return successful response
            return response()->json(['message' => $message, 'status' => 'CREATED', 'status' => true], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['status' => false], 409);
        }
    }

    /**
     * Get all messages that belong to a certain discussion.
     *
     * @param  int  $id
     * @return Response
     */
    public function getMessagesByDiscussion($id)
    {
        if ($message = Message::where('discussion_id', $id)->get()) {
            return response()->json(['message' => $message, 'status' => true], 201);
        } else {
            return response()->json(['status' => false], 404);
        }
    }

    /**
     * Get a specific message.
     *
     * @param  int  $id
     * @return Response
     */
    public function get($id)
    {
        if ($message = Message::find($id)) {
            return response()->json(['message' => $message, 'status' => true], 201);
        } else {
            return response()->json(['status' => false], 404);
        }
    }

    /**
     * Update a message by id.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if ($message = Message::find($id)) {
            if ($request->auth->id == $message->user_id) {
                $message->content = $request->content;
                $message->save();
                return response()->json(['message' => $message, 'status' => true], 201);
            }
            return response()->json(['status' => false], 401);
        } else {
            return response()->json(['status' => false], 404);
        }
    }

    /**
     * Remove the message from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        if ($message = Message::find($id)) {
            if ($request->auth->id == $message->user_id) {
                $message->delete();
                return response()->json(['status' => true], 201);
            }
            return response()->json(['status' => false], 401);
        } else {
            return response()->json(['status' => false], 404);
        }
    }
}
