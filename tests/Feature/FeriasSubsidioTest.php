<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FeriasSubsidioTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->criarEsquemaMinimo();
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('ausencias');
        Schema::dropIfExists('folhas_salariais');
        Schema::dropIfExists('funcionarios');

        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_calcula_subsidio_quando_ferias_sao_aprovadas(): void
    {
        Carbon::setTestNow('2026-07-28');
        $funcionarioId = $this->criarFuncionario();
        $this->criarFolhaSalarial($funcionarioId, 250000);

        $response = $this
            ->from('/ferias-ausencias')
            ->post('/ferias-ausencias', [
                'funcionario_id' => $funcionarioId,
                'tipo' => 'Férias anuais',
                'estado_pedido' => 'Aprovado',
                'data_inicio' => '2026-07-01',
                'data_fim' => '2026-07-10',
                'valor_total_subsidio' => 500000,
                'valor_subsidio_ferias' => 200000,
                'estado_pagamento_subsidio' => 'Pago',
            ]);

        $response
            ->assertRedirect('/ferias-ausencias')
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('ausencias', [
            'funcionario_id' => $funcionarioId,
            'tipo' => 'Férias anuais',
            'estado_pedido' => 'Aprovado',
            'direito_subsidio_ferias' => true,
            'valor_subsidio_ferias' => 200000,
            'valor_total_subsidio' => 500000,
            'saldo_subsidio' => 300000,
            'estado_pagamento_subsidio' => 'Pago',
        ]);
    }

    public function test_bloqueia_valor_superior_ao_subsidio_disponivel(): void
    {
        Carbon::setTestNow('2026-07-28');
        $funcionarioId = $this->criarFuncionario();
        $this->criarFolhaSalarial($funcionarioId, 250000);

        $response = $this
            ->from('/ferias-ausencias')
            ->post('/ferias-ausencias', [
                'funcionario_id' => $funcionarioId,
                'tipo' => 'Férias anuais',
                'estado_pedido' => 'Aprovado',
                'data_inicio' => '2026-07-01',
                'data_fim' => '2026-07-10',
                'valor_total_subsidio' => 500000,
                'valor_subsidio_ferias' => 600000,
                'estado_pagamento_subsidio' => 'Pago',
            ]);

        $response
            ->assertRedirect('/ferias-ausencias')
            ->assertSessionHasErrors('valor_subsidio_ferias');

        $this->assertDatabaseMissing('ausencias', [
            'funcionario_id' => $funcionarioId,
            'estado_pedido' => 'Aprovado',
        ]);
    }

    public function test_bloqueia_valor_negativo(): void
    {
        Carbon::setTestNow('2026-07-28');
        $funcionarioId = $this->criarFuncionario();
        $this->criarFolhaSalarial($funcionarioId, 250000);

        $response = $this
            ->from('/ferias-ausencias')
            ->post('/ferias-ausencias', [
                'funcionario_id' => $funcionarioId,
                'tipo' => 'Férias anuais',
                'estado_pedido' => 'Aprovado',
                'data_inicio' => '2026-07-01',
                'data_fim' => '2026-07-10',
                'valor_total_subsidio' => 500000,
                'valor_subsidio_ferias' => -1,
                'estado_pagamento_subsidio' => 'Pago',
            ]);

        $response
            ->assertRedirect('/ferias-ausencias')
            ->assertSessionHasErrors('valor_subsidio_ferias');

        $this->assertDatabaseMissing('ausencias', [
            'funcionario_id' => $funcionarioId,
            'estado_pedido' => 'Aprovado',
        ]);
    }

    public function test_bloqueia_pagamento_sem_saldo_disponivel(): void
    {
        Carbon::setTestNow('2026-07-28');
        $funcionarioId = $this->criarFuncionario(0);

        $response = $this
            ->from('/ferias-ausencias')
            ->post('/ferias-ausencias', [
                'funcionario_id' => $funcionarioId,
                'tipo' => 'Férias anuais',
                'estado_pedido' => 'Aprovado',
                'data_inicio' => '2026-07-01',
                'data_fim' => '2026-07-10',
                'valor_subsidio_ferias' => 0,
                'estado_pagamento_subsidio' => 'Pago',
            ]);

        $response
            ->assertRedirect('/ferias-ausencias')
            ->assertSessionHasErrors('valor_subsidio_ferias');

        $this->assertDatabaseMissing('ausencias', [
            'funcionario_id' => $funcionarioId,
            'estado_pedido' => 'Aprovado',
        ]);
    }

    private function criarFuncionario(float $salarioBruto = 300000): int
    {
        return (int) DB::table('funcionarios')->insertGetId([
            'nome' => 'Ana Silva',
            'email' => 'ana.silva@example.test',
            'cargo' => 'Consultora',
            'estado' => 'Activo',
            'data_inicio_contrato' => '2025-01-01',
            'salario_bruto' => $salarioBruto,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    private function criarFolhaSalarial(int $funcionarioId, float $salarioLiquido): void
    {
        DB::table('folhas_salariais')->insert([
            'funcionario_id' => $funcionarioId,
            'mes' => 6,
            'ano' => 2026,
            'salario_bruto' => 300000,
            'salario_liquido' => $salarioLiquido,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    private function criarEsquemaMinimo(): void
    {
        Schema::dropIfExists('ausencias');
        Schema::dropIfExists('folhas_salariais');
        Schema::dropIfExists('funcionarios');

        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('cargo');
            $table->string('estado')->default('Activo');
            $table->date('data_inicio_contrato');
            $table->decimal('salario_bruto', 12, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('folhas_salariais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcionario_id');
            $table->integer('mes');
            $table->integer('ano');
            $table->decimal('salario_bruto', 12, 2);
            $table->decimal('salario_liquido', 12, 2);
            $table->timestamps();
        });

        Schema::create('ausencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcionario_id');
            $table->string('tipo');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('dias');
            $table->string('estado_pedido')->default('Pendente');
            $table->boolean('direito_subsidio_ferias')->default(false);
            $table->decimal('valor_subsidio_ferias', 12, 2)->default(0);
            $table->decimal('valor_total_subsidio', 12, 2)->default(0);
            $table->decimal('saldo_subsidio', 12, 2)->default(0);
            $table->string('estado_pagamento_subsidio', 30)->default('Não aplicável');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }
}
