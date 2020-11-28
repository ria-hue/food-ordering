<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facade\Mail;
use App\Mail\order;

class foodcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food= food::latest()->pagination(10);

         return view('food.index', compact('food'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_fields = Validator::make($request->all(),[
            'name' => ['required', 'name'],
            'menu'=>['required','menu'],
            'food_category' => ['required', 'food_category'],
            'descripton'=>['required','description'],
            'the_special' => ['required', 'min: 10'],
            'prices' => ['required','min:30'],
            
        ]);

        if($validate_fields->fails()){
            return back()->withErrors($validate_fields);
        }else{
            Tasks::create([
                'name' => $request->name,
                'menu'=>$request->menu,
                'food_category' => $request->food_category,
                'description' => $request->description,
                'the_special' => $request->menu,
                'prices' => $request->prices,
            ]);
        };
    
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function show($id)
    {
        $food = food::findOrFail($id);
        return view('food.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food= food::findOrFail($id);
        return view('food.edit', compact('food'));
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
        $task = Tasks::findOrFail($id);
        $validate_fields = Validator::make($request->all(), [
            'name' => ['required', 'min: 3'],
            'menu'=>['required','min 3'],
            'food_category' => ['required', 'min: 3'],
            'description' => ['required', 'email'],
            'the_special' => ['required', 'min: 3'],
            'prices' => ['required', 'min: 30']
        ]);
        if($validate_fields->fails()){
            return back()->withErrors($validate_fields);
        }else{
            $task->update([
                'name' => $request->name,
                'menu'=>$request->menu,
                'food_category' => $request->food_category,
                'decription' => $request->description,
                'the_special' => $request->menu,
                'prices' => $request->prices,
            ]);


            Mail::send('Email.mail', $data ,function($message) use ($data){ 
                // $message->from(mununinasaria@gmail.com, 'Nasaria Mumuni');
              $message->to('mumuninasarai@gmail.com', 'Nasaria Mumuni')
              ->subject("Your food has being order successfully: ". $data['oder']);
            
            });

            Session::flash('update_success', 'Task has been updated successfully');
            return back();
    
        }

     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();
        Session::flash('delete_success', 'order has been deleted successfully');
        return back();
    }

}