<?php

// Importa o controller de perfil
use App\Http\Controllers\ProfileController;

// Importa a classe de rotas do Laravel
use Illuminate\Support\Facades\Route;

// Importa o controller de clientes
use App\Http\Controllers\ClienteController;

// Importa o controller de pedidos
use App\Http\Controllers\PedidoController;

// Importa o controller de fornecedores
use App\Http\Controllers\FornecedorController;

// Importa o controller de estoques
use App\Http\Controllers\EstoqueController;


// Rota da página inicial (/)
Route::get('/', function () {
    return view('welcome'); // Mostra a página welcome
});


// Grupo de rotas que só funcionam se o usuário estiver logado
Route::middleware(['auth', 'verified'])->group(function () {

    // Rota do dashboard (painel principal)
    Route::get('/dashboard', function () {
        return view('dashboard'); // Mostra a página dashboard
    })->name('dashboard'); // Define um nome para essa rota


    Route::resource('clientes', ClienteController::class); // Cria todas as rotas de CRUD para clientes

    Route::resource('pedidos', PedidoController::class); // Cria todas as rotas de CRUD para pedidos

    Route::resource('fornecedores', FornecedorController::class); // Cria todas as rotas de CRUD para fornecedores

    Route::resource('estoques', EstoqueController::class); // Cria todas as rotas de CRUD para estoques

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Mostra a tela de editar perfil

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Atualiza o perfil
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Exclui o perfil
    
});


require __DIR__.'/auth.php'; // Carrega as rotas de login, registro e logout