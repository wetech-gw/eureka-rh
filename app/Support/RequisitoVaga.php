<?php

namespace App\Support;

use Illuminate\Support\Str;

class RequisitoVaga
{
    /**
     * Avalia se o candidato cumpre os requisitos mínimos da vaga.
     * Apenas os anos de experiência são considerados: o candidato é aceite
     * automaticamente se a sua experiência for igual ou superior ao ano
     * mínimo mencionado na descrição de requisitos da vaga.
     *
     * @param  string  $requisitos  Texto de requisitos mínimos da vaga
     * @param  array  $candidato  Dados do candidato (anos_experiencia)
     */
    public static function cumpre(string $requisitos, array $candidato): bool
    {
        $texto = Str::of($requisitos)->lower()->ascii()->trim()->toString();
        if ($texto === '') {
            return true;
        }

        $anosExigidos = static::anosExigidos($texto);
        if ($anosExigidos === null) {
            return true;
        }

        $anosCandidato = ($candidato['anos_experiencia'] ?? null);
        if ($anosCandidato === null || $anosCandidato === '') {
            return false;
        }

        return (int) $anosCandidato >= $anosExigidos;
    }

    private static function anosExigidos(string $texto): ?int
    {
        if (preg_match_all('/(\d{1,2})\s*\+?\s*anos?/i', $texto, $matches)) {
            $maximo = 0;
            foreach ($matches[1] as $valor) {
                $maximo = max($maximo, (int) $valor);
            }

            return $maximo;
        }

        return null;
    }
}
