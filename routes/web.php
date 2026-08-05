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

use App\Http\Controllers\FormacaoController;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EstagiarioController;
use App\Http\Controllers\DocumentoColaboradorController;
use App\Http\Controllers\PublicController;

// 🟢 ADICIONA AS ROTAS DE RECUPERAÇÃO DE SENHA AQUI
Route::get("/forgot-password", [AuthController::class, "showForgotForm"])
    ->name("password.request")
    ->middleware("guest");

Route::post("/forgot-password", [AuthController::class, "sendResetLinkEmail"])
    ->name("password.email")
    ->middleware("guest");

Route::get("/reset-password/{token}", [AuthController::class, "showResetForm"])
    ->name("password.reset")
    ->middleware("guest");

Route::post("/reset-password", [AuthController::class, "reset"])
    ->name("password.update")
    ->middleware("guest");

use App\Http\Middleware\CheckResponsavel;

// 🆕 ROTA PÚBLICA PRINCIPAL (Vagas + Formações + Candidatura)
Route::get("/", [PublicController::class, "index"])->name("public.index");
Route::get("/vagas-formacoes", [PublicController::class, "vagasFormacoes"])->name("public.vagasFormacoes");
Route::post("/candidatar", [PublicController::class, "candidatar"])->name("public.candidatar");

Route::get("/dashboard", [AuthController::class, "dashboard"])
    ->middleware("auth") // Se tiver proteção de login
    ->name("dashboard");
// Se preferires aceder pelo link /dashboard, podes descomentar a linha abaixo:
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rotas de Funcionários
Route::get("/funcionarios", [FuncionarioController::class, "index"])->name(
    "funcionarios.index",
);
Route::post("/funcionarios", [FuncionarioController::class, "store"])->name(
    "funcionarios.store",
);
Route::put("/funcionarios/{funcionario}", [
    FuncionarioController::class,
    "update",
])->name("funcionarios.update");

// Rotas de Férias e Ausências
Route::get("/ferias-ausencias", [FeriasController::class, "index"])->name(
    "ferias.index",
);
Route::post("/ferias-ausencias", [FeriasController::class, "store"])->name(
    "ferias.store",
);
Route::put("/ferias-ausencias/{id}", [FeriasController::class, "update"])->name(
    "ferias.update",
);

// Rotas de Avaliações
Route::get("/avaliacoes", [AvaliacaoController::class, "index"])->name(
    "avaliacoes.index",
);
Route::post("/avaliacoes", [AvaliacaoController::class, "store"])->name(
    "avaliacoes.store",
);
Route::put("/avaliacoes/{id}", [AvaliacaoController::class, "update"])->name(
    "avaliacoes.update",
);

// Rota que já tens para listar as presenças

// Rotas de Presenças
Route::get("/presencas", [PresencaController::class, "index"])->name(
    "presencas.index",
);
Route::post("/presencas", [PresencaController::class, "store"])->name(
    "presencas.store",
);
Route::put("/presencas/{id}", [PresencaController::class, "update"])->name(
    "presencas.update",
);
Route::delete("/presencas/{id}", [PresencaController::class, "destroy"])->name(
    "presencas.destroy",
);

// ROTAS DA FOLHA SALARIAL (EUREKA RH)
// 1. Rota para abrir a página e listar a folha
Route::get("/folha-salarial", [FolhaSalarialController::class, "index"])->name(
    "folhas.index",
);
// 2. Rota que envia o formulário para rodar o mês inteiro (A que enviaste)
Route::post("/folha-salarial/gerar", [
    FolhaSalarialController::class,
    "gerarMesInteiro",
])->name("folhas.gerar");
// 3. Rota para o botão de alternar entre "Pendente" e "Pago"
Route::patch("/folha-salarial/{id}/status", [
    FolhaSalarialController::class,
    "alterarStatus",
])->name("folhas.status");
Route::get("/folhas-salariais/exportar", [
    FolhaSalarialController::class,
    "exportar",
])->name("folhas.exportar");

// Rotas do Recrutamento
Route::get("/recrutamento", [RecrutamentoController::class, "index"])->name(
    "recrutamento.index",
);
Route::post("/recrutamento/salvar", [
    RecrutamentoController::class,
    "store",
])->name("recrutamento.store");
Route::put("/recrutamento/{id}/alterar-estado", [
    RecrutamentoController::class,
    "alterarEstado",
])->name("recrutamento.alterarEstado");

// Rotas do Candidato
Route::get("/candidatos", [CandidatoController::class, "index"])->name(
    "candidatos.index",
);
Route::put("/candidatos/{id}/status", [
    CandidatoController::class,
    "alterarStatus",
])->name("candidatos.alterarStatus");
Route::put("/candidatos/{id}/editar", [
    CandidatoController::class,
    "update",
])->name("candidatos.update");
Route::post("/candidatos/store", [CandidatoController::class, "store"])->name(
    "candidatos.store",
);



// Rota de listagem de Formações
Route::get("/formacoes", [FormacaoController::class, "index"])->name(
    "formacoes.index",
);
// 🟢 Nova rota para processar o formulário
Route::post("/formacoes/salvar", [FormacaoController::class, "store"])->name(
    "formacoes.store",
);
// 🟢 Nova rota para atualizar o estado da formação
Route::patch("/formacoes/{id}/estado", [
    FormacaoController::class,
    "alterarEstado",
])->name("formacoes.alterarEstado");



// Rotas de Usuários
Route::get("/usuarios", [UsuarioController::class, "index"])->name(
    "usuarios.index",
);
Route::post("/usuarios", [UsuarioController::class, "store"])->name(
    "usuarios.store",
);
Route::put("/usuarios/{id}", [UsuarioController::class, "update"])->name(
    "usuarios.update",
);

// Rotas de Visitante (Login e Esqueci Senha)
// --- Áreas Restritas (Apenas para Responsável usando o apelido configurado) ---
// Rotas Protegidas: Só entra quem estiver logado
Route::middleware("auth")->group(function () {
    // Mude a rota do DashboardController para aqui dentro:
    Route::get("/dashboard", [DashboardController::class, "index"])->name(
        "dashboard",
    );

    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
    Route::get("/funcionarios", [FuncionarioController::class, "index"])->name(
        "funcionarios.index",
    );

    // --- Áreas Restritas (Apenas para Responsável) ---
    Route::middleware("responsavel")->group(function () {
        Route::get("/usuarios", [UsuarioController::class, "index"])->name(
            "usuarios.index",
        );
    });
});

// 🟢 ROTAS DE LOGIN
Route::get("/login", [AuthController::class, "showLogin"])
    ->name("login")
    ->middleware("guest");

// Processamento do formulário de login
Route::post("/login", [AuthController::class, "login"])->name("login.post");

Route::middleware(["auth"])->group(function () {
    Route::get("/documentos", [DocumentController::class, "index"])->name(
        "documentos.index",
    );
    Route::post("/documentos", [DocumentController::class, "store"])->name(
        "documentos.store",
    );

    Route::get("/documentos-colaboradores", [DocumentoColaboradorController::class, "index"])->name(
        "documentos.colaboradores.index",
    );
    Route::post("/documentos-colaboradores", [DocumentoColaboradorController::class, "store"])->name(
        "documentos.colaboradores.store",
    );

    Route::get("/estagiarios", [EstagiarioController::class, "index"])->name(
        "estagiarios.index",
    );
    Route::post("/estagiarios", [EstagiarioController::class, "store"])->name(
        "estagiarios.store",
    );
    Route::put("/estagiarios/{id}", [EstagiarioController::class, "update"])->name(
        "estagiarios.update",
    );
});

// Rota para servir arquivos do storage (cross-platform)
Route::get('/storage-file/{path}', function ($path) {
    $path = str_replace('|', '/', $path);

    $disk = \Illuminate\Support\Facades\Storage::disk('public');
    if (!$disk->exists($path)) {
        abort(404);
    }

    return response()->file($disk->path($path));
})->where('path', '.*')->name('storage.file');
