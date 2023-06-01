<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\ToDoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $todos = ToDoList::all();
         // On retourne les informations des utilisateurs en JSON
    return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        

        // La validation de données
        $this->validate($request, [
            'tache' => 'required|max:70',
            
            
    ]);

        // On crée un nouvel utilisateur
        $todo = ToDoList::create([
            'tache' => $request->tache,
            'etat' => 0 
            
    ]);
    return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ToDoList $todo)
    {
        //
        return response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToDoList $todo)
    {
          // La validation de données
    $this->validate($request, [
        'etat' => 'required',
        
        
    ]);

    //On modifie les informations de l'utilisateur
    $todo->update([
        'tache'=>$request->tache,
        
        "etat" => $request->etat,
    ]);

    // On retourne la réponse JSON
    //return response()->json();
    return response()->json(['status'=>$todo]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ToDoList $todo)
    {
             // On supprime l'utilisateur
    $todo->delete();

    // On retourne la réponse JSON
    return response()->json();
}
}
