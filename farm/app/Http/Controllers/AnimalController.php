<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    /**
     * Display animals with 'en vente' status.
     * Use the relation types ans races to get the name of the type and the breed.
     *
     * @return \Illuminate\Http\Response
     */

    public function user()
    {
        $animals = Animal::where('status', 'en vente')
            ->with('type')
            ->with('race')
            ->orderBy('price', 'asc') // Tri par prix croissant par défaut
            ->get();
    
        return response()->json($animals);
    }

    public function admin()
    {
        $animals = Animal::with('type')
            ->with('race')
            ->get();

        return response()->json($animals);
    }

}

