<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = todo::orderBy('task', 'asc')->get(); 
        return view('todo.app', ['data'=> $data]);
    }
    public function listTodo(){
        $data = todo::query();
        $data = $data->get();
        return response()->json($data);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request-> validate([
            'task'=>'required|min:3|max:25'
        ],[
            'task.required'=>'Isian task wajib diisi',
            'task.min'=>'Minimal diisi 3 huruf',
            'task.max'=>'Maksimal huruf yang dapat diisi adalah 25'
        ]);
        
        $data = [
            'task' => $request->input('task')
        ];
        todo::create($data);
        return redirect()->route('todo')->with('success', 'Berhasil simpan data');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request-> validate([
            'task'=>'required|min:3|max:25'
        ],[
            'task.required'=>'Isian task wajib diisi',
            'task.min'=>'Minimal diisi 3 huruf',
            'task.max'=>'Maksimal huruf yang dapat diisi adalah 25'
        ]);
    
        $data = [
            'task' => $request->input('task'),
            'is_done'=>$request->input('is_done')
        ];

        todo::where('id', $id)->update($data);
        return redirect()->route('todo')->with('success', 'Berhasil melakukan pembaruan data');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        todo::where('id', $id)->delete();
        return redirect()->route('todo')->with('success', 'Berhasil menghapus data');
    }
}
