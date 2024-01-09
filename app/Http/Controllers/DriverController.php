<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function show(Request $request)
    {
        // retornar o usuario associado ao motorista
        $user = $request->user();
        $user->load('driver');

        return $user;
    }

    public function update(Request $request)
    {
        //não funciona com o validate
//        $request->validate([
//            'year' => 'required|numeric',
//            'make' => 'required',
//            'model' => 'required',
//            'color' => 'required|alpha',
//            'license_plate' => 'required',
//            'name' => 'required'
//        ]);
//        dd('cheguei');

        $user = $request->user();

        $user->update($request->only('name'));

        // create or update a driver associated with this user
        $user->driver()->updateOrCreate($request->only([
            'year',
            'make',
            'model',
            'color',
            'license_plate'
        ]));

        $user->load('driver');


        return $user;
    }
}
