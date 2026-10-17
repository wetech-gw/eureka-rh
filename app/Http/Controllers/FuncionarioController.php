<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\LogsActivity;
use App\Services\SmsService;

class FuncionarioController extends Controller
{
    use LogsActivity;
    public function index()
    {
        // Procura todos os funcionários registados na base de dados
        $funcionarios = DB::table("funcionarios")
            ->orderBy("nome", "asc")
            ->get();
        return view("funcionarios", compact("funcionarios"));
    }

    public function store(Request $request)
    {
        // Validação dos campos obrigatórios do teu sistema
        $validator = Validator::make($request->all(), [
            "nome" => "required|string|max:255",
            "email" => "nullable|email|max:255",
            "nif" => "required|string|max:30",
            "cargo" => "required|string|max:100",
            // 'iniciais' => 'required|string|max:3',
            "data_inicio_contrato" => "required|date",
            "tipo_trabalhador" => "required|in:Subordinado,Supervisor,Liberal",
            "tipo_contrato" => "required|in:Contrato a termo certo,Contrato a termo incerto,Estágio Profissional,Prestação de Serviços,Permanente,Temporário",
            "salario_bruto" => "required|numeric|min:0",
        ], [
            "nome.required" => "Indique o nome completo.",
            "nif.required" => "O NIF é obrigatório.",
            "email.email" => "Indique um email válido.",
            "cargo.required" => "Indique a função / cargo.",
            "data_inicio_contrato.required" => "Indique a data de início do contrato.",
            "data_inicio_contrato.date" => "Data de início inválida.",
            "salario_bruto.required" => "Indique o salário bruto.",
            "salario_bruto.numeric" => "O salário deve ser um número.",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with("modalCadastro", true);
        }

        // Verifica se o NIF, o BI ou o email já existem na base de dados
        $duplicado = DB::table("funcionarios")
            ->where(function ($query) use ($request) {
                $query->where("nif", $request->nif);
                if ($request->filled("bi")) {
                    $query->orWhere("bi", $request->bi);
                }
                if ($request->filled("email")) {
                    $query->orWhere("email", $request->email);
                }
            })
            ->first();

        if ($duplicado) {
            if ($duplicado->nif === $request->nif) {
                $campo = "NIF";
                $campoInput = "nif";
            } elseif ($request->filled("bi") && $duplicado->bi === $request->bi) {
                $campo = "BI";
                $campoInput = "bi";
            } else {
                $campo = "email";
                $campoInput = "email";
            }

            if ($request->filled("contacto")) {
                $numero = preg_replace("/[^0-9+]/", "", $request->contacto);
                SmsService::enviar(
                    $numero,
                    "Eureka Consulting: O {$campo} indicado já se encontra registado no nosso sistema."
                );
            }

            // Erro devolvido por campo para aparecer por baixo do input (em vez do alerta fora do formulário)
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([$campoInput => "O {$campo} indicado já está registado. Enviámos um SMS a informar."])
                ->with("modalCadastro", true);
        }

        // Insere os dados exatamente de acordo com a tua nova migração
        // email é nullable: vazio => null (evita erro 1048 e duplicados de string vazia no índice unique)
        DB::table("funcionarios")->insert([
            "nome" => $request->nome,
            "email" => $request->filled("email") ? $request->email : null,
            "data_nascimento" => $request->data_nascimento,
            "contacto" => $request->contacto,
            "empresa" => $request->empresa ?? "Eureka Consulting",
            "bi" => $request->bi,
            "nif" => $request->nif,
            "cargo" => $request->cargo,
            //"iniciais" => strtoupper($request->iniciais),
            "estado" => $request->estado ?? "Activo",
            "tipo_contrato" => $request->tipo_contrato ?? "Contrato a termo certo",
            "data_inicio_contrato" => $request->data_inicio_contrato,
            "data_fim_periodo_experiencia" =>
                $request->data_fim_periodo_experiencia,
            "data_fim_contrato" => $request->data_fim_contrato,
            "data_inscricao_inss" => $request->data_inscricao_inss,
            "num_seguranca_social" => $request->num_seguranca_social,
            "num_conta_bancaria" => $request->num_conta_bancaria,
            "banco" => $request->banco,
            "tipo_trabalhador" => $request->tipo_trabalhador ?? "Subordinado",
            "salario_bruto" => $request->salario_bruto,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        $this->logActivity('create', 'Funcionário', null, 'Registou o funcionário ' . $request->nome);

        return redirect()
            ->route("funcionarios.index")
            ->with("success", "Funcionário registado com sucesso!");
    }

    public function update(Request $request, int $funcionario)
    {
        $validator = Validator::make($request->all(), [
            "nome" => "required|string|max:255",
            "email" => [
                "nullable",
                "email",
                "max:255",
                Rule::unique("funcionarios", "email")->ignore($funcionario),
            ],
            "data_nascimento" => "nullable|date",
            "contacto" => "nullable|string|max:20",
            "empresa" => "nullable|string|max:255",
            "bi" => "nullable|string|max:30",
            "nif" => [
                "nullable",
                "string",
                "max:30",
                Rule::unique("funcionarios", "nif")->ignore($funcionario),
            ],
            "cargo" => "required|string|max:100",
            //"iniciais" => "required|string|max:3",
            "tipo_contrato" => "required|in:Contrato a termo certo,Contrato a termo incerto,Estágio Profissional,Prestação de Serviços,Permanente,Temporário",
            "data_inicio_contrato" => "required|date",
            "data_fim_periodo_experiencia" => "nullable|date",
            "data_fim_contrato" => "nullable|date",
            "data_inscricao_inss" => "nullable|date",
            "num_seguranca_social" => "nullable|string|max:50",
            "num_conta_bancaria" => "nullable|string|max:50",
            "banco" => "nullable|string|max:100",
            "tipo_trabalhador" => "required|in:Subordinado,Supervisor,Liberal",
            "estado" => "required|in:Activo,Inactivo,Suspenso",
            "salario_bruto" => "required|numeric|min:0",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with("editId", $funcionario);
        }

        DB::table("funcionarios")
            ->where("id", $funcionario)
            ->update([
                "nome" => $request->nome,
                "email" => $request->filled("email") ? $request->email : null,
                "data_nascimento" => $request->data_nascimento,
                "contacto" => $request->contacto,
                "empresa" => $request->empresa ?? "Eureka Consulting",
                "bi" => $request->bi,
                "nif" => $request->nif,
                "cargo" => $request->cargo,
                //"iniciais" => strtoupper($request->iniciais),
                "tipo_contrato" => $request->tipo_contrato ?? "Contrato a termo certo",
                "data_inicio_contrato" => $request->data_inicio_contrato,
                "data_fim_periodo_experiencia" =>
                    $request->data_fim_periodo_experiencia,
                "data_fim_contrato" => $request->data_fim_contrato,
                "data_inscricao_inss" => $request->data_inscricao_inss,
                "num_seguranca_social" => $request->num_seguranca_social,
                "num_conta_bancaria" => $request->num_conta_bancaria,
                "banco" => $request->banco,
                "tipo_trabalhador" => $request->tipo_trabalhador,
                "estado" => $request->estado,
                "salario_bruto" => $request->salario_bruto,
                "updated_at" => now(),
            ]);

        $this->logActivity('update', 'Funcionário', $funcionario, 'Atualizou o funcionário ' . $request->nome);

        return redirect()
            ->route("funcionarios.index")
            ->with("success", "Funcionário atualizado com sucesso!");
    }
}
