<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\BoostMe;
use App\Models\ContactInfo;
use App\Models\HeroSection;
use App\Models\HeroStat;
use App\Models\News;
use App\Models\Resource;
use App\Models\Service;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        HeroSection::updateOrCreate(
            ['id' => 1],
            [
                'title'      => 'Estruturamos negócios que <span class="ink-accent">crescem</span> no terreno africano.',
                'subtitle'   => 'Consultoria empresarial · Bissau & África Ocidental',
                'image_path' => null,
            ]
        );

        $stats = [
            ['value' => '10', 'suffix' => '+', 'label' => 'anos de experiência', 'sort_order' => 1],
            ['value' => '200', 'suffix' => '+', 'label' => 'clientes acompanhados', 'sort_order' => 2],
            ['value' => '14', 'suffix' => '+', 'label' => 'serviços especializados', 'sort_order' => 3],
        ];

        foreach ($stats as $stat) {
            HeroStat::updateOrCreate(
                ['sort_order' => $stat['sort_order']],
                $stat
            );
        }

        BoostMe::updateOrCreate(
            ['id' => 1],
            [
                'eyebrow'     => 'Programa de aceleração',
                'title'       => '<span class="boost-name">BOOST_ME</span><br>Acelerador de Empresas',
                'description' => 'Um programa desenhado para apoiar empreendedores e empresas no desenvolvimento, estruturação e crescimento dos seus negócios. Da ideia à escala, acompanhamos cada etapa com mentoria, ferramentas e acesso a redes de financiamento.',
                'features'    => "Diagnóstico e estruturação do negócio\nMentoria estratégica personalizada\nPreparação para financiamento e investimento",
                'cta1'        => 'Conhecer o programa',
                'cta2'        => 'Candidatar-se',
                'cta3'        => 'Solicitar informações',
                'is_active'   => true,
            ]
        );

        $icon = [
            'compass'   => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polygon points="16 8 13.5 13.5 8 16 10.5 10.5 16 8"/></svg>',
            'chart'     => '<svg viewBox="0 0 24 24"><path d="M4 20V10M10 20V4M16 20v-7M20 20H3"/></svg>',
            'megaphone' => '<svg viewBox="0 0 24 24"><path d="M3 11v2a1 1 0 0 0 1 1h3l5 4V6L7 10H4a1 1 0 0 0-1 1Z"/><path d="M16 9a4 4 0 0 1 0 6"/></svg>',
            'coins'     => '<svg viewBox="0 0 24 24"><ellipse cx="9" cy="7" rx="6" ry="3"/><path d="M3 7v5c0 1.7 2.7 3 6 3"/><ellipse cx="15" cy="14" rx="6" ry="3"/><path d="M9 14v3c0 1.7 2.7 3 6 3s6-1.3 6-3v-6"/></svg>',
            'handshake' => '<svg viewBox="0 0 24 24"><path d="M11 17 8.5 14.5a2 2 0 0 1 0-3l3-3 4 1 4-1v7l-3 3-3-2"/><path d="M3 6v7l3 3"/><path d="M11.5 8.5 9 6H3"/></svg>',
            'research'  => '<svg viewBox="0 0 24 24"><circle cx="10" cy="10" r="6"/><path d="m20 20-5.6-5.6"/><path d="M10 7v6M7 10h6"/></svg>',
            'folder'    => '<svg viewBox="0 0 24 24"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"/></svg>',
            'target'    => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="12" r="1"/></svg>',
            'invest'    => '<svg viewBox="0 0 24 24"><path d="M3 17 9 11l4 4 8-8"/><path d="M15 7h6v6"/></svg>',
            'globe'     => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.5 2.5 15 0 18M12 3c-2.5 2.5-2.5 15 0 18"/></svg>',
            'people'    => '<svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20a6 6 0 0 1 12 0"/><path d="M16 5a3 3 0 0 1 0 6M21 20a6 6 0 0 0-4-5.6"/></svg>',
            'cap'       => '<svg viewBox="0 0 24 24"><path d="m12 4 9 4-9 4-9-4 9-4Z"/><path d="M7 10v4c0 1.5 2.2 3 5 3s5-1.5 5-3v-4"/></svg>',
            'team'      => '<svg viewBox="0 0 24 24"><circle cx="12" cy="7" r="3"/><circle cx="5" cy="11" r="2.5"/><circle cx="19" cy="11" r="2.5"/><path d="M6 20a6 6 0 0 1 12 0M2 19a4 4 0 0 1 4-3M22 19a4 4 0 0 0-4-3"/></svg>',
            'rocket'    => '<svg viewBox="0 0 24 24"><path d="M5 15c-1.5 1.5-2 5-2 5s3.5-.5 5-2"/><path d="M9 15s5-1 8-4 4-8 4-8-5 1-8 4-4 8-4 8Z"/><circle cx="14.5" cy="9.5" r="1.5"/></svg>',
        ];

        $services = [
            ['Consultoria', 'Aconselhamento estratégico transversal para decisões empresariais mais seguras.', 'compass', false],
            ['Gestão e Estratégia', 'Estruturação, planeamento e otimização de operações orientadas a resultados.', 'chart', false],
            ['Marketing e Comunicação', 'Posicionamento de marca, comunicação e captação de mercado.', 'megaphone', false],
            ['Finanças, Contabilidade, Auditoria e Fiscalidade', 'Gestão financeira, conformidade e auditoria com rigor técnico.', 'coins', false],
            ['Microfinanças', 'Soluções de inclusão financeira e apoio a instituições de microcrédito.', 'handshake', false],
            ['Estudos Socioeconómicos', 'Diagnósticos e análises de impacto baseados em dados do terreno.', 'research', false],
            ['Gestão de Projetos', 'Planeamento, execução e controlo de projetos do início ao fim.', 'folder', false],
            ['Monitorização e Avaliação', 'Medição de desempenho e avaliação de resultados de programas.', 'target', false],
            ['Financiamento e Investimento', 'Preparação de dossiês e ligação a fontes de financiamento.', 'invest', false],
            ['Tradução e Interpretação', 'Serviços linguísticos profissionais para negócios e instituições.', 'globe', false],
            ['Recursos Humanos', 'Recrutamento, gestão de talento e desenvolvimento de equipas.', 'people', false],
            ['Formações', 'Capacitação prática adaptada às necessidades de cada organização.', 'cap', false],
            ['Construção de Equipas', 'Programas de coesão e desempenho coletivo.', 'team', false],
            ['BOOST_ME — Acelerador de Empresas', 'O nosso programa de aceleração para empreendedores e empresas em crescimento.', 'rocket', true],
        ];

        foreach ($services as [$title, $description, $key, $featured]) {
            Service::updateOrCreate(
                ['title' => $title],
                ['description' => $description, 'icon' => $icon[$key], 'is_featured' => $featured]
            );
        }

        $resources = [
            ['#', null],
            ['#', null],
            ['#', null],
            ['#', null],
        ];

        foreach ($resources as $i => [$link, $logo]) {
            Resource::updateOrCreate(
                ['id' => $i + 1],
                ['logo_path' => $logo, 'link' => $link]
            );
        }

        About::updateOrCreate(
            ['id' => 1],
            [
                'title'       => 'Uma parceira que entende o contexto empresarial africano',
                'description' => 'Nascida em Bissau, a Eureka Consulting cresceu ao ritmo das empresas que acompanha. Ajudamos organizações a estruturar-se, a decidir melhor e a expandir-se com confiança por toda a África Ocidental. A nossa equipa multidisciplinar reúne especialistas em estratégia, finanças, gestão de projetos e desenvolvimento de negócios, com um compromisso comum: resultados reais e duradouros.',
                'mission'     => 'Capacitar empresas e empreendedores com soluções estratégicas que geram crescimento sustentável e impacto positivo na economia da região.',
                'vision'      => 'Ser a consultora de referência na África Ocidental, reconhecida pela proximidade, competência e resultados que transformam negócios.',
                'image_path'  => null,
            ]
        );

        ContactInfo::updateOrCreate(
            ['id' => 1],
            [
                'address'   => 'Bissau, Av. Dr. Koumba Yalá — Antula',
                'phones'    => '+245 966 164 555 · +245 956 965 050',
                'email'     => 'eureka@eurekaconsulting.com',
                'schedule'  => 'Seg – Sex · 08h00 às 17h30',
                'whatsapp'  => null,
                'linkedin'  => null,
                'facebook'  => null,
            ]
        );

        $news = [
            [
                'Economia', 'Setor privado guineense regista crescimento no primeiro trimestre',
                'Dados recentes apontam para uma recuperação sustentada nos serviços e no comércio. O setor privado da Guiné-Bissau mostra sinais claros de recuperação, com destaque para o comércio, os serviços financeiros e o turismo. A confiança dos empresários está em alta e as perspetivas para o resto do ano são animadoras.',
                '2026-05-12',
            ],
            [
                'Empreendedorismo', 'Como preparar a sua empresa para captar financiamento',
                'Um guia prático sobre os documentos e indicadores que os investidores valorizam. Da estruturação das contas à formalização da governança, explicamos os passos essenciais para tornar o seu negócio atrativo a investidores e fundos de apoio ao empreendedorismo.',
                '2026-04-28',
            ],
            [
                'BOOST_ME', 'Programa BOOST_ME abre nova vaga de candidaturas',
                'Empreendedores podem submeter os seus projetos para a próxima edição do acelerador. A nova edição do BOOST_ME vai apoiar empresas em diferentes fases de maturidade, com mentoria especializada, ligação a redes de financiamento e preparação para escalar.',
                '2026-04-05',
            ],
        ];

        foreach ($news as [$category, $title, $content, $date]) {
            News::updateOrCreate(
                ['title' => $title],
                ['category' => $category, 'content' => $content, 'image_path' => null, 'published_at' => $date]
            );
        }
    }
}
