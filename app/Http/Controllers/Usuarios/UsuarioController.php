<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUser;
use App\Models\Usuarios\Usuario;
use Maatwebsite\Excel\Facades\Excel;

class UsuarioController extends Controller
{
    public function createUser(CreateUser $request)
    {
        // La validación se maneja automáticamente por Laravel
        $userData = $request->all();

        Usuario::create($userData);

        return redirect('/')->with('success', 'Usuario registrado exitosamente.');
    }

    public function winnerUser()
    {
        // Realizar el sorteo y obtener los datos del ganador
        $ganador = Usuario::inRandomOrder()->first();

        // Retorna los datos del ganador en formato JSON
        return response()->json($ganador);
    }

    public function collection()
    {
        return Usuario::all();
    }
    
    public function exportar()
    {
        return Excel::download(new Usuario, 'datos.xlsx');
    }
    
}
