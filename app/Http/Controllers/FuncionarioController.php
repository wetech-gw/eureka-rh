<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FuncionarioController extends Controller
{
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
        $request->validate([
            "nome" => "required|string|max:255",
            "email" => "required|email|unique:funcionarios,email",
            "cargo" => "required|string|max:100",
            // 'iniciais' => 'required|string|max:3',
            "data_inicio_contrato" => "required|date",
            "salario_bruto" => "required|numeric|min:0",
        ]);

        // Insere os dados exatamente de acordo com a tua nova migração
        DB::table("funcionarios")->insert([
            "nome" => $request->nome,
            "email" => $request->email,
            "data_nascimento" => $request->data_nascimento,
            "contacto" => $request->contacto,
            "empresa" => $request->empresa ?? "Eureka Consulting",
            "bi" => $request->bi,
            "nif" => $request->nif,
            "cargo" => $request->cargo,
            //"iniciais" => strtoupper($request->iniciais),
            "estado" => $request->estado ?? "Activo",
            "tipo_contrato" => $request->tipo_contrato ?? "Permanente",
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

        return redirect()
            ->route("funcionarios.index")
            ->with("success", "Funcionário registado com sucesso!");
    }

    public function update(Request $request, int $funcionario)
    {
        $request->validate([
            "nome" => "required|string|max:255",
            "email" => [
                "required",
                "email",
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
            "tipo_contrato" => "nullable|string|max:255",
            "data_inicio_contrato" => "required|date",
            "data_fim_periodo_experiencia" => "nullable|date",
            "data_fim_contrato" => "nullable|date",
            "data_inscricao_inss" => "nullable|date",
            "num_seguranca_social" => "nullable|string|max:50",
            "num_conta_bancaria" => "nullable|string|max:50",
            "banco" => "nullable|string|max:100",
            "tipo_trabalhador" => "required|in:Subordinado,Liberal",
            "estado" => "required|in:Activo,Inactivo,Suspenso",
            "salario_bruto" => "required|numeric|min:0",
        ]);

        DB::table("funcionarios")
            ->where("id", $funcionario)
            ->update([
                "nome" => $request->nome,
                "email" => $request->email,
                "data_nascimento" => $request->data_nascimento,
                "contacto" => $request->contacto,
                "empresa" => $request->empresa ?? "Eureka Consulting",
                "bi" => $request->bi,
                "nif" => $request->nif,
                "cargo" => $request->cargo,
                //"iniciais" => strtoupper($request->iniciais),
                "tipo_contrato" => $request->tipo_contrato ?? "Permanente",
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

        return redirect()
            ->route("funcionarios.index")
            ->with("success", "Funcionário atualizado com sucesso!");
    }
}
