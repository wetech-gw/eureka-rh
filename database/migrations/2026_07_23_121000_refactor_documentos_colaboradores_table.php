<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('documentos_colaboradores', function (Blueprint $table) {
            if (Schema::hasColumn('documentos_colaboradores', 'tipo_documento')) {
                $table->dropColumn([
                    'tipo_documento',
                    'nome_documento',
                    'arquivo_path',
                    'numero_documento',
                    'data_emissao',
                    'data_validade',
                    'observacoes',
                ]);
            }

            $table->string('contrato_trabalho_pdf')->nullable()->after('funcionario_id');
            $table->string('cv_pdf')->nullable()->after('contrato_trabalho_pdf');
            $table->string('copia_bi_pdf')->nullable()->after('cv_pdf');
            $table->string('copia_nif_pdf')->nullable()->after('copia_bi_pdf');
            $table->string('comprovativo_bancario_pdf')->nullable()->after('copia_nif_pdf');
            $table->string('certificado_pdf')->nullable()->after('comprovativo_bancario_pdf');

            $table->unique('funcionario_id', 'documentos_colaboradores_funcionario_unique');
        });
    }

    public function down(): void
    {
        Schema::table('documentos_colaboradores', function (Blueprint $table) {
            $table->dropUnique('documentos_colaboradores_funcionario_unique');

            $table->dropColumn([
                'contrato_trabalho_pdf',
                'cv_pdf',
                'copia_bi_pdf',
                'copia_nif_pdf',
                'comprovativo_bancario_pdf',
                'certificado_pdf',
            ]);

            $table->string('tipo_documento', 100)->nullable();
            $table->string('nome_documento')->nullable();
            $table->string('arquivo_path')->nullable();
            $table->string('numero_documento', 120)->nullable();
            $table->date('data_emissao')->nullable();
            $table->date('data_validade')->nullable();
            $table->text('observacoes')->nullable();
        });
    }
};
