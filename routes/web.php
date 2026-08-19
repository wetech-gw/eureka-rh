<?php

use App\Http\Controllers\MailController;
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
use App\Http\Controllers\SiteController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HeroStatController;
use App\Http\Controllers\BoostMeController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ActivityLogController;

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

Route::post('/send-email', [MailController::class, 'sendMail'])->name('send.email');

// 🆕 PÁGINAS PÚBLICAS DO SITE (Blade)
Route::get("/", [SiteController::class, "inicio"])->name("site.inicio");
Route::get("/servicos", [SiteController::class, "servicos"])->name("site.servicos");
Route::get("/recursos", [SiteController::class, "recursos"])->name("site.recursos");
Route::get("/sobre", [SiteController::class, "sobre"])->name("site.sobre");
Route::get("/noticias", [SiteController::class, "noticias"])->name("site.noticias");
Route::get("/catalogo-formacao", [SiteController::class, "catalogoFormacao"])->name("site.catalogo");
Route::get("/boost-me", [SiteController::class, "boostMe"])->name("site.boost");
Route::post("/contacto", [ContactController::class, "store"])->name("site.contacto");

// 🆕 ROTA PÚBLICA PRINCIPAL (Vagas + Formações + Candidatura)
Route::get("/vagas-formacoes", [PublicController::class, "vagasFormacoes"])->name("public.vagasFormacoes");
Route::post("/candidatar", [PublicController::class, "candidatar"])->name("public.candidatar");
Route::post("/candidatura-espontanea", [PublicController::class, "candidaturaEspontanea"])->name("public.candidatura-espontanea");

Route::get("/dashboard", [AuthController::class, "dashboard"])
    ->middleware("auth")
    ->name("dashboard");

// Rotas de gestão HR — acesso total para Responsável e Assistente; CEO apenas leitura
Route::group([], function () {

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
    Route::get("/folha-salarial", [FolhaSalarialController::class, "index"])->name(
        "folhas.index",
    );
    Route::post("/folha-salarial/gerar", [
        FolhaSalarialController::class,
        "gerarMesInteiro",
    ])->name("folhas.gerar");
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

    // Rotas de Candidaturas Espontâneas
    Route::get("/candidaturas-espontaneas", [
        \App\Http\Controllers\CandidaturaEspontaneaController::class, "index",
    ])->name("candidaturas-espontaneas.index");
    Route::put("/candidaturas-espontaneas/{id}/status", [
        \App\Http\Controllers\CandidaturaEspontaneaController::class, "alterarStatus",
    ])->name("candidaturas-espontaneas.status");
    Route::delete("/candidaturas-espontaneas/{id}", [
        \App\Http\Controllers\CandidaturaEspontaneaController::class, "destroy",
    ])->name("candidaturas-espontaneas.destroy");

    // Rota de listagem de Formações
    Route::get("/formacoes", [FormacaoController::class, "index"])->name(
        "formacoes.index",
    );
    Route::post("/formacoes/salvar", [FormacaoController::class, "store"])->name(
        "formacoes.store",
    );
    Route::patch("/formacoes/{id}/estado", [
        FormacaoController::class,
        "alterarEstado",
    ])->name("formacoes.alterarEstado");

    // Utilizadores — visualizar (acessível a todos os perfis logados)
    Route::get("/usuarios", [UsuarioController::class, "index"])->name(
        "usuarios.index",
    );

});

// Utilizadores — criar/editar (apenas Responsável; CEO e Assistente bloqueados)
Route::middleware(['readonly-ceo'])->group(function () {
    Route::post("/usuarios", [UsuarioController::class, "store"])->name(
        "usuarios.store",
    );
    Route::put("/usuarios/{id}", [UsuarioController::class, "update"])->name(
        "usuarios.update",
    );
});

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

    Route::get("/contact-messages", [ContactMessageController::class, "index"])->name(
        "contact-messages.index",
    );
    Route::post("/contact-messages/{mensagem}/ler", [ContactMessageController::class, "marcarLida"])->name(
        "contact-messages.ler",
    );
    Route::delete("/contact-messages/{mensagem}", [ContactMessageController::class, "destroy"])->name(
        "contact-messages.destroy",
    );

    // Rota de Atividade Recente
    Route::get("/atividade", [ActivityLogController::class, "index"])->name(
        "activity-logs.index",
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

// Rotas CRUD para cada secção (Gestão CMS) — apenas a Responsável pode gerir o site público
Route::middleware(['auth', 'responsavel', 'readonly-ceo'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('inicio', InicioController::class)->except(['show']);
    Route::resource('estatisticas', HeroStatController::class)->except(['show']);
    Route::resource('boost', BoostMeController::class)->except(['show']);
    Route::resource('servicos', ServiceController::class)->except(['show']);
    Route::resource('recursos', ResourceController::class)->except(['show']);
    Route::resource('sobre', AboutController::class)->except(['show']);
    Route::resource('noticias', NewsController::class)->except(['show']);
    Route::resource('contactos', ContactInfoController::class)->except(['show']);
});
