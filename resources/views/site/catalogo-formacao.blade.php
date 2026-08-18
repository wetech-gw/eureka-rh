@extends('layouts.site')

@section('title', 'Catálogo de Formação — Eureka Consulting')

@section('content')

<!-- ===== CABEÇALHO DO CATÁLOGO ===== -->
<section class="catalog-header">
  <div class="container">
    <div class="arabic-blessing">توكلت على الله • لا حول ولا قوة إلا بالله العلي العظيم</div>
    <h1>Catálogo de Formação</h1>
    <p class="motto">Construir uma visão, uma missão e valores sólidos, promovendo simultaneamente uma cultura de trabalho positiva, diversificada, inclusiva, colaborativa e inovadora</p>
    <div class="catalog-contact-info">
      <span><i class="fa-solid fa-location-dot"></i> {{ $contact->address ?? 'Bissau, Av. Dr. Koumba Yalá - Antula' }}</span>
      <span><i class="fa-solid fa-phone"></i> {{ $contact->phones ?? '+245 966164555 / +245 956965050' }}</span>
      <span><i class="fa-solid fa-envelope"></i> <a href="mailto:{{ $contact->email ?? 'info.eurekaconsultingbiss@yahoo.com' }}">{{ $contact->email ?? 'info.eurekaconsultingbiss@yahoo.com' }}</a></span>
    </div>
  </div>
</section>

<main class="container">
  <!-- Pesquisa -->
  <div class="search-container">
    <div class="search-box">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="searchInput" placeholder="Pesquisar programa ou módulo de formação..." onkeyup="filterCatalog()">
    </div>
  </div>

  <!-- Lista de Programas -->
  <div class="catalog-sections" id="catalogSections">

    <!-- 1 -->
    <section class="course-block">
      <h2>Construção da Visão, Missão e Valores Organizacionais</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>Uma organização e o seu pessoal devem estar preparados para construir uma visão, uma missão e valores fortes, promovendo simultaneamente uma cultura de trabalho positiva, diversificada, inclusiva, colaborativa e inovadora, porque estes elementos são fundamentais para o sucesso e a resiliência a longo prazo. Uma visão e uma missão claras fornecem uma direção, alinhando todos os elementos da organização com objetivos comuns. Os valores fundamentais orientam a tomada de decisões e moldam o comportamento, assegurando a consistência das ações e dos resultados. Uma cultura positiva, diversificada e inclusiva promove a criatividade, aumenta o envolvimento dos funcionários e atrai os melhores talentos. A colaboração incentiva o trabalho em equipa e a inovação, enquanto que a inclusão cria um ambiente em que todos os empregados se sentem valorizados, o que conduz a um moral mais elevado, a um melhor desempenho e à capacidade de adaptação a mercados e desafios em mudança. Desta forma, uma cultura organizacional forte e uma visão bem definida são essenciais para manter a competitividade e alcançar um crescimento sustentável.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Desenvolvimento da visão e da missão</li>
        <li>Valores essenciais e treinamento de liderança</li>
        <li>Programas de Diversidade, Equidade e Inclusão (DEI)</li>
        <li>Desenvolvimento da colaboração e do trabalho em equipa</li>
        <li>Inovação e criatividade</li>
        <li>Envolvimento e capacitação dos funcionários</li>
        <li>Aprendizagem e desenvolvimento contínuos</li>
      </ul>
    </section>

    <!-- 2 -->
    <section class="course-block">
      <h2>Autoconsciência e Desenvolvimento Pessoal</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>As organizações devem dar prioridade ao apoio à auto-consciência e ao crescimento pessoal dos seus colaboradores, uma vez que melhora o desempenho, promove uma liderança forte, aumenta o envolvimento e melhora a comunicação. Também aumenta a adaptabilidade, promove o bem-estar mental e cultiva uma cultura positiva de melhoria contínua. O investimento no desenvolvimento pessoal dos colaboradores conduz a uma melhor tomada de decisões, a relações mais fortes, a uma maior motivação e a uma força de trabalho mais resiliente e produtiva, beneficiando tanto o indivíduo como a organização.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Desenvolvimento e domínio da inteligência emocional (QE)</li>
        <li>Mindfulness (plena atenção) e gestão do stress para profissionais</li>
        <li>Desenvolvimento de pontos fortes pessoais e exploração de valores</li>
        <li>Definição de objectivos e planeamento pessoal</li>
        <li>Definição de objectivos e responsabilização pessoal</li>
        <li>Auto-reflexão e registo no diário para o crescimento</li>
        <li>Gestão do tempo e definição de prioridades</li>
        <li>Desenvolvimento de uma mentalidade de crescimento</li>
        <li>Autocompaixão e bem-estar mental</li>
        <li>Competências de comunicação e escuta ativa</li>
        <li>Domínio do tempo e produtividade pessoal</li>
        <li>Desenvolver a autoconfiança e a assertividade</li>
        <li>Gestão do stress</li>
        <li>Relações interpessoais e comunicação</li>
        <li>Pensamento criativo e inovador</li>
        <li>Falar em público</li>
        <li>Adaptabilidade e flexibilidade</li>
        <li>Gestão de conflitos e resolução de problemas</li>
        <li>Gestão de carreiras</li>
        <li>Gestão da mudança</li>
        <li>Negociação e tomada de decisões</li>
        <li>Respeito no trabalho</li>
        <li>Aprendizagem contínua: cultivar uma cultura de desenvolvimento pessoal</li>
      </ul>
    </section>

    <!-- 3 -->
    <section class="course-block">
      <h2>Produtividade no Local de Trabalho</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>A produtividade no local de trabalho é essencial para o crescimento da empresa, o desenvolvimento dos colaboradores e o sucesso global. Uma produtividade elevada promove a saúde financeira, a vantagem competitiva e a inovação, ao mesmo tempo que beneficia os trabalhadores através do desenvolvimento de competências, do reconhecimento, da segurança no emprego e da progressão na carreira. Promove um trabalho de equipa eficiente, um ambiente de trabalho positivo e o equilíbrio entre a vida profissional e pessoal, reduzindo o stress. Funcionários produtivos aumentam a satisfação do cliente, a lealdade e a reputação da organização. Uma cultura produtiva motiva as equipes, criando um sentimento de realização e contribuindo para o sucesso a longo prazo da empresa, o que a torna crucial para o crescimento pessoal e organizacional.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Domínio da gestão do tempo</li>
        <li>Gestão da concentração e da atenção</li>
        <li>Gestão de tarefas e projectos</li>
        <li>Comunicação eficaz para aumentar a produtividade</li>
        <li>Superar o esgotamento no trabalho e gerir a energia</li>
        <li>Automatização e delegação de tarefas para aumentar a eficiência</li>
        <li>Criar hábitos para a produtividade</li>
        <li>Tirar partido da tecnologia para obter a máxima produtividade</li>
        <li>Pesquisa de informação</li>
        <li>Gestão, organização e planeamento proactivo do diário</li>
        <li>Como conduzir uma reunião eficaz</li>
        <li>A criatividade como pano de fundo para a eficácia profissional</li>
        <li>Análise e visualização de dados (PowerPoint, Excel, Word)</li>
        <li>Utilização de inteligência artificial para aumentar a produtividade</li>
      </ul>
    </section>

    <!-- 4 -->
    <section class="course-block">
      <h2>Finance - Management Control - Internal Control & Risk Management</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>Equipar o pessoal com as ferramentas certas em Finanças, Controlo de Gestão e Controlo Interno e Gestão de Riscos é vital para o sucesso organizacional. Estas ferramentas permitem uma tomada de decisões informada, uma melhor gestão do fluxo de caixa e um planeamento estratégico nas finanças; melhoram a afetação de recursos, a monitorização do desempenho e o alinhamento de objectivos no controlo de gestão; e apoiam a mitigação do risco, a conformidade regulamentar, a prevenção da fraude e a continuidade do negócio no controlo interno e na gestão do risco. Em última análise, promovem a vantagem competitiva, a confiança dos colaboradores, a estabilidade a longo prazo e a confiança das partes interessadas, assegurando operações eficientes, uma gestão eficaz do risco e o crescimento sustentável da organizção.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Análise e Relatórios Financeiros</li>
        <li>Finanças empresariais & Gestão de investimentos</li>
        <li>Gestão de riscos financeiros, Fusões e aquisições</li>
        <li>Finanças Internacionais e Contabilidade de Gestão</li>
        <li>Controlo de Gestão Estratégica & Gestão de desempenho (KPIs)</li>
        <li>Orçamentação, Previsão e Gestão de custos</li>
        <li>Gestão da mudança e controlo organizacional</li>
        <li>Avaliação e mitigação de riscos (COSO e ERM)</li>
        <li>Auditoria, conformidade, prevenção e deteção de fraudes</li>
        <li>Governação, Risco e Conformidade (GRC)</li>
      </ul>
    </section>

    <!-- 5 -->
    <section class="course-block">
      <h2>Gestão Estratégica de Recursos Humanos e Melhores Práticas</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>Equipar o pessoal com ferramentas sólidas de Gestão Estratégica de Recursos Humanos e Melhores Práticas é essencial para o sucesso organizacional. Estas ferramentas alinham as práticas de RH com a estratégia empresarial, melhoram o recrutamento, a retenção e o desenvolvimento dos empregados, promovem uma cultura positiva e melhoram a eficiência operacional. Asseguram a conformidade legal, reforçam o desempenho e a responsabilização e permitem a tomada de decisões com base em dados. As ferramentas de RH apoiam a gestão da mudança e ajudam as organizações a manterem-se ágeis e competitivas, ao mesmo tempo que medem a eficácia dos RH. Em última análise, estas ferramentas impulsionam os resultados empresariais, aumentam a satisfação dos empregados e contribuem para o crescimento a longo prazo, otimizando o capital humano, reduzindo os riscos e melhorando a produtividade.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Gestion stratégique des ressources humaines</li>
        <li>Acquisition des talents et planification des effectifs</li>
        <li>Engagement, rétention et développement du leadership</li>
        <li>Gestion des performances et alignement stratégique</li>
        <li>Stratégie en matière de rémunération et d'avantages sociaux</li>
        <li>RH et gestion interculturelle</li>
        <li>Meilleures pratiques en matière de recrutement et sélection</li>
        <li>Diversité, inclusion et relations avec les employés</li>
        <li>Technologie RH et prise de décision fondée sur les données</li>
        <li>Conformité e législation du travail</li>
        <li>Élaboration d'un système d'évaluation et Évaluation 360</li>
      </ul>
    </section>

    <!-- 6 -->
    <section class="course-block">
      <h2>Leadership / Liderança</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>Proporcionar uma formação sólida e adequada em liderança ao pessoal é essencial para qualquer organização, uma vez que melhora a tomada de decisões, a comunicação e o envolvimento dos colaboradores. Ajuda os líderes a motivar as suas equipas, a melhorar as taxas de retenção e a garantir um plano de sucessão sem problemas. A formação em liderança também ajuda na resolução de conflitos, na promoção de uma cultura organizacional positiva e no aumento da produtividade. Os líderes bem formados estão mais bem equipados para gerir a mudança, promover a inovação e melhorar as relações com os clientes. Definem expectativas claras, promovendo a responsabilização da equipa. Em última análise, a formação em liderança reforça os alicerces da organização, melhorando o desempenho e conduzindo ao sucesso a longo prazo.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Fundamentos da Liderança e Como tornar-se um líder</li>
        <li>O paradoxo da liderança e Liderança Transformacional</li>
        <li>Inteligência emocional e Comunicação na Liderança</li>
        <li>Liderança Estratégica e Liderança Servidora</li>
        <li>Gestão e resolução de conflitos</li>
        <li>Coaching e Mentoring para Líderes</li>
        <li>Liderar equipas de elevado desempenho</li>
        <li>Liderança ética e Responsabilidade Social das Empresas (RSE)</li>
        <li>Liderança em Diversidade, Inclusão e Situações de crise</li>
        <li>Liderança para a Inovação, Mudança e Transformação Digital</li>
      </ul>
    </section>

    <!-- 7 -->
    <section class="course-block">
      <h2>Management / Gestão</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>Dotar o pessoal de uma sólida formação em competências de gestão é vital para qualquer organização. Ajuda a melhorar a atribuição de recursos, a liderança de equipas, a gestão de conflitos e a resolução de problemas, conduzindo a operações otimizadas e a um melhor desempenho das equipas. Os gestores bem formados tomam decisões informadas, aumentam a produtividade e gerem a mudança de forma eficaz, garantindo que as equipas se mantêm concentradas e eficientes. Também fomentam o desenvolvimento e a retenção dos empregados, fornecendo-lhes feedback e orientação. A formação em gestão incentiva o pensamento estratégico, melhora a comunicação e apoia uma gestão eficaz do tempo e dos riscos. Além disso, promove a responsabilização, a criatividade e a inovação, melhorando, em última análise, o desempenho organizacional e contribuindo para o sucesso a longo prazo.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Princípios de gestão e Gestão Estratégica</li>
        <li>Gestão de operações, projectos e financeira</li>
        <li>Gestão de recursos humanos e de marketing</li>
        <li>Liderança e comportamento organizacional</li>
        <li>Gestão da Inovação, Empreendedorismo e Logística</li>
        <li>Ética e Responsabilidade Social das Empresas (RSE)</li>
        <li>Tomada de decisões, resolução de problemas e gestão de riscos</li>
        <li>Gestão do tempo, produtividade e partes implicadas/parceiros</li>
      </ul>
    </section>

    <!-- 8 -->
    <section class="course-block">
      <h2>Marketing and Communication</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>Pessoal com uma sólida formação em competências de marketing e comunicação é crucial para as organizações, uma vez que melhora a imagem e a consistência da marca, melhora o envolvimento dos clientes e apoia uma melhor tomada de decisões e desenvolvimento de estratégias. Conduz a um aumento da produtividade, a uma vantagem competitiva e a uma comunicação interna mais forte. O pessoal com formação está mais bem preparado para a gestão de crises, a criação eficaz de conteúdos e a maximização do ROI das campanhas de marketing. Também ajuda o pessoal a adaptar-se à transformação digital, promove a inovação, apoia o marketing direcionado e melhora os esforços de vendas. Além disso, garante uma abordagem centrada no cliente, capacita os funcionários e aumenta o moral, conduzindo, em última análise, a uma maior produtividade, satisfação do cliente e sucesso empresarial.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Marketing digital e Gestão de marcas</li>
        <li>Comportamento do consumidor e Marketing de conteúdos</li>
        <li>Relações públicas, comunicação empresarial e redes sociais</li>
        <li>Estratégia de marketing e automatização de correio eletrónico</li>
        <li>Análise de marketing e tomada de decisões com base em dados</li>
        <li>Publicidade, promoções e gestão de eventos</li>
        <li>Comunicações de marketing integradas (IMC) e Marketing de influência</li>
        <li>Alinhamento de vendas e marketing e Comunicação interna</li>
        <li>Elaboração de um plano de marketing e de negócios</li>
        <li>O produto: as etapas da criação e Fidelização de clientes</li>
        <li>Estruturar a empresa e construir uma identidade corporativa</li>
      </ul>
    </section>

    <!-- 9 -->
    <section class="course-block">
      <h2>Cadeia de Abastecimento (Supply Chain)</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>Num ambiente altamente competitivo, ter um sistema eficaz de gestão da cadeia de abastecimento é crucial para uma organização e para os seus funcionários, porque tem um impacto direto na capacidade da empresa para responder às exigências do mercado, gerir custos e fornecer produtos de forma eficiente. Uma cadeia de abastecimento otimizada ajuda a melhorar a eficiência operacional, a reduzir os prazos de entrega e a aumentar a satisfação do cliente, dando à organização uma vantagem competitiva. Os funcionários também desempenham um papel vital na execução do sistema, e a sua prontidão assegura operações sem problemas, uma rápida adaptação às mudanças e a capacidade de lidar com os desafios de forma eficaz, mantendo a empresa ágil e resiliente face à concorrência.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Introdução à Gestão da Cadeia de Abastecimento</li>
        <li>Aprovisionamento, Sourcing, Logística e Distribuição</li>
        <li>Planeamento, previsão da procura e gestão do inventário</li>
        <li>Gestão de Riscos na Cadeia de Abastecimento</li>
        <li>Tecnologia e digitalização da cadeia de abastecimento</li>
        <li>Cadeia de fornecimento enxuta e Six Sigma</li>
        <li>Sustentabilidade e Gestão da cadeia de abastecimento global</li>
        <li>Desempenho e avaliação de fornecedores</li>
        <li>Considerações éticas, legais, estratégia e conceção da cadeia</li>
      </ul>
    </section>

    <!-- 10 -->
    <section class="course-block">
      <h2>Estudos e Seguimento-Avaliação de Projetos e Programas</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>Dotar o pessoal de competências sólidas em matéria de estudos, seguimento e avaliação (M&A) é essencial para qualquer organização. Melhora a eficácia do programa, acompanhando e avaliando o progresso, garantindo que os projetos cumprem os objectivos. Os profissionais competentes em M&A permitem a tomada de decisões com base em dados, promovem a responsabilização e a transparência e asseguram uma afetação eficaz dos recursos. Melhoram o envolvimento das partes interessadas, avaliam o impacto e facilitam a aprendizagem com os êxitos e os desafios. A M&A também informa a conceção do programa, gere os riscos, assegura a conformidade com os requisitos regulamentares e apoia a aprendizagem organizacional. Além disso, aumenta a credibilidade, alinha os projectos com os objectivos de desenvolvimento sustentável (ODS) e ajuda as organizações a adaptarem-se às circunstâncias em mudança. Em última análise, fortes competências de M&A conduzem a melhores resultados do programa, melhor utilização dos recursos e sustentabilidade a longo prazo.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Introdução à Seguimento e Avaliação (M&A) e Conceção de quadros</li>
        <li>Métodos e ferramentas de recolha de dados (Quali/Quanti)</li>
        <li>Avaliação do impacto e Garantia de qualidade de dados</li>
        <li>Gestão baseada em resultados (RBM) e Ética da avaliação</li>
        <li>Análise custo-benefício e custo-eficácia</li>
        <li>Técnicas e metodologias avançadas de M&A</li>
        <li>M&A em programas de desenvolvimento internacional</li>
        <li>Relatórios, comunicação e Gestão de projectos para M&A</li>
        <li>Teoria da Mudança e Objetivos de Desenvolvimento Sustentável (SDGs)</li>
        <li>Aprendizagem e gestão adaptativa em M&A</li>
      </ul>
    </section>

    <!-- 11 -->
    <section class="course-block">
      <h2>COMPREENSÃO DOS PRODUTOS E DOS CLIENTES, CONSIDERAÇÕES ÉTICAS E JURÍDICAS, GESTÃO FINANCEIRA, OPERAÇÕES, BEM COMO GESTÃO DE RISCOS E CONFORMIDADE, ENTRE OUTROS, NUM Sector Bancário e Financeiro Especializado</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>No competitivo sector bancário, é essencial que o pessoal bancário tenha um conhecimento profundo dos produtos, das necessidades dos clientes, das considerações éticas e legais, da gestão financeira, das operações, da gestão do risco e da conformidade. O conhecimento dos produtos ajuda o pessoal a orientar os clientes de forma eficaz, a criar confiança e a reter clientes. A adesão a normas éticas e à conformidade legal protege os dados sensíveis e evita danos à reputação. Um domínio sólido da gestão financeira garante a eficácia da tomada de decisões, o controle dos custos e a rentabilidade. Operações eficientes, incluindo a adaptação à tecnologia, são fundamentais para o bom funcionamento quotidiano. Compreender a gestão de riscos protege o banco de perdas e danos à reputação. A conformidade com a evolução da regulamentação é crucial para evitar sanções. Um pessoal bem formado proporciona uma vantagem competitiva, oferecendo um serviço personalizado, promovendo a inovação e impulsionando o crescimento. Em última análise, um conhecimento abrangente destas áreas garante a satisfação do cliente, reduz os riscos, apoia a adesão legal e mantém o banco competitivo num sector em constante mudança.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Gestão da carteira de clientes e de crédito</li>
        <li>Gestão da relação com os clientes e qualidade dos serviços</li>
        <li>Venda de produtos de tesouraria</li>
        <li>Combate ao branqueamento de capitais e ao financiamento do terrorismo</li>
        <li>Regulamentação bancária e entidades reguladoras</li>
        <li>Produtos e serviços: banca de retalho, empresas e investimento</li>
        <li>Banca digital e considerações éticas e jurídicas</li>
        <li>Gestão financeira, operações bancárias, riscos e conformidade</li>
      </ul>
    </section>

    <!-- 12 -->
    <section class="course-block">
      <h2>Gestão de Crises e Continuidade das Actividades (PCN)</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>As organizações devem estar preparadas para a Gestão de Crises e ter um Plano de Continuidade do Negócio (PCN) para mitigar o impacto de interrupções imprevistas, proteger a sua reputação e garantir a continuidade das operações. As crises podem ocorrer repentinamente, sejam elas naturais, tecnológicas ou provocadas pelo homem, e estar preparado permite que as organizações respondam rapidamente para minimizar os danos. Um PCN assegura uma recuperação rápida, reduz o tempo de inatividade e atribui recursos de forma eficiente. Ajuda a proteger a confiança e a reputação dos clientes através de uma comunicação eficaz em caso de crise, assegura a conformidade legal e minimiza a responsabilidade. A segurança dos funcionários, a saúde mental e a proteção financeira também são prioridades nestes planos. As organizações preparadas obtêm uma vantagem competitiva, assegurando a viabilidade a longo prazo através da manutenção das operações e da melhoria da eficiência na resposta a crises. A prática regular e a melhoria contínua dos planos de crise asseguram a adaptabilidade a desafios futuros, permitindo que as empresas recuperem rapidamente e se mantenham resilientes face a perturbações.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Fundamentos da gestão de crises e avaliação de riscos</li>
        <li>Planeamento da continuidade das actividades (BCP)</li>
        <li>Comunicação de crise e resposta a incidentes</li>
        <li>Resiliência tecnológica e recuperação de desastres</li>
        <li>Simulação de crises e exercícios de mesa</li>
        <li>Estratégia de recuperação, conformidade e liderança em crises</li>
        <li>Resiliência da cadeia de abastecimento e impacto financeiro</li>
        <li>Saúde mental dos funcionários durante crises e avaliação pós-crise</li>
      </ul>
    </section>

    <!-- 13 -->
    <section class="course-block">
      <h2>MELHORAR A EDUCAÇÃO FINANCEIRA, COMPREENDER A PSICOLOGIA DO DINHEIRO, DESENVOLVER UM SENTIDO DE SATISFAÇÃO E CONSTRUIR UMA RELAÇÃO SAUDÁVEL COM A POSSE E ACUMULAÇÃO DE RIQUEZA E MATERIAIS</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>Melhorar a educação financeira, compreender a psicologia do dinheiro, desenvolver um sentido de satisfação e construir uma relação saudável com a riqueza e os bens materiais são essenciais para alcançar a segurança financeira, evitar dívidas e criar uma acumulação de riqueza com objectivos. Ao dotar os indivíduos dos conhecimentos necessários para gerir o dinheiro de forma eficaz, estes podem reduzir o stress financeiro, tomar decisões informadas e planear o futuro. Compreender a psicologia do dinheiro promove o bem-estar mental ao abordar os fatores emocionais que desencadeiam o dinheiro, conduzindo a comportamentos financeiros mais saudáveis. Concentrarse na satisfação e não na acumulação promove o contentamento e o crescimento pessoal, permitindo que os indivíduos façam escolhas que estejam de acordo com os seus valores. Isto também tem um impacto geracional, ensinando bons hábitos financeiros para o sucesso futuro. Em última análise, a literacia financeira permite uma melhor tomada de decisões, contribuindo para a felicidade e realização a longo prazo, ao encarar a riqueza como uma ferramenta para melhorar a vida e não como o objetivo final.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Educação financeira, mentalidade e crenças sobre o dinheiro</li>
        <li>Gastos baseados em valores e construção de riqueza</li>
        <li>Generosidade, dádiva e gestão da dívida</li>
        <li>Bem-estar emocional, psicológico e relacionamento com o dinheiro</li>
        <li>Definição de objectivos financeiros e prioridades</li>
        <li>Princípios para alcançar o sucesso: autoconhecimento, resiliência e disciplina</li>
        <li>Literacia financeira, saúde, bem-estar e missão de vida</li>
      </ul>
    </section>

    <!-- 14 -->
    <section class="course-block">
      <h2>Entrepreneuriat / Empreendedorismo</h2>
      <div class="reason-box">
        <h3>Porquê / Razão</h3>
        <p>No ambiente global acelerado e competitivo dos dias de hoje, o empreendedorismo é crucial para impulsionar a inovação, a criação de emprego e o crescimento económico. Para serem bem sucedidos, os empresários devem dominar uma vasta gama de competências. Uma sólida compreensão dos fundamentos do empreendedorismo permite-lhes assumir riscos calculados e tomar decisões informadas. A identificação de oportunidades de negócio e o desenvolvimento de um modelo de negócio único constituem a base para uma vantagem competitiva e um sucesso a longo prazo. Um planejamento empresarial eficaz assegura uma orientação estratégica e é essencial para garantir o financiamento. Estratégias de marketing, gestão financeira, conhecimentos jurídicos e éticos e operações eficientes são vitais para o crescimento e a sustentabilidade da empresa. As competências de liderança e a formação de equipas promovem um elevado desempenho e uma cultura empresarial positiva, enquanto a obtenção de financiamento permite a expansão e o desenvolvimento. Os empresários devem também compreender as estratégias de saída para atingir os seus objectivos financeiros. A tutoria, o trabalho em rede e a adaptação à era digital são fundamentais para superar os desafios e expandir o alcance do mercado. Por último, o desenvolvimento pessoal e a mentalidade são essenciais para a resiliência e a adaptabilidade. O domínio destes tópicos permite aos empresários prosperar num mercado cada vez mais competitivo, criando empresas sustentáveis e liderando com decisões informadas.</p>
      </div>
      <div class="modules-header">Módulos Propostos</div>
      <ul class="modules-grid">
        <li>Introdução ao empreendedorismo e identificação de oportunidades</li>
        <li>Desenvolvimento de ideias, modelo e planeamento de negócios</li>
        <li>Estratégias de marketing e gestão financeira para empresários</li>
        <li>Considerações legais, éticas e gestão de operações</li>
        <li>Competências de liderança e formação de equipas</li>
        <li>Financiamento, investimento, expansão e estratégias de saída</li>
        <li>Mentoria, criação de redes e empreendedorismo na era digital</li>
        <li>Desenvolvimento pessoal e mentalidade para empresários</li>
      </ul>
    </section>

  </div>
</main>

@endsection

@push('scripts')
<script>
function filterCatalog() {
  const input = document.getElementById('searchInput').value.toLowerCase();
  const blocks = document.getElementsByClassName('course-block');
  for (let i = 0; i < blocks.length; i++) {
    const text = blocks[i].innerText.toLowerCase();
    blocks[i].style.display = text.includes(input) ? "block" : "none";
  }
}
</script>
@endpush
