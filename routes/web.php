<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\FeriasController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\FolhaSalarialController;
use App\Http\Controllers\RecrutamentoController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\FormacaoController;
use App\Http\Controllers\EstrategiaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckResponsavel;


// 🆕 ROTA DO DASHBOARD (Adicionada aqui)
// Isto vai fazer o Dashboard abrir logo na página inicial (http://127.0.0.1:8000)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Se preferires aceder pelo link /dashboard, podes descomentar a linha abaixo:
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Rotas de Funcionários
Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');
Route::post('/funcionarios', [FuncionarioController::class, 'store'])->name('funcionarios.store');
Route::put('/funcionarios/{funcionario}', [FuncionarioController::class, 'update'])->name('funcionarios.update');

// Rotas de Férias e Ausências
Route::get('/ferias-ausencias', [FeriasController::class, 'index'])->name('ferias.index');
Route::post('/ferias-ausencias', [FeriasController::class, 'store'])->name('ferias.store');
Route::put('/ferias-ausencias/{id}', [FeriasController::class, 'update'])->name('ferias.update');

// Rotas de Avaliações
Route::get('/avaliacoes', [AvaliacaoController::class, 'index'])->name('avaliacoes.index');
Route::post('/avaliacoes', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');
Route::put('/avaliacoes/{id}', [AvaliacaoController::class, 'update'])->name('avaliacoes.update');

// Rota que já tens para listar as presenças

// Rotas de Presenças
Route::get('/presencas', [PresencaController::class, 'index'])->name('presencas.index');
Route::post('/presencas', [PresencaController::class, 'store'])->name('presencas.store');
Route::put('/presencas/{id}', [PresencaController::class, 'update'])->name('presencas.update');
Route::delete('/presencas/{id}', [PresencaController::class, 'destroy'])->name('presencas.destroy');

// ROTAS DA FOLHA SALARIAL (EUREKA RH)
// 1. Rota para abrir a página e listar a folha
Route::get('/folha-salarial', [FolhaSalarialController::class, 'index'])->name('folhas.index');
// 2. Rota que envia o formulário para rodar o mês inteiro (A que enviaste)
Route::post('/folha-salarial/gerar', [FolhaSalarialController::class, 'gerarMesInteiro'])->name('folhas.gerar');
// 3. Rota para o botão de alternar entre "Pendente" e "Pago"
Route::patch('/folha-salarial/{id}/status', [FolhaSalarialController::class, 'alterarStatus'])->name('folhas.status');
Route::get('/folhas-salariais/exportar', [FolhaSalarialController::class, 'exportar'])->name('folhas.exportar');

// Rotas do Recrutamento
Route::get('/recrutamento', [RecrutamentoController::class, 'index'])->name('recrutamento.index');
Route::post('/recrutamento/salvar', [RecrutamentoController::class, 'store'])->name('recrutamento.store');
Route::put('/recrutamento/{id}/alterar-estado', [RecrutamentoController::class, 'alterarEstado'])->name('recrutamento.alterarEstado');

// Rotas do Candidato
Route::get('/candidatos', [CandidatoController::class, 'index'])->name('candidatos.index');
Route::put('/candidatos/{id}/status', [CandidatoController::class, 'alterarStatus'])->name('candidatos.alterarStatus');
Route::put('/candidatos/{id}/editar', [CandidatoController::class, 'update'])->name('candidatos.update');
Route::post('/candidatos/store', [CandidatoController::class, 'store'])->name('candidatos.store');

// Rotas do Financeiro
Route::get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro.index');
Route::post('/financeiro', [FinanceiroController::class, 'store'])->name('financeiro.store');
Route::get('/financeiro/exportar', [FinanceiroController::class, 'exportar'])->name('financeiro.exportar');


// Rota de listagem de Formações
Route::get('/formacoes', [FormacaoController::class, 'index'])->name('formacoes.index');
// 🟢 Nova rota para processar o formulário
Route::post('/formacoes/salvar', [FormacaoController::class, 'store'])->name('formacoes.store');
// 🟢 Nova rota para atualizar o estado da formação
Route::patch('/formacoes/{id}/estado', [FormacaoController::class, 'alterarEstado'])->name('formacoes.alterarEstado');


// Rotas da Página Operacional e Estratégia
Route::get('/operacional-estrategia', [EstrategiaController::class, 'index'])->name('estrategia.index');
Route::patch('/operacional-estrategia/{id}/progresso', [EstrategiaController::class, 'progresso'])->name('estrategia.progresso');
// <<< ADICIONE ESTAS DUAS LINHAS ABAIXO >>>
Route::post('/operacional-estrategia', [EstrategiaController::class, 'store'])->name('estrategia.store');
Route::put('/estrategia/{id}', [EstrategiaController::class, 'update'])->name('estrategia.update');

// Rotas de indicadores operacionais
Route::post('/operacional-estrategia/indicadores', [EstrategiaController::class, 'updateIndicadores'])->name('estrategia.indicadores.update');

// Rotas de Usuários
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');

// Rotas de Visitante (Login e Esqueci Senha)
// --- Áreas Restritas (Apenas para Responsável usando o apelido configurado) ---



// Rotas Protegidas: Só entra quem estiver logado
Route::middleware('auth')->group(function () {
    
    // Mude a rota do DashboardController para aqui dentro:
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');

    // --- Áreas Restritas (Apenas para Responsável) ---
    Route::middleware('responsavel')->group(function () {
        Route::get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro.index');
        Route::get('/operacional-estrategia', [EstrategiaController::class, 'index'])->name('estrategia.index');
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    });
});



// 🟢 GARANTE QUE ESTA LINHA TEM EXATAMENTE ->name('login')
Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');

// Processamento do formulário de login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Rotas Públicas
Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// 🟢 ADICIONA ESTA LINHA PARA ACABAR COM O ERRO:
Route::get('/forgot-password', function () { return "Ecrã de recuperação em desenvolvimento..."; })->name('password.request');