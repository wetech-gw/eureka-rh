/* =========================================================
   EUREKA CONSULTING — site.js (partilhado)
   Traduções + comportamento comum das páginas públicas
   ========================================================= */
"use strict";
  const ICON = {
    compass:'<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polygon points="16 8 13.5 13.5 8 16 10.5 10.5 16 8"/></svg>',
    chart:'<svg viewBox="0 0 24 24"><path d="M4 20V10M10 20V4M16 20v-7M20 20H3"/></svg>',
    megaphone:'<svg viewBox="0 0 24 24"><path d="M3 11v2a1 1 0 0 0 1 1h3l5 4V6L7 10H4a1 1 0 0 0-1 1Z"/><path d="M16 9a4 4 0 0 1 0 6"/></svg>',
    coins:'<svg viewBox="0 0 24 24"><ellipse cx="9" cy="7" rx="6" ry="3"/><path d="M3 7v5c0 1.7 2.7 3 6 3"/><ellipse cx="15" cy="14" rx="6" ry="3"/><path d="M9 14v3c0 1.7 2.7 3 6 3s6-1.3 6-3v-6"/></svg>',
    handshake:'<svg viewBox="0 0 24 24"><path d="M11 17 8.5 14.5a2 2 0 0 1 0-3l3-3 4 1 4-1v7l-3 3-3-2"/><path d="M3 6v7l3 3"/><path d="M11.5 8.5 9 6H3"/></svg>',
    research:'<svg viewBox="0 0 24 24"><circle cx="10" cy="10" r="6"/><path d="m20 20-5.6-5.6"/><path d="M10 7v6M7 10h6"/></svg>',
    folder:'<svg viewBox="0 0 24 24"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"/></svg>',
    target:'<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="12" r="1"/></svg>',
    invest:'<svg viewBox="0 0 24 24"><path d="M3 17 9 11l4 4 8-8"/><path d="M15 7h6v6"/></svg>',
    globe:'<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.5 2.5 15 0 18M12 3c-2.5 2.5-2.5 15 0 18"/></svg>',
    people:'<svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20a6 6 0 0 1 12 0"/><path d="M16 5a3 3 0 0 1 0 6M21 20a6 6 0 0 0-4-5.6"/></svg>',
    cap:'<svg viewBox="0 0 24 24"><path d="m12 4 9 4-9 4-9-4 9-4Z"/><path d="M7 10v4c0 1.5 2.2 3 5 3s5-1.5 5-3v-4"/></svg>',
    team:'<svg viewBox="0 0 24 24"><circle cx="12" cy="7" r="3"/><circle cx="5" cy="11" r="2.5"/><circle cx="19" cy="11" r="2.5"/><path d="M6 20a6 6 0 0 1 12 0M2 19a4 4 0 0 1 4-3M22 19a4 4 0 0 0-4-3"/></svg>',
    rocket:'<svg viewBox="0 0 24 24"><path d="M5 15c-1.5 1.5-2 5-2 5s3.5-.5 5-2"/><path d="M9 15s5-1 8-4 4-8 4-8-5 1-8 4-4 8-4 8Z"/><circle cx="14.5" cy="9.5" r="1.5"/></svg>',
    arrow:'<svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>',
    ext:'<svg viewBox="0 0 24 24"><path d="M14 5h5v5M19 5l-8 8M11 5H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5"/></svg>',
    pin:'<svg viewBox="0 0 24 24"><path d="M12 21s7-6.3 7-11a7 7 0 0 0-14 0c0 4.7 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>',
    phone:'<svg viewBox="0 0 24 24"><path d="M5 4h3l2 5-2 1a11 11 0 0 0 5 5l1-2 5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg>',
    mail:'<svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>',
    clock:'<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>',
  };

  const I18N = {
    pt: {
      "nav.top":"Início","nav.servicos":"Serviços","nav.recrutamento":"Vagas & Formações","nav.recursos":"Recursos","nav.sobre":"Sobre","nav.noticias":"Notícias","nav.contacto":"Contacto","nav.cta":"Solicitar consultoria",
      "hero.eyebrow":"Consultoria empresarial · Bissau & África Ocidental",
      "hero.title":'Estruturamos negócios que <span class="ink-accent">crescem</span> no terreno africano.',
      "hero.lede":"Acompanhamos empresas, instituições e empreendedores com estratégia, finanças e gestão de projetos — do diagnóstico aos resultados medidos.",
      "hero.cta1":"Conhecer os serviços","hero.cta2":"Entrar em contacto",
      "hero.stat1":"anos de experiência","hero.stat2":"clientes acompanhados","hero.stat3":"serviços especializados",
      "sec.servicos.eyebrow":"O que fazemos","sec.servicos.title":"Serviços especializados, do diagnóstico à execução","sec.servicos.desc":"Competências multidisciplinares para cada fase do percurso empresarial, desenhadas para o contexto local.",
      "svc.more":"Saber mais",
      "svc.consultoria.t":"Consultoria","svc.consultoria.d":"Aconselhamento estratégico transversal para decisões empresariais mais seguras.",
      "svc.gestao.t":"Gestão e Estratégia","svc.gestao.d":"Estruturação, planeamento e otimização de operações orientadas a resultados.",
      "svc.marketing.t":"Marketing e Comunicação","svc.marketing.d":"Posicionamento de marca, comunicação e captação de mercado.",
      "svc.financas.t":"Finanças, Contabilidade, Auditoria e Fiscalidade","svc.financas.d":"Gestão financeira, conformidade e auditoria com rigor técnico.",
      "svc.microfin.t":"Microfinanças","svc.microfin.d":"Soluções de inclusão financeira e apoio a instituições de microcrédito.",
      "svc.estudos.t":"Estudos Socioeconómicos","svc.estudos.d":"Diagnósticos e análises de impacto baseados em dados do terreno.",
      "svc.projetos.t":"Gestão de Projetos","svc.projetos.d":"Planeamento, execução e controlo de projetos do início ao fim.",
      "svc.monitoria.t":"Monitorização e Avaliação","svc.monitoria.d":"Medição de desempenho e avaliação de resultados de programas.",
      "svc.invest.t":"Financiamento e Investimento","svc.invest.d":"Preparação de dossiês e ligação a fontes de financiamento.",
      "svc.traducao.t":"Tradução e Interpretação","svc.traducao.d":"Serviços linguísticos profissionais para negócios e instituições.",
      "svc.rh.t":"Recursos Humanos","svc.rh.d":"Recrutamento, gestão de talento e desenvolvimento de equipas.",
      "svc.formacoes.t":"Formações","svc.formacoes.d":"Capacitação prática adaptada às necessidades de cada organização.",
      "svc.equipas.t":"Construção de Equipas","svc.equipas.d":"Programas de coesão e desempenho coletivo.",
      "svc.boost.t":"BOOST_ME — Acelerador de Empresas","svc.boost.d":"O nosso programa de aceleração para empreendedores e empresas em crescimento.",
      "sec.rec.eyebrow":"Carreiras & Capacitação","sec.rec.title":"Oportunidades de Recrutamento e Formações","sec.rec.desc":"Consulte os processos seletivos abertos e a agenda das nossas formações.",
      "sec.rec.searchPh":"Pesquisar por vaga, departamento...","sec.rec.loadVagas":"A carregar vagas...","sec.rec.subtitle":"Formações & Workshops","sec.rec.loadFormacoes":"A carregar formações...",
      "cand.title":"Candidatar-se a uma vaga",
      "cand.vaga":'Vaga Pretendida <span>*</span>',"cand.vagaPh":"Selecione a vaga...",
      "cand.nome":'Nome Completo <span>*</span>',"cand.nomePh":"Nome completo",
      "cand.email":'Email <span>*</span>',"cand.emailPh":"exemplo@email.com",
      "cand.tel":'Telefone <span>*</span>',"cand.telPh":"+245...",
      "cand.prof":"Profissão","cand.profPh":"Ex: Gestor de RH",
      "cand.nivel":"Nível Académico","cand.nivelPh":"Selecionar...","cand.nivelSec":"Secundário","cand.nivelLic":"Licenciatura","cand.nivelMes":"Mestrado","cand.nivelDoc":"Doutoramento",
      "cand.exp":"Anos de Experiência","cand.expPh":"Ex: 3",
      "cand.comp":"Competências","cand.compPh":"Ex: Excel avançado, Laravel",
      "cand.loc":"Localização","cand.locPh":"Ex: Bissau",
      "cand.cv":'Currículo (PDF ou DOCX) <span>*</span>',"cand.cvHint":"Tamanho máximo: 2MB",
      "cand.cancel":"Cancelar","cand.submit":"Enviar Candidatura","cand.sending":"A enviar...",
      "cand.errVaga":"Selecione uma vaga para se candidatar.","cand.errSend":"Não foi possível registar a candidatura.","cand.errGeneric":"Ocorreu um erro ao enviar a candidatura.",
      "vg.empty":"Não há processos de recrutamento abertos no momento.","vg.geral":"Geral","vg.bissau":"Bissau","vg.recrutamento":"Recrutamento","vg.prazo":"Prazo:","vg.cand":"Candidatar-se",
      "frm.empty":"Não há formações agendadas no momento.","frm.horario":"Horário","frm.entidade":"Entidade Formadora","frm.inicio":"Início","frm.fim":"Fim","frm.carga":"Carga Horária","frm.inscrever":"Inscrever-se","frm.inscricao":"Inscrição em formação: ",
      "vg.errVagas":"Não foi possível carregar as vagas.","frm.errFormacoes":"Não foi possível carregar as formações.",
      "sec.diff.eyebrow":"Porquê a Eureka","sec.diff.title":"Conhecemos o terreno onde a sua empresa cresce","sec.diff.desc":"Rigor técnico com proximidade real ao mercado africano. Trabalhamos lado a lado com cada cliente, do diagnóstico aos resultados.","sec.diff.cta":"Falar com um consultor",
      "diff.1.t":"Conhecimento do contexto local","diff.1.d":"Dominamos as especificidades do mercado da Guiné-Bissau e da região.",
      "diff.2.t":"Experiência no mercado africano","diff.2.d":"Mais de uma década a apoiar organizações em vários setores.",
      "diff.3.t":"Soluções personalizadas","diff.3.d":"Cada projeto desenhado à medida da realidade do cliente.",
      "diff.4.t":"Equipa multidisciplinar","diff.4.d":"Especialistas em finanças, estratégia, projetos e capital humano.",
      "diff.5.t":"Acompanhamento estratégico","diff.5.d":"Presença próxima do diagnóstico à implementação.",
      "diff.6.t":"Compromisso com resultados","diff.6.d":"Medimos o sucesso pelo impacto real nos negócios.",
      "sec.res.eyebrow":"Recursos para empreendedores","sec.res.title":"Instituições que apoiam quem constrói","sec.res.desc":"Organizações de referência no financiamento e no apoio ao empreendedorismo na sub-região.",
      "res.1.d":"Apoio ao desenvolvimento e financiamento de jovens empreendedores.",
      "res.2.d":"Agência de desenvolvimento e enquadramento das PME.",
      "res.3.d":"Fundo de garantia para o investimento prioritário.",
      "res.4.d":"Fundo soberano de investimentos estratégicos.",
      "res.visit":"Visitar site",
      "sec.about.eyebrow":"Sobre a Eureka","sec.about.title":"Uma parceira que entende o contexto empresarial africano",
      "sec.about.p1":"Nascida em Bissau, a Eureka Consulting cresceu ao ritmo das empresas que acompanha. Ajudamos organizações a estruturar-se, a decidir melhor e a expandir-se com confiança por toda a África Ocidental.",
      "sec.about.p2":"A nossa equipa multidisciplinar reúne especialistas em estratégia, finanças, gestão de projetos e desenvolvimento de negócios, com um compromisso comum: resultados reais e duradouros.",
      "sec.about.missao":"Missão","sec.about.missaoD":"Capacitar empresas e empreendedores com soluções estratégicas que geram crescimento sustentável e impacto positivo na economia da região.",
      "sec.about.visao":"Visão","sec.about.visaoD":"Ser a consultora de referência na África Ocidental, reconhecida pela proximidade, competência e resultados que transformam negócios.",
      "sec.about.areas":"Áreas de atuação",
      "sec.about.area1":"Estratégia e gestão empresarial","sec.about.area2":"Finanças, contabilidade e fiscalidade","sec.about.area3":"Microfinanças e inclusão financeira","sec.about.area4":"Gestão e avaliação de projetos","sec.about.area5":"Capital humano e formação","sec.about.area6":"Estudos socioeconómicos",
      "sec.about.presence":"Presença regional: Guiné-Bissau · África Ocidental",
      "sec.val.eyebrow":"O que nos guia","sec.val.title":"Valores que sustentam cada projeto",
      "val.1":"Profissionalismo","val.2":"Responsabilidade","val.3":"Honestidade","val.4":"Integridade","val.5":"Gratidão","val.6":"Inovação","val.7":"Disciplina",
      "sec.hist.eyebrow":"O nosso percurso","sec.hist.title":"Uma história de crescimento contínuo",
      "hist.1.fase":"Criação","hist.1.meta":"Os primeiros passos","hist.1.d":"A Eureka nasce em Bissau com a missão de aproximar consultoria de qualidade das empresas locais.",
      "hist.2.fase":"Crescimento","hist.2.meta":"Consolidação","hist.2.d":"Alargamento da carteira de serviços e da equipa multidisciplinar.",
      "hist.3.fase":"Expansão Africana","hist.3.meta":"Para além das fronteiras","hist.3.d":"Projetos e parcerias em vários países da África Ocidental.",
      "hist.4.fase":"Visão Futura","hist.4.meta":"O próximo capítulo","hist.4.d":"Aceleração de empresas, inovação e ligação a redes internacionais de investimento.",
      "sec.boost.eyebrow":"Programa de aceleração",
      "sec.boost.title":'<span class="boost-name">BOOST_ME</span><br>Acelerador de Empresas',
      "sec.boost.desc":"Um programa desenhado para apoiar empreendedores e empresas no desenvolvimento, estruturação e crescimento dos seus negócios. Da ideia à escala, acompanhamos cada etapa com mentoria, ferramentas e acesso a redes de financiamento.",
      "sec.boost.f1":"Diagnóstico e estruturação do negócio","sec.boost.f2":"Mentoria estratégica personalizada","sec.boost.f3":"Preparação para financiamento e investimento",
      "sec.boost.cta1":"Conhecer o programa","sec.boost.cta2":"Candidatar-se","sec.boost.cta3":"Solicitar informações",
      "sec.news.eyebrow":"Atualidade","sec.news.title":"Notícias e perspetivas de mercado","sec.news.desc":"Análises sobre economia, negócios e empreendedorismo na Guiné-Bissau e na região.",
      "news.1.cat":"Economia","news.1.data":"12 Mai 2026","news.1.t":"Setor privado guineense regista crescimento no primeiro trimestre","news.1.r":"Dados recentes apontam para uma recuperação sustentada nos serviços e no comércio.",
      "news.2.cat":"Empreendedorismo","news.2.data":"28 Abr 2026","news.2.t":"Como preparar a sua empresa para captar financiamento","news.2.r":"Um guia prático sobre os documentos e indicadores que os investidores valorizam.",
      "news.3.cat":"BOOST_ME","news.3.data":"05 Abr 2026","news.3.t":"Programa BOOST_ME abre nova vaga de candidaturas","news.3.r":"Empreendedores podem submeter os seus projetos para a próxima edição do acelerador.",
      "news.read":"Ler mais",
      "cta.title":"Transforme os seus desafios em oportunidades de crescimento.","cta.btn":"Solicitar uma consultoria",
      "sec.contact.eyebrow":"Vamos conversar","sec.contact.title":"Conte-nos o seu desafio","sec.contact.desc":"Respondemos em até 48 horas úteis. Prefere falar diretamente? Use os contactos abaixo.",
      "ct.pin":"Endereço","ct.phone":"Telefones","ct.mail":"Email","ct.clock":"Horário","ct.clockV":"Seg – Sex · 08h00 às 17h30",
      "f.nome":'Nome <span>*</span>',"f.empresa":"Empresa","f.email":'Email <span>*</span>',"f.tel":"Telefone","f.assunto":"Assunto","f.servico":"Serviço de interesse","f.servicoPh":"Selecione…","f.mensagem":'Mensagem <span>*</span>',"f.submit":"Enviar mensagem",
      "f.errNome":"Indique o seu nome.","f.errEmail":"Indique o seu email.","f.errEmailInv":"Email inválido.","f.errMsg":"Escreva a sua mensagem.","f.errTop":"Verifique os campos assinalados.","f.ok":"Mensagem enviada com sucesso. Entraremos em contacto em breve.",
      "footer.desc":"Consultoria empresarial de referência na Guiné-Bissau e na África Ocidental. Estratégia, finanças e crescimento — ao seu lado.",
      "footer.nav":"Navegação","footer.svc":"Serviços","footer.contact":"Contacto","footer.rights":"Todos os direitos reservados.","footer.privacy":"Política de privacidade","footer.legal":"Aviso legal","footer.admin":"Admin",
    },
    fr: {
      "nav.top":"Accueil","nav.servicos":"Services","nav.recrutamento":"Emplois & Formations","nav.recursos":"Ressources","nav.sobre":"À propos","nav.noticias":"Actualités","nav.contacto":"Contact","nav.cta":"Demander un conseil",
      "hero.eyebrow":"Consulting d'entreprise · Bissau & Afrique de l'Ouest",
      "hero.title":'Nous structurons des entreprises qui <span class="ink-accent">grandissent</span> sur le terrain africain.',
      "hero.lede":"Nous accompagnons entreprises, institutions et entrepreneurs en stratégie, finance et gestion de projet — du diagnostic aux résultats mesurés.",
      "hero.cta1":"Découvrir les services","hero.cta2":"Nous contacter",
      "hero.stat1":"années d'expérience","hero.stat2":"clients accompagnés","hero.stat3":"services spécialisés",
      "sec.servicos.eyebrow":"Ce que nous faisons","sec.servicos.title":"Des services spécialisés, du diagnostic à l'exécution","sec.servicos.desc":"Des compétences pluridisciplinaires pour chaque étape du parcours entrepreneurial, conçues pour le contexte local.",
      "svc.more":"En savoir plus",
      "svc.consultoria.t":"Conseil","svc.consultoria.d":"Conseil stratégique transversal pour des décisions d'entreprise plus sûres.",
      "svc.gestao.t":"Gestion & Stratégie","svc.gestao.d":"Structuration, planification et optimisation d'opérations orientées résultats.",
      "svc.marketing.t":"Marketing & Communication","svc.marketing.d":"Positionnement de marque, communication et conquête du marché.",
      "svc.financas.t":"Finance, Comptabilité, Audit & Fiscalité","svc.financas.d":"Gestion financière, conformité et audit avec rigueur technique.",
      "svc.microfin.t":"Microfinance","svc.microfin.d":"Solutions d'inclusion financière et appui aux institutions de microcrédit.",
      "svc.estudos.t":"Études socioéconomiques","svc.estudos.d":"Diagnostics et analyses d'impact fondés sur les données du terrain.",
      "svc.projetos.t":"Gestion de projets","svc.projetos.d":"Planification, exécution et contrôle de projets de bout en bout.",
      "svc.monitoria.t":"Suivi & Évaluation","svc.monitoria.d":"Mesure de la performance et évaluation des résultats des programmes.",
      "svc.invest.t":"Financement & Investissement","svc.invest.d":"Préparation de dossiers et mise en relation avec les sources de financement.",
      "svc.traducao.t":"Traduction & Interprétation","svc.traducao.d":"Services linguistiques professionnels pour entreprises et institutions.",
      "svc.rh.t":"Ressources humaines","svc.rh.d":"Recrutement, gestion des talents et développement des équipes.",
      "svc.formacoes.t":"Formations","svc.formacoes.d":"Renforcement des capacités adapté aux besoins de chaque organisation.",
      "svc.equipas.t":"Construction d'équipes","svc.equipas.d":"Programmes de cohésion et de performance collective.",
      "svc.boost.t":"BOOST_ME — Accélérateur d'entreprises","svc.boost.d":"Notre programme d'accélération pour entrepreneurs et entreprises en croissance.",
      "sec.rec.eyebrow":"Carrières & Formation","sec.rec.title":"Opportunités de recrutement et formations","sec.rec.desc":"Consultez les processus de sélection ouverts et l'agenda de nos formations.",
      "sec.rec.searchPh":"Rechercher un poste, un département...","sec.rec.loadVagas":"Chargement des offres...","sec.rec.subtitle":"Formations & Ateliers","sec.rec.loadFormacoes":"Chargement des formations...",
      "cand.title":"Postuler à une offre",
      "cand.vaga":'Offre souhaitée <span>*</span>',"cand.vagaPh":"Sélectionnez l'offre...",
      "cand.nome":'Nom complet <span>*</span>',"cand.nomePh":"Nom complet",
      "cand.email":'Email <span>*</span>',"cand.emailPh":"exemple@email.com",
      "cand.tel":'Téléphone <span>*</span>',"cand.telPh":"+245...",
      "cand.prof":"Profession","cand.profPh":"Ex : Responsable RH",
      "cand.nivel":"Niveau académique","cand.nivelPh":"Sélectionner...","cand.nivelSec":"Secondaire","cand.nivelLic":"Licence","cand.nivelMes":"Master","cand.nivelDoc":"Doctorat",
      "cand.exp":"Années d'expérience","cand.expPh":"Ex : 3",
      "cand.comp":"Compétences","cand.compPh":"Ex : Excel avancé, Laravel",
      "cand.loc":"Localisation","cand.locPh":"Ex : Bissau",
      "cand.cv":'CV (PDF ou DOCX) <span>*</span>',"cand.cvHint":"Taille maximale : 2 Mo",
      "cand.cancel":"Annuler","cand.submit":"Envoyer la candidature","cand.sending":"Envoi en cours...",
      "cand.errVaga":"Sélectionnez une offre pour postuler.","cand.errSend":"Impossible d'enregistrer la candidature.","cand.errGeneric":"Une erreur est survenue lors de l'envoi de la candidature.",
      "vg.empty":"Aucun processus de recrutement ouvert actuellement.","vg.geral":"Général","vg.bissau":"Bissau","vg.recrutamento":"Recrutement","vg.prazo":"Date limite :","vg.cand":"Postuler",
      "frm.empty":"Aucune formation planifiée pour le moment.","frm.horario":"Horaire","frm.entidade":"Organisme de formation","frm.inicio":"Début","frm.fim":"Fin","frm.carga":"Volume horaire","frm.inscrever":"S'inscrire","frm.inscricao":"Inscription à la formation : ",
      "vg.errVagas":"Impossible de charger les offres.","frm.errFormacoes":"Impossible de charger les formations.",
      "sec.diff.eyebrow":"Pourquoi la Eureka","sec.diff.title":"Nous connaissons le terrain où votre entreprise grandit","sec.diff.desc":"Rigueur technique et proximité réelle avec le marché africain. Nous travaillons main dans la main avec chaque client, du diagnostic aux résultats.","sec.diff.cta":"Parler à un consultant",
      "diff.1.t":"Connaissance du contexte local","diff.1.d":"Nous maîtrisons les spécificités du marché de la Guinée-Bissau et de la région.",
      "diff.2.t":"Expérience du marché africain","diff.2.d":"Plus d'une décennie d'accompagnement d'organisations dans plusieurs secteurs.",
      "diff.3.t":"Solutions personnalisées","diff.3.d":"Chaque projet conçu sur mesure selon la réalité du client.",
      "diff.4.t":"Équipe pluridisciplinaire","diff.4.d":"Experts en finance, stratégie, projets et capital humain.",
      "diff.5.t":"Accompagnement stratégique","diff.5.d":"Présence de proximité du diagnostic à la mise en œuvre.",
      "diff.6.t":"Engagement envers les résultats","diff.6.d":"Nous mesurons le succès à l'impact réel sur les entreprises.",
      "sec.res.eyebrow":"Ressources pour entrepreneurs","sec.res.title":"Des institutions qui soutiennent ceux qui construisent","sec.res.desc":"Organisations de référence en matière de financement et d'appui à l'entrepreneuriat dans la sous-région.",
      "res.1.d":"Appui au développement et au financement des jeunes entrepreneurs.",
      "res.2.d":"Agence de développement et de structuration des PME.",
      "res.3.d":"Fonds de garantie pour l'investissement prioritaire.",
      "res.4.d":"Fonds souverain d'investissements stratégiques.",
      "res.visit":"Visiter le site",
      "sec.about.eyebrow":"À propos de la Eureka","sec.about.title":"Un partenaire qui comprend le contexte entrepreneurial africain",
      "sec.about.p1":"Née à Bissau, Eureka Consulting a grandi au rythme des entreprises qu'elle accompagne. Nous aidons les organisations à se structurer, à mieux décider et à s'étendre avec confiance à travers l'Afrique de l'Ouest.",
      "sec.about.p2":"Notre équipe pluridisciplinaire réunit des experts en stratégie, finance, gestion de projets et développement d'affaires, avec un engagement commun : des résultats réels et durables.",
      "sec.about.missao":"Mission","sec.about.missaoD":"Renforcer les entreprises et les entrepreneurs avec des solutions stratégiques qui génèrent une croissance durable et un impact positif sur l'économie de la région.",
      "sec.about.visao":"Vision","sec.about.visaoD":"Devenir le consultant de référence en Afrique de l'Ouest, reconnu pour sa proximité, sa compétence et les résultats qui transforment les entreprises.",
      "sec.about.areas":"Domaines d'intervention",
      "sec.about.area1":"Stratégie et gestion d'entreprise","sec.about.area2":"Finance, comptabilité et fiscalité","sec.about.area3":"Microfinance et inclusion financière","sec.about.area4":"Gestion et évaluation de projets","sec.about.area5":"Capital humain et formation","sec.about.area6":"Études socioéconomiques",
      "sec.about.presence":"Présence régionale : Guinée-Bissau · Afrique de l'Ouest",
      "sec.val.eyebrow":"Ce qui nous guide","sec.val.title":"Des valeurs qui soutiennent chaque projet",
      "val.1":"Professionnalisme","val.2":"Responsabilité","val.3":"Honnêteté","val.4":"Intégrité","val.5":"Gratitude","val.6":"Innovation","val.7":"Discipline",
      "sec.hist.eyebrow":"Notre parcours","sec.hist.title":"Une histoire de croissance continue",
      "hist.1.fase":"Création","hist.1.meta":"Les premiers pas","hist.1.d":"Eureka naît à Bissau avec la mission de rapprocher un conseil de qualité des entreprises locales.",
      "hist.2.fase":"Croissance","hist.2.meta":"Consolidation","hist.2.d":"Élargissement de la gamme de services et de l'équipe pluridisciplinaire.",
      "hist.3.fase":"Expansion africaine","hist.3.meta":"Au-delà des frontières","hist.3.d":"Projets et partenariats dans plusieurs pays d'Afrique de l'Ouest.",
      "hist.4.fase":"Vision future","hist.4.meta":"Le prochain chapitre","hist.4.d":"Accélération d'entreprises, innovation et connexion aux réseaux internationaux d'investissement.",
      "sec.boost.eyebrow":"Programme d'accélération",
      "sec.boost.title":'<span class="boost-name">BOOST_ME</span><br>Accélérateur d\'entreprises',
      "sec.boost.desc":"Un programme conçu pour accompagner entrepreneurs et entreprises dans le développement, la structuration et la croissance de leurs activités. De l'idée à l'échelle, nous suivons chaque étape avec du mentorat, des outils et l'accès aux réseaux de financement.",
      "sec.boost.f1":"Diagnostic et structuration du business","sec.boost.f2":"Mentorat stratégique personnalisé","sec.boost.f3":"Préparation au financement et à l'investissement",
      "sec.boost.cta1":"Découvrir le programme","sec.boost.cta2":"Postuler","sec.boost.cta3":"Demander des informations",
      "sec.news.eyebrow":"Actualité","sec.news.title":"Nouvelles et perspectives du marché","sec.news.desc":"Analyses sur l'économie, les affaires et l'entrepreneuriat en Guinée-Bissau et dans la région.",
      "news.1.cat":"Économie","news.1.data":"12 mai 2026","news.1.t":"Le secteur privé guinéen enregistre une croissance au premier trimestre","news.1.r":"Les données récentes indiquent une reprise soutenue dans les services et le commerce.",
      "news.2.cat":"Entrepreneuriat","news.2.data":"28 avril 2026","news.2.t":"Comment préparer votre entreprise à attirer des financements","news.2.r":"Un guide pratique sur les documents et indicateurs que les investisseurs valorisent.",
      "news.3.cat":"BOOST_ME","news.3.data":"05 avril 2026","news.3.t":"Le programme BOOST_ME ouvre une nouvelle vague de candidatures","news.3.r":"Les entrepreneurs peuvent soumettre leurs projets pour la prochaine édition de l'accélérateur.",
      "news.read":"Lire plus",
      "cta.title":"Transformez vos défis en opportunités de croissance.","cta.btn":"Demander un conseil",
      "sec.contact.eyebrow":"Parlons-en","sec.contact.title":"Racontez-nous votre défi","sec.contact.desc":"Nous répondons sous 48 heures ouvrables. Vous préférez parler directement ? Utilisez les coordonnées ci-dessous.",
      "ct.pin":"Adresse","ct.phone":"Téléphones","ct.mail":"Email","ct.clock":"Horaires","ct.clockV":"Lun – Ven · 08h00 à 17h30",
      "f.nome":'Nom <span>*</span>',"f.empresa":"Entreprise","f.email":'Email <span>*</span>',"f.tel":"Téléphone","f.assunto":"Sujet","f.servico":"Service d'intérêt","f.servicoPh":"Sélectionner…","f.mensagem":'Message <span>*</span>',"f.submit":"Envoyer le message",
      "f.errNome":"Indiquez votre nom.","f.errEmail":"Indiquez votre email.","f.errEmailInv":"Email invalide.","f.errMsg":"Écrivez votre message.","f.errTop":"Vérifiez les champs signalés.","f.ok":"Message envoyé avec succès. Nous vous contacterons sous peu.",
      "footer.desc":"Cabinet de conseil de référence en Guinée-Bissau et en Afrique de l'Ouest. Stratégie, finance et croissance — à vos côtés.",
      "footer.nav":"Navigation","footer.svc":"Services","footer.contact":"Contact","footer.rights":"Tous droits réservés.","footer.privacy":"Politique de confidentialité","footer.legal":"Mentions légales","footer.admin":"Admin",
    },
    en: {
      "nav.top":"Home","nav.servicos":"Services","nav.recrutamento":"Jobs & Training","nav.recursos":"Resources","nav.sobre":"About","nav.noticias":"News","nav.contacto":"Contact","nav.cta":"Request a consultation",
      "hero.eyebrow":"Business consulting · Bissau & West Africa",
      "hero.title":'We structure businesses that <span class="ink-accent">grow</span> on African ground.',
      "hero.lede":"We support companies, institutions and entrepreneurs with strategy, finance and project management — from diagnosis to measurable results.",
      "hero.cta1":"Explore our services","hero.cta2":"Get in touch",
      "hero.stat1":"years of experience","hero.stat2":"clients supported","hero.stat3":"specialised services",
      "sec.servicos.eyebrow":"What we do","sec.servicos.title":"Specialised services, from diagnosis to delivery","sec.servicos.desc":"Multidisciplinary expertise for every stage of the business journey, designed for the local context.",
      "svc.more":"Learn more",
      "svc.consultoria.t":"Consulting","svc.consultoria.d":"Cross-cutting strategic advice for safer business decisions.",
      "svc.gestao.t":"Management & Strategy","svc.gestao.d":"Structuring, planning and optimising operations focused on results.",
      "svc.marketing.t":"Marketing & Communications","svc.marketing.d":"Brand positioning, communications and market capture.",
      "svc.financas.t":"Finance, Accounting, Audit & Tax","svc.financas.d":"Financial management, compliance and auditing with technical rigour.",
      "svc.microfin.t":"Microfinance","svc.microfin.d":"Financial inclusion solutions and support for microcredit institutions.",
      "svc.estudos.t":"Socioeconomic Studies","svc.estudos.d":"Diagnostics and impact analyses based on field data.",
      "svc.projetos.t":"Project Management","svc.projetos.d":"Planning, execution and control of projects from start to finish.",
      "svc.monitoria.t":"Monitoring & Evaluation","svc.monitoria.d":"Performance measurement and programme results evaluation.",
      "svc.invest.t":"Financing & Investment","svc.invest.d":"Preparation of dossiers and connections to funding sources.",
      "svc.traducao.t":"Translation & Interpretation","svc.traducao.d":"Professional language services for businesses and institutions.",
      "svc.rh.t":"Human Resources","svc.rh.d":"Recruitment, talent management and team development.",
      "svc.formacoes.t":"Training","svc.formacoes.d":"Hands-on capacity building tailored to each organisation's needs.",
      "svc.equipas.t":"Team Building","svc.equipas.d":"Cohesion and collective performance programmes.",
      "svc.boost.t":"BOOST_ME — Business Accelerator","svc.boost.d":"Our acceleration programme for entrepreneurs and growing businesses.",
      "sec.rec.eyebrow":"Careers & Capacity Building","sec.rec.title":"Recruitment Opportunities and Training","sec.rec.desc":"Browse open selection processes and our training schedule.",
      "sec.rec.searchPh":"Search by job, department...","sec.rec.loadVagas":"Loading jobs...","sec.rec.subtitle":"Training & Workshops","sec.rec.loadFormacoes":"Loading training...",
      "cand.title":"Apply for a job",
      "cand.vaga":'Desired position <span>*</span>',"cand.vagaPh":"Select a job...",
      "cand.nome":'Full name <span>*</span>',"cand.nomePh":"Full name",
      "cand.email":'Email <span>*</span>',"cand.emailPh":"example@email.com",
      "cand.tel":'Phone <span>*</span>',"cand.telPh":"+245...",
      "cand.prof":"Occupation","cand.profPh":"e.g. HR Manager",
      "cand.nivel":"Academic level","cand.nivelPh":"Select...","cand.nivelSec":"Secondary","cand.nivelLic":"Bachelor's","cand.nivelMes":"Master's","cand.nivelDoc":"Doctorate",
      "cand.exp":"Years of Experience","cand.expPh":"e.g. 3",
      "cand.comp":"Skills","cand.compPh":"e.g. Advanced Excel, Laravel",
      "cand.loc":"Location","cand.locPh":"e.g. Bissau",
      "cand.cv":'CV (PDF or DOCX) <span>*</span>',"cand.cvHint":"Maximum size: 2MB",
      "cand.cancel":"Cancel","cand.submit":"Submit Application","cand.sending":"Sending...",
      "cand.errVaga":"Select a job to apply.","cand.errSend":"Unable to register the application.","cand.errGeneric":"An error occurred while sending the application.",
      "vg.empty":"No open recruitment processes at the moment.","vg.geral":"General","vg.bissau":"Bissau","vg.recrutamento":"Recruitment","vg.prazo":"Deadline:","vg.cand":"Apply",
      "frm.empty":"No training scheduled at the moment.","frm.horario":"Schedule","frm.entidade":"Training Provider","frm.inicio":"Start","frm.fim":"End","frm.carga":"Workload","frm.inscrever":"Enrol","frm.inscricao":"Enrolment in training: ",
      "vg.errVagas":"Unable to load the job listings.","frm.errFormacoes":"Unable to load the training.",
      "sec.diff.eyebrow":"Why Eureka","sec.diff.title":"We know the ground where your business grows","sec.diff.desc":"Technical rigour with real proximity to the African market. We work side by side with every client, from diagnosis to results.","sec.diff.cta":"Talk to a consultant",
      "diff.1.t":"Knowledge of the local context","diff.1.d":"We master the specifics of the Guinea-Bissau market and the region.",
      "diff.2.t":"Experience in the African market","diff.2.d":"Over a decade supporting organisations across several sectors.",
      "diff.3.t":"Tailored solutions","diff.3.d":"Every project designed to fit the client's reality.",
      "diff.4.t":"Multidisciplinary team","diff.4.d":"Experts in finance, strategy, projects and human capital.",
      "diff.5.t":"Strategic support","diff.5.d":"Close presence from diagnosis to implementation.",
      "diff.6.t":"Commitment to results","diff.6.d":"We measure success by real impact on businesses.",
      "sec.res.eyebrow":"Resources for entrepreneurs","sec.res.title":"Institutions that support those who build","sec.res.desc":"Leading organisations in financing and entrepreneurship support in the sub-region.",
      "res.1.d":"Support for the development and financing of young entrepreneurs.",
      "res.2.d":"Agency for the development and structuring of SMEs.",
      "res.3.d":"Guarantee fund for priority investment.",
      "res.4.d":"Sovereign fund for strategic investments.",
      "res.visit":"Visit website",
      "sec.about.eyebrow":"About Eureka","sec.about.title":"A partner that understands the African business context",
      "sec.about.p1":"Born in Bissau, Eureka Consulting grew alongside the businesses it supports. We help organisations structure themselves, decide better and expand with confidence across West Africa.",
      "sec.about.p2":"Our multidisciplinary team brings together experts in strategy, finance, project management and business development, united by a common commitment: real, lasting results.",
      "sec.about.missao":"Mission","sec.about.missaoD":"To empower businesses and entrepreneurs with strategic solutions that generate sustainable growth and positive impact on the region's economy.",
      "sec.about.visao":"Vision","sec.about.visaoD":"To be the leading consulting firm in West Africa, recognised for proximity, competence and results that transform businesses.",
      "sec.about.areas":"Areas of expertise",
      "sec.about.area1":"Strategy and business management","sec.about.area2":"Finance, accounting and tax","sec.about.area3":"Microfinance and financial inclusion","sec.about.area4":"Project management and evaluation","sec.about.area5":"Human capital and training","sec.about.area6":"Socioeconomic studies",
      "sec.about.presence":"Regional presence: Guinea-Bissau · West Africa",
      "sec.val.eyebrow":"What guides us","sec.val.title":"Values behind every project",
      "val.1":"Professionalism","val.2":"Responsibility","val.3":"Honesty","val.4":"Integrity","val.5":"Gratitude","val.6":"Innovation","val.7":"Discipline",
      "sec.hist.eyebrow":"Our journey","sec.hist.title":"A story of continuous growth",
      "hist.1.fase":"Creation","hist.1.meta":"The first steps","hist.1.d":"Eureka is born in Bissau with the mission of bringing quality consulting closer to local businesses.",
      "hist.2.fase":"Growth","hist.2.meta":"Consolidation","hist.2.d":"Expansion of the service portfolio and the multidisciplinary team.",
      "hist.3.fase":"African Expansion","hist.3.meta":"Beyond borders","hist.3.d":"Projects and partnerships across several West African countries.",
      "hist.4.fase":"Future Vision","hist.4.meta":"The next chapter","hist.4.d":"Business acceleration, innovation and links to international investment networks.",
      "sec.boost.eyebrow":"Acceleration programme",
      "sec.boost.title":'<span class="boost-name">BOOST_ME</span><br>Business Accelerator',
      "sec.boost.desc":"A programme designed to support entrepreneurs and businesses in developing, structuring and growing their ventures. From idea to scale, we accompany every stage with mentoring, tools and access to funding networks.",
      "sec.boost.f1":"Business diagnosis and structuring","sec.boost.f2":"Personalised strategic mentoring","sec.boost.f3":"Preparation for financing and investment",
      "sec.boost.cta1":"Learn about the programme","sec.boost.cta2":"Apply","sec.boost.cta3":"Request information",
      "sec.news.eyebrow":"Latest","sec.news.title":"News and market perspectives","sec.news.desc":"Analysis on the economy, business and entrepreneurship in Guinea-Bissau and the region.",
      "news.1.cat":"Economy","news.1.data":"12 May 2026","news.1.t":"Guinean private sector posts growth in the first quarter","news.1.r":"Recent data point to sustained recovery in services and trade.",
      "news.2.cat":"Entrepreneurship","news.2.data":"28 Apr 2026","news.2.t":"How to prepare your company to attract funding","news.2.r":"A practical guide to the documents and indicators investors value.",
      "news.3.cat":"BOOST_ME","news.3.data":"05 Apr 2026","news.3.t":"BOOST_ME programme opens new applications","news.3.r":"Entrepreneurs can submit their projects for the next edition of the accelerator.",
      "news.read":"Read more",
      "cta.title":"Turn your challenges into growth opportunities.","cta.btn":"Request a consultation",
      "sec.contact.eyebrow":"Let's talk","sec.contact.title":"Tell us about your challenge","sec.contact.desc":"We respond within 48 business hours. Prefer to talk directly? Use the contacts below.",
      "ct.pin":"Address","ct.phone":"Phones","ct.mail":"Email","ct.clock":"Hours","ct.clockV":"Mon – Fri · 8:00 AM to 5:30 PM",
      "f.nome":'Name <span>*</span>',"f.empresa":"Company","f.email":'Email <span>*</span>',"f.tel":"Phone","f.assunto":"Subject","f.servico":"Service of interest","f.servicoPh":"Select…","f.mensagem":'Message <span>*</span>',"f.submit":"Send message",
      "f.errNome":"Please enter your name.","f.errEmail":"Please enter your email.","f.errEmailInv":"Invalid email.","f.errMsg":"Please write your message.","f.errTop":"Please check the highlighted fields.","f.ok":"Message sent successfully. We'll be in touch soon.",
      "footer.desc":"Leading business consulting firm in Guinea-Bissau and West Africa. Strategy, finance and growth — by your side.",
      "footer.nav":"Navigation","footer.svc":"Services","footer.contact":"Contact","footer.rights":"All rights reserved.","footer.privacy":"Privacy policy","footer.legal":"Legal notice","footer.admin":"Admin",
    },
  };

  let currentLang = "pt";
  const _ = key => (I18N[currentLang] && I18N[currentLang][key]) || I18N.pt[key] || key;


  /* ---------- Aplicar idioma (conteúdo estático) ---------- */
  const applyLang = () => {
    document.documentElement.setAttribute("lang", currentLang);
    document.querySelectorAll(".lang-btn").forEach(b => b.classList.toggle("is-active", b.dataset.lang === currentLang));
    document.querySelectorAll("[data-i18n]").forEach(n => { n.textContent = _(n.dataset.i18n); });
    document.querySelectorAll("[data-i18n-html]").forEach(n => { n.innerHTML = _(n.dataset.i18nHtml); });
    document.querySelectorAll("[data-i18n-placeholder]").forEach(n => { n.placeholder = _(n.dataset.i18nPlaceholder); });
    if (typeof window.afterLangChange === "function") window.afterLangChange();
    refreshReveals();
  };
  document.querySelectorAll(".lang-switch").forEach(group => {
    group.querySelectorAll(".lang-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        currentLang = btn.dataset.lang;
        try { localStorage.setItem("eureka-lang", currentLang); } catch (e) {}
        applyLang();
      });
    });
  });
  try {
    const saved = localStorage.getItem("eureka-lang");
    if (saved && I18N[saved]) currentLang = saved;
  } catch (e) {}

  /* Cabeçalho scroll */
  const header = document.querySelector(".site-header");
  if (header) {
    const onScroll = () => header.classList.toggle("scrolled", window.scrollY > 16);
    window.addEventListener("scroll", onScroll, { passive:true }); onScroll();
  }

  /* Menu móvel */
  const toggle = document.getElementById("menuToggle");
  const nav = document.getElementById("mainNav");
  if (toggle && nav) {
    const closeMenu = () => { nav.classList.remove("open"); toggle.classList.remove("open"); toggle.setAttribute("aria-expanded","false"); };
    toggle.addEventListener("click", () => {
      const open = nav.classList.toggle("open");
      toggle.classList.toggle("open", open);
      toggle.setAttribute("aria-expanded", String(open));
    });
    nav.querySelectorAll("a").forEach(a => a.addEventListener("click", closeMenu));
  }

  /* Reveal */
  const rev = new IntersectionObserver((es,obs) => es.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add("in"); obs.unobserve(e.target); }
  }), { threshold:0.12 });
  const refreshReveals = () => document.querySelectorAll(".reveal:not(.in)").forEach(n => rev.observe(n));

  /* Ano */
  const yearEl = document.getElementById("year");
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  /* Expor API global para os scripts de página */
  window.Eureka = { I18N, currentLang, applyLang, refreshReveals };
  window.I18N = I18N;
  window.ICON = ICON;
  window.currentLang = currentLang;
  window._ = _;

  applyLang();
