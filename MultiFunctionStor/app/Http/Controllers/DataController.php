<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Data;
use Illuminate\Support\Facades\DB;
class DataController extends Controller
{
    
    public function index()
    { 
        $datas=DB::table('data')->select('*')->orderBy('id', 'desc')->paginate(500);
        
           return view('backend.data.index', compact('datas'));
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
        $input = $request->all();
        if ($file = $request->file('image')) {
            $name = 'data'.time().$file->getClientOriginalName();
            $file->move('assets/images/data/', $name);
            $input['image'] = $name;
         }
        Data::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
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
        $data = Data::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('image')) {
            $name = 'data'.time().$file->getClientOriginalName();
            $file->move('assets/images/data/', $name);
            $input['image'] = $name;
        }
        $data->update([
        'name' => $input['name'],
        'image' => $input['image'],
        'type' => $input['type'],
        
        ]);
       
        return back()->with('message', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data= Data::findOrFail($id);
        $data->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }

}