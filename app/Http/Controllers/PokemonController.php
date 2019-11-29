<?php

namespace App\Http\Controllers;

use App\Pokemon;
use App\AbilityPokemon;
use App\Ability;
use Illuminate\Http\Request;

use App\Http\Requests\PokemonRequest;
use Carbon\Carbon;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $pokemons = Pokemon::paginate(4);
        $op = $request->session()->get('op');
        $result = $request->session()->get('result');
        $error = $request->session()->get('error');
        $datos = [
            'pokemons' => $pokemons
        ];
        if(isset($result)) {
            $resultado = [
                'destroy' => [
                    0 => ['danger', 'El borrado ha fallado'],
                    1 => ['success', 'El borrado ha sido un éxito']
                ],     
                'update'  => [
                    0 => ['danger', 'El editado ha fallado'],
                    1 => ['success', 'El editado ha sido un éxito']    
                ],
                'store'   => [
                    0 => ['danger', 'El guardado ha fallado'],
                    1 => ['success', 'El guardado ha sido un éxito']
                ],
            ];
            $datos += [
                'tipo'      => $resultado[$op][$result][0],
                'mensaje'   => $resultado[$op][$result][1],
            ];
        }
        return view('listaPokemon')->with($datos);
    }
    
    public function create()
    {
        $habilidades = \DB::select('SELECT id, ability FROM `ability` WHERE id NOT IN (SELECT idability FROM abilitypokemon)');
        $datos = [
            'habilidades' => $habilidades
        ];
        return view('pokemon.create')->with($datos);
    }
    
    public function store(PokemonRequest $request){
        $error = '';
        $hab =  $request->input('habilidad');
        $pdo = \DB::connection()->getPdo();
        $input = $request->validated();
        $pokemon = new Pokemon($input);
        // Primero se sube la foto
        $file = $request->file('img');
        $name= $file->getClientOriginalName();
        // $target = '../../../upload/';
        $target = 'assets/img/pokemons/';
        $file->move($target, $name);
        // Cambiamos el valor de la img para guardarlo en BD
        $pokemon->img = $name;
        try {
            $result = $pokemon->save();
            $idNewPokemon = $pdo->lastInsertId();
            \DB::insert('INSERT INTO abilitypokemon (idability, idpokemon) values (:idability, :idpokemon)', ['idability' => $hab, 'idpokemon' => $idNewPokemon]);
        } catch(\Exception $e) {
            $result = false;
            $error = 'Este pokemon ya existe.';
            return redirect(route('pokemon.create'))->withErrors($error)->withInput();
        }
        $result = true;
        
        return redirect(route('pokemon.index'))->with(['result' => $result, 'op' => 'store']);
    }

    public function show(Pokemon $pokemon)
    {
        $habilidadesPokemons = AbilityPokemon::where('idpokemon', $pokemon->id)->get();
        $resultado = [];
        foreach ($habilidadesPokemons as $habilidadPokemon) {
            $habilidades = Ability::where('id', $habilidadPokemon->idability)->get();
            foreach ($habilidades as $habilidad) {
                array_push($resultado, $habilidad->ability);
            }
        }
        $datos = [
            'pokemon' => $pokemon,
            'habilidades' => $resultado
        ];
        return view('pokemon.show')->with($datos);
    }
        
    public function edit(Pokemon $pokemon)
    {
        return view('pokemon.edit')->with(['pokemon' => $pokemon]);
    }
    
    public function update(PokemonRequest $request, Pokemon $pokemon)
    {
        $input = $request->validated();
        // Primero se sube la foto
        $file = $request->file('img');
        $name= $file->getClientOriginalName();
        // $target = '../../../upload/';
        $target = 'assets/img/pokemons/';
        $file->move($target, $name);
        // Cambiamos el valor de la img para guardarlo en BD
        $input['img'] = $name;
        try{
            $result = $pokemon->update($input);
        } catch(\Exception $e) {
            $error = 'Introduzca bien los datos';
            return redirect('pokemon/' . $pokemon->id . '/edit')->withErrors($error)->withInput();
        }
        return redirect(route('pokemon.index'))->with(['result' => $result, 'op' => 'update']);
    }

    public function destroy(Pokemon $pokemon)
    {
        try{
            $now = Carbon::now();
            $pokemon->nombre = $pokemon->nombre . '-' . $now->format('Y-m-d');
            $pokemon->update();
            $pokemon->delete();
            $result = true;
        } catch(\Exception $e) {
            $result = false;
        }
        return redirect(route('pokemon.index'))->with(['result' => $result, 'op' => 'destroy']);
    }
}