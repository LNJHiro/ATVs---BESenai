<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all(); // busca todos os clientes
        return view('clientes.index', compact('clientes'));
    }
}   
