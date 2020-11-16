<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\food;

class foodcontroller extends Controller
{
    public function edit($id)
    {
        //Fetch the task id that you want to edit
        $food = food::findOrFail($id);
        return view('food.edit', compact(food));
}
}