<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $userId = $request->user()->id;
        $tasks = DB::table('tasks')->where('user_id', $userId)->get();

        return response()->json(['sucess' => 'Get tasks', 'result' => $tasks], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'body' => 'required',
            'completed' => 'required',
        ]);

        $userId = $request->user()->id;
        $task = DB::table('tasks')->insert([
            'body' => $request->body,
            'completed' => $request->completed,
            'user_id' => $userId,
        ]);
        return response()->json(['sucess' => 'Create'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //
        $userId = $request->user()->id;
        $task = DB::table('tasks')->where('id', $id)->first();

        if (!$task) {
            return response()->json(['message' => "Not Found"], 404);
        }

        if ($task->user_id != $request->user()->id) {
            return response()->json(["message" => "Forbidden"], 403);
        }

        return response()->json(['sucess' => 'Get task', 'result' => $task], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'body' => 'required',
            'completed' => 'required',
        ]);


        $task = DB::table('tasks')->where('id', $id)->first();

        if (!$task) {
            return response()->json(['message' => "Not Found"], 404);
        }

        if ($task->user_id != $request->user()->id) {
            return response()->json(["message" => "Forbidden"], 403);
        }

        $userId = $request->user()->id;
        DB::table('tasks')->where('user_id', $userId)->where('user_id', $id)->update([
            'body' => $request->body,
            'completed' => $request->completed
        ]);
        $task = DB::table('tasks')->where('user_id', $userId)->where('user_id', $id)->first();

        return response()->json(['sucess' => 'Get task', 'result' => $task], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        $task = DB::table('tasks')->where('id', $id)->first();

        if (!$task) {
            return response()->json(['message' => "Not Found"], 404);
        }

        if ($task->user_id != $request->user()->id) {
            return response()->json(["message" => "Forbidden"], 403);
        }

        $userId = $request->user()->id;
        $taskDelete = DB::table('tasks')->where('user_id', $userId)->where('user_id', $id)->delete();

        return response()->json(['sucess' => 'delete'], 204);
    }
}
