@extends('main')

@section('title', 'Softys - Pode Entrar')

@section('content')
    <div id="about">
        <div class="container">
            <div class="row justify-content-between align-items-center" data-aos="fade-up" data-aos-duration="3000">
                <div class="col-12 col-lg-4">
                    <h1>Quem pode participar?</h1>
                    <p>
                        Cônjuges e filhos de 5 a 15 anos cadastrados no RH, sendo que: 
                    </p>
                    <ul>
                        <li>
                            Colaboradores das áreas Comerciais e os que atuam na Vila Olímpia poderão escolher a unidade mais próxima de suas 
                            residências para participar;
                        </li>
                        <li>
                            Para filhos que não forem acompanhados pelo responsável legal, durante a inscrição, você pode indicar uma pessoa de 
                            sua confiança que seja maior de idade para acompanhá-los. 
                        </li>
                    </ul>                        
                </div>

                <div class="col-12 col-lg-7 mt-3 mt-lg-0">
                    <figure>
                        <img src="{{ asset('img/images/Criativo-Hotsite.png') }}" alt="Imagem com unidades, datas e horário" class="img-fluid">
                    </figure>
                </div>

                <div class="col-12 mt-5">
                    <div id="buttons_about">
                        <h4>Selecione a opção desejada abaixo</h4>
                        <div>
                            <button class="btn btn-primary" data-bs-toggle="tab" data-bs-target="#form1">
                                Inscrição para colaboradores
                            </button>
                            <button class="btn btn-primary" data-bs-toggle="tab" data-bs-target="#form2">
                                Inscrição para voluntários
                            </button>
                            <a href="#faq" class="btn btn-primary">
                                Perguntas Frequentes
                            </a>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegulamento">
                                Regulamento
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <div class="tab-content" id="form1">
                        <h3>INSCRIÇÕES COLABORADORES</h3>
    
                        <form action="{{ route('inscricoes.colaboradores.storeColab') }}" method="POST" id="forms_colaboradores">
                            @csrf
        
                            <h4 class="mt-4">Seção 1 - Dados do Colaborador</h4>
                            <div class="mb-3">
                                <label class="form-label">Nome completo do colaborador</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label">E-mail corporativo (se tiver)</label>
                                <input type="email" class="form-control" name="email">
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label">Telefone para contato com DDD</label>
                                <input type="text" class="form-control maskTel" name="telefone" maxlength="15" required>
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label">Qual a sua unidade de trabalho?</label>
                                <select class="form-select" name="unidade" id="unidade" required>
                                    <option value="">Selecione...</option>
                                    <option value="Anápolis">Anápolis</option>
                                    <option value="Caieiras">Caieiras</option>
                                    <option value="Mogi das Cruzes">Mogi das Cruzes</option>
                                    <option value="Piraí">Piraí</option>
                                    <option value="Vila Olímpia">Vila Olímpia</option>
                                </select>
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label">Qual a sua diretoria?</label>
                                <select class="form-select" name="diretoria" id="diretoria" required>
                                    <option value="">Selecione...</option>
                                    <option value="Comercial Professional">Comercial Professional</option>
                                    <option value="Comercial Varejo">Comercial Varejo</option>
                                    <option value="Comercial Negócios Emergentes">Comercial Negócios Emergentes</option>
                                    <option value="P&O">P&O</option>
                                    <option value="Jurídico">Jurídico</option>
                                    <option value="Financeiro, Adm. e TI">Financeiro, Adm. e TI</option>
                                    <option value="Operações">Operações</option>
                                    <option value="Supply Chain">Supply Chain</option>
                                </select>
                            </div>
        
                            <div id="unidadeEscolhaComercial" class="mb-3 d-none">
                                <p>
                                    Você, colaborador(a) do Comercial ou da Vila Olímpia, tem a oportunidade de inscrever seus dependentes para 
                                    participar do evento na fábrica mais próxima de sua residência.    
                                </p>
                                <p class="fw-semibold">
                                    Atenção! O deslocamento é de responsabilidade do próprio colaborador. 
                                </p>
                                <label class="form-label">Qual unidade você escolhe?</label>
                                <select class="form-select" name="unidade_escolha_comercial">
                                    <option value="">Selecione...</option>
                                    <option value="Anápolis">Anápolis</option>
                                    <option value="Caieiras">Caieiras</option>
                                    <option value="Mogi das Cruzes">Mogi das Cruzes</option>
                                    <option value="Piraí">Piraí</option>
                                </select>
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label">
                                    Qual a quantidade de dependentes que participará do evento? *Dependentes entende-se filhos, acompanhantes ou familiares.    
                                </label>
                                <input type="number" class="form-control" name="dependentes_qtd" id="dependentes_qtd" min="0" max="6">
                            </div>
        
                            <div id="convidadosSection" class="d-none">
                                <h4 class="mt-5">Seção 2 - Identifique os Convidados</h4>

                                <div id="avisoMenor" class="alert alert-warning d-none mt-3">
                                    Um dos convidados precisa ser maior de idade para acompanhar os dependentes.
                                </div>
    
                                <div id="avisoNome" class="alert alert-danger d-none mt-3">
                                    Preencha o nome do convidado antes de selecionar "Outra pessoa de confiança".
                                </div>

                                <div id="avisoMaiorQue15" class="alert alert-danger d-none mt-3">
                                    Filhos(as) com mais de 15 anos não podem ser cadastrados(as) para este evento.
                                </div>

                                <div id="convidadosContainer"></div>
                            </div>        
        
                            <div id="transporteCaieiras" class="d-none mt-4">
                                <h5>Deslocamento - Caieiras</h5>
                                <label class="form-label">Como será o seu deslocamento até a fábrica?</label>
                                <select class="form-select" name="transporte_caieiras">
                                    <option value="">Selecione...</option>
                                    <option value="Transporte público">Transporte público</option>
                                    <option value="Veículo próprio">Veículo próprio</option>
                                </select>
                            </div>
        
                            <div id="transportePirai" class="d-none mt-4">
                                <h5>Deslocamento - Piraí</h5>
                                <label class="form-label">Como será o seu deslocamento até a fábrica? *Isso nos ajuda a organizar melhor a recepção e o transporte, caso necessário.</label>
                                <select class="form-select" name="transporte_pirai" id="transporte_pirai">
                                    <option value="">Selecione...</option>
                                    <option value="Transporte público">Transporte público</option>
                                    <option value="Veículo próprio">Veículo próprio</option>
                                    <option value="Fretado Softys">Fretado Softys</option>
                                </select>
        
                                <div id="rotasPirai" class="d-none mt-3">
                                    <label class="form-label">Escolha uma das opções de linhas disponíveis:</label>
                                    <select class="form-select" name="rota_pirai">
                                        <option value="">Selecione...</option>
                                        <option value="Rota 1 - Arrozal / Barra Mansa / Volta Redonda / Pinheiral">Rota 1 – Arrozal / Barra Mansa / Volta Redonda / Pinheiral</option>
                                        <option value="Rota 2 - Barra do Piraí / Centro de Eventos Tutucão">Rota 2 – Barra do Piraí / Centro de Eventos Tutucão</option>
                                    </select>
        
                                    <div id="rota1Detalhe" class="card d-none mb-3">
                                        <div class="card-body">
                                            <p><strong>Nome da Linha:</strong> Arrozal e BARRA MANSA X VOLTA REDONDA X PINHEIRAL X SOFTYS</p>
                                            <p><strong>Pontos de parada:</strong></p>
                                            <ul class="small">
                                                <li>Rua Sebastião Dias da Rocha – Embarque no Ginásio Poliesportivo</li>
                                                <li>Rua Cl. Ribeiro Sobrinho – Embarque próximo à casa nº 145</li>
                                                <li>Arrozal – Embarque na Praça</li>
                                                <li>Rua Professora Amália – Embarque em frente ao muro laranja (casa nº 124)</li>
                                                <li>Barra Mansa – Rodoviária de Barra Mansa</li>
                                                <li>Av. Dário Aragão – Ponto proximidades Linha Férrea</li>
                                                <li>Rua Dom Pedro II – Casarão de Construção</li>
                                                <li>Rodoviária de Volta Redonda – Ponto na BR-393</li>
                                                <li>Av. Getúlio Vargas – Ponto Posto JK</li>
                                                <li>Rodovia Lúcio Meira – Ponto próximo à loja de piscinas</li>
                                                <li>Pinheiral – Ponto no parque</li>
                                                <li>Rodovia Lúcio Meira – Ponto próximo ao UniFOA</li>
                                            </ul>
                                        </div>
                                    </div>
        
                                    <div id="rota2Detalhe" class="card d-none">
                                        <div class="card-body">
                                            <p><strong>Nome da Linha:</strong> Barra do Piraí e CENTRO DE EVENTOS TUTUCÃO</p>
                                            <p><strong>Pontos de parada:</strong></p>
                                            <ul class="small">
                                                <li>Praça Nilo Peçanha – Em frente à Igreja São Benedito</li>
                                                <li>Rua Aurelínio Garcia – Ponto Segurança Presente</li>
                                                <li>Av. Prefeito Arthur Costa – Em frente à Loja OZ Jeans</li>
                                                <li>Rua Paulo Fernandes – Em frente à Quadra Maracanã</li>
                                                <li>Av. Miguel Couto Filho – Próximo à Igreja A.A. Grupo Independência</li>
                                                <li>RJ-145 – Ao lado da Styrotec</li>
                                                <li>RJ-146 – Ponto da Casa Amarela</li>
                                                <li>Piraí – Próximo ao Centro de Eventos Tutucão</li>
                                                <li>Rua Bulhões de Carvalho – Lado Sacolão e Mercearia</li>
                                                <li>Pirá - Rodoviária Piraí</li>
                                                <li>Rua Saldanha Marinho, 87 – Ponto proximidades da placa de sinalização/Passarela Jaqueira</li>
                                                <li>Rodovia Presidente Dutra – Restaurante</li>
                                                <li>Rodovia Presidente Dutra – Ponto próximo à torre</li>
                                                <li>Rua Vista Alegre - Brizolão - Casa Amarela</li>
                                                <li>Rua Bulhões de Carvalho - Rodoviaria de Pirai</li>
                                                <li>Rua Saldanha Marinho, 87 - Ponto proximidades da placa de sinalização/Passarela Jaqueira</li>
                                                <li>Rodovia Presidente Dutra – Restaurante (retorno)</li>
                                                <li>Rodovia Presidente Dutra – Ponto próximo à torre</li>
                                                <li>Rua Tulipas – Bifurcação com Rua Eugênio</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitColaboradores">Enviar Inscrição</button>
                            </div>
                        </form>
                    </div>
                
                    <div class="tab-content" id="form2">
                        <h3>INSCRIÇÕES VOLUNTÁRIOS</h3>

                        <h4 class="mt-4 fw-semibold">
                            Quer ser voluntário do Pode Entrar - Celebrações que aproximam?
                        </h4>

                        <p>
                            O evento dará oportunidade dos colaboradores trazerem seus familiares para conhecer as nossas fábricas em uma experiência única.
                            Como voluntário, você será fundamental para garantir que o evento ocorra de maneira organizada e que os visitantes se sintam bem acolhidos.
                        </p>
    
                        <form action="{{ route('inscricoes.colaboradores.storeVolun') }}" method="POST" id="forms_voluntarios">
                            @csrf
        
                            <div class="mb-3">
                                <label class="form-label">Nome completo:</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">E-mail corporativo:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Telefone para contato:</label>
                                <input type="text" name="phone" class="form-control maskTel" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tamanho de camiseta:</label>
                                <select name="shirt_size" class="form-select" required>
                                    <option value="">Selecione...</option>
                                    <option value="P">P</option>
                                    <option value="M">M</option>
                                    <option value="G">G</option>
                                    <option value="GG">GG</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Qual sua unidade?</label>
                                <select name="unit" id="unitSelect" class="form-select" required>
                                    <option value="">Selecione...</option>
                                    <option value="Anápolis">Anápolis</option>
                                    <option value="Caieiras">Caieiras</option>
                                    <option value="Mogi das Cruzes">Mogi das Cruzes</option>
                                    <option value="Piraí">Piraí</option>
                                    <option value="Vila Olímpia">Vila Olímpia</option>
                                </select>
                            </div>

                            <div class="mb-3 d-none" id="supportUnitContainer">
                                <label class="form-label">
                                    Indique a unidade que gostaria de se voluntariar:
                                </label>
                                <select name="support_unit" class="form-select">
                                    <option value="">Selecione...</option>
                                    <option value="Mogi das Cruzes">Prefiro Mogi</option>
                                    <option value="Caieiras">Prefiro Caieiras</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Termo de Compromisso</label>
                                <div class="border rounded p-3 bg-light small text-black">
                                    <p>(I) Aceito expressamente o processamento de meus dados pessoais obtidos através da presente inscrição, para que a Softys possa gerir todas as atividades relacionadas com o programa Pode Entrar. Da mesma forma, aceito expressamente a cessão e processamento de minha imagem contida nas fotografias ou vídeos que forem registrados no desenvolvimento do programa.</p>
                                    <p class="mb-0">(II) Comprometo-me a seguir os horários e atividades designadas.</p>
                                </div>

                                <div class="form-check mt-2">
                                    <input type="checkbox" name="terms_accepted" id="terms" class="form-check-input" required>
                                    <label for="terms" class="form-check-label">Li, entendi e aceito</label>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitVoluntarios">Enviar Inscrição</button>
                            </div>
                        </form>
                    </div>
                </div>   
            </div>
        </div>
    </div>

    <div id="faq">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="zoom-in" data-aos-duration="3000">
                    <h1>PERGUNTAS FREQUENTES</h1>
                    <p>
                        Tem alguma dúvida? A gente te ajuda!
                    </p>
            
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Quem pode participar?
                                </button>
                                </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Cônjuges e filhos entre 5 e 15 anos, desde que previamente cadastrados no RH.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    E se eu não tiver filhos, posso inscrever outro familiar?
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    O evento é destinado para cônjuges e filhos, e você só pode inscrever um familiar com outro tipo de parentesco se este for acompanhar filhos menores de idade.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Preciso confirmar presença?
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Sim! A inscrição é obrigatória para garantir o acesso de seus convidados à planta. 
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    Há alguma orientação sobre a vestimenta?
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Sim. Por segurança, é obrigatório o uso de calça (ex: jeans), tênis e camiseta ou blusa que cubram os ombros nas dependências de nossas fábricas.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    O que está incluso na programação do evento?
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Os convidados poderão desfrutar de uma programação especial com direito à visita guiada na fábrica, oficinas criativas e recreações na temática de celebrações de fim de ano.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                    Haverá alimentação no evento?
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Sim. Durante o evento, haverá diferentes opções para refeição dos participantes.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                    Onde os visitantes devem se apresentar ao chegar?
                                </button>
                            </h2>
                            <div id="flush-collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Haverá um ponto de credenciamento e os convidados podem se dirigir à portaria da fábrica para receber orientações da equipe no dia do evento.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                                    Haverá monitores ou equipe de apoio no local?
                                </button>
                            </h2>
                            <div id="flush-collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Sim. Uma equipe de apoio e monitores estará presente para ajudar nas atividades e garantir a segurança e um dia memorável aos convidados..
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                                    Posso contribuir como voluntário no evento?
                                </button>
                            </h2>
                            <div id="flush-collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Sim, acesse a página de voluntariado aqui no site e preencha o formulário para fazer sua inscrição.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                                    Posso contribuir como voluntário no evento?
                                </button>
                            </h2>
                            <div id="flush-collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Sim, acesse a página de voluntariado aqui no site e preencha o formulário para fazer sua inscrição.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEleven" aria-expanded="false" aria-controls="flush-collapseEleven">
                                    Haverá estacionamento no local?
                                </button>
                            </h2>
                            <div id="flush-collapseEleven" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Sim. Teremos um espaço reservado para estacionamento dos visitantes. Nossa equipe estará disponível para orientar na chegada.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwelve" aria-expanded="false" aria-controls="flush-collapseTwelve">
                                    E se eu ainda tiver alguma dúvida?
                                </button>
                            </h2>
                            <div id="flush-collapseTwelve" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    É só procurar o BP da sua unidade, que poderá te orientar. 
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThirty" aria-expanded="false" aria-controls="flush-collapseThirty">
                                    Os colaboradores poderão participar do evento?
                                </button>
                            </h2>
                            <div id="flush-collapseThirty" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    O colaborador só pode acompanhar o menor de idade, caso estiver de férias ou folga.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRegulamento" tabindex="-1" aria-labelledby="modalRegulamentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="modalRegulamentoLabel">Regulamento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <h6>1. Datas</h6>
                        <p>
                            O evento Pode Entrar 2025 acontecerá nas seguintes datas: 
                            25 de novembro na fábrica de Piraí, 
                            02 de dezembro na fábrica de Anápolis, 
                            04 de dezembro na fábrica de Mogi das Cruzes e 
                            12 de dezembro na fábrica de Caieiras.
                        </p>

                        <h6>2. Público-Alvo</h6>
                        <p>
                            O evento é exclusivo para cônjuges e filhos de colaboradores da Softys. 
                            Para participação de filhos, será limitado ao público com idade entre 5 e 15 anos, sendo que:
                        </p>
                        <ul>
                            <li>Colaboradores das áreas Comerciais e colaboradores que atuam na Vila Olímpia poderão escolher a unidade mais próxima de suas residências para participar;</li>
                            <li>Para filhos que não forem acompanhados pelo responsável legal, durante a inscrição, você pode indicar uma pessoa de sua confiança que seja maior de idade para acompanhá-los.</li>
                        </ul>

                        <h6>3. Inscrição</h6>
                        <p>A participação no evento depende de inscrição prévia obrigatória por meio do hotsite oficial.</p>

                        <h6>4. Vestuário</h6>
                        <p>É obrigatório o uso de calça, sapato fechado e camiseta/blusa que cubra os ombros.</p>

                        <h6>5. Local e Conduta</h6>
                        <p>
                            O evento será realizado nas instalações das plantas da Softys. 
                            Todos os participantes devem seguir rigorosamente as orientações de segurança e conduta fornecidas pela organização.
                        </p>

                        <h6>6. Alterações na Programação</h6>
                        <p>
                            A Softys reserva-se o direito de alterar a programação do evento, caso necessário, garantindo sempre o bem-estar e a segurança de todos os participantes.
                        </p>

                        <h6>Termos de Consentimento</h6>
                        <ul>
                            <li>(i) AUTORIZO a empresa SOFTYS BRASIL LTDA, inscrita no CNPJ sob o n.º 44.145.845/0001-40, com sede na Rua Chedid Jafet, nº 222, conj. 11, Bloco C, 1º andar, Vila Olímpia, CEP 04551-065, São Paulo/ SP (“Softys”), a utilizar os meus dados pessoais, incluindo nome, minha imagem, voz ou outros na ação "Pode entrar".</li>
                            <li>(ii) Entendo que este consentimento é fornecido a título gratuito, isto é, não receberei qualquer pagamento, compensação ou outro tipo de remuneração.</li>
                            <li>(iii) Concordo com o fato de que a Softys pode, a partir de agora ou a qualquer momento no futuro, retocar ou editar a Gravação, conforme necessário e a seu exclusivo critério.</li>
                            <li>(iv) Entendo que a Gravação e o Material poderão ser lançados publicamente por meio do Facebook, Instagram, YouTube, LinkedIn, TV e outras mídias digitais após a publicação, sobre os quais a Softys não detém poder de ingerência.</li>
                            <li>(v) Se você tiver qualquer dúvida ou solicitação em relação a este Termo de Consentimento, entre em contato com: <a href="mailto:juridico.brasil@softys.com">juridico.brasil@softys.com</a> e <a href="mailto:dpo.brasil@softys.com">dpo.brasil@softys.com</a>.</li>
                            <li>(vi) No caso de ausência do responsável legal, o menor de idade será acompanhado por uma pessoa maior de idade, previamente autorizada pelos responsáveis legais. Os pais ou responsáveis legais declaram estar cientes e de acordo que qualquer incidente ou dano envolvendo o menor de idade será de integral responsabilidade dos próprios responsáveis legais e/ou do acompanhante autorizado. A Softys isenta-se de qualquer responsabilidade por danos, incidentes ou ocorrências que envolvam o menor de idade, tanto durante o acompanhamento por terceiros quanto durante a participação no programa.</li>
                            <li>(vii) Entendo que a Gravação e o Material poderão ser lançados publicamente por meio das mídias citadas, sobre os quais a Softys não será responsável pelo gerenciamento ou uso posterior.</li>
                            <li>(viii) Por meio do presente instrumento, renuncio a qualquer direito de inspecionar ou aprovar a Gravação antes de seu uso.</li>
                            <li>(ix) Concordo que a Gravação, bem como quaisquer fotografias, gravações de vídeo ou áudio criadas a partir da Gravação, devem permanecer como propriedade exclusiva da Softys.</li>
                            <li>(x) Compreendi que o Material objeto do presente formulário não envolverá conteúdo prejudicial, vexatório, ofensivo, danoso ou que de qualquer forma viole os direitos do(a) menor.</li>
                        </ul>

                        <h6>Responsabilidade dos pais ou responsáveis</h6>
                        <p>
                            É importante reforçar que os pais ou responsáveis legais são inteiramente responsáveis pela conduta de seus filhos durante o passeio. Espera-se que garantam o cumprimento integral das orientações e regras de segurança estabelecidas pela empresa.
                        </p>
                        <p>
                            Qualquer comportamento que coloque em risco a integridade física de alguém ou o bom andamento da visita será comunicado imediatamente. 
                            Caso situações de risco ou desrespeito às normas se repitam, o colaborador e seu(s) dependente(s) poderão ser convidados a encerrar a participação na atividade, uma vez que a segurança é um valor inegociável para a empresa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="successModalLabel">Inscrição Confirmada</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">🎉 <strong>SUA INSCRIÇÃO ESTÁ CONFIRMADA NO PODE ENTRAR!</strong></p>
                    <p>Em breve você receberá orientações sobre o evento.</p>
                    <p class="mt-3 small text-muted">
                        Posteriormente, você receberá via e-mail um documento pelo <strong>DocuSign</strong> para preencher a autorização de uso de imagem dos menores de idade.  
                        Os acompanhantes maiores de idade também receberão o documento em seus e-mails pessoais para assinatura.  
                        Isso condiciona a autorização de acesso ao evento.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModalVolun" tabindex="-1" aria-labelledby="successModalVolunLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="successModalVolunLabel">Inscrição Confirmada</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">🎉 <strong>SUA INSCRIÇÃO ESTÁ CONFIRMADA NO PODE ENTRAR!</strong></p>
                    <p>Em breve você receberá orientações sobre o evento.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="limitModal" tabindex="-1" aria-labelledby="limitModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="limitModalLabel">Vagas Esgotadas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">🙏 Agradecemos o seu interesse em participar deste momento tão especial!</p>
                    <p>As vagas para esta edição já foram preenchidas, pois o evento tem capacidade limitada para garantir o conforto e a segurança de todos os participantes.</p>
                    <p class="mt-3 fw-semibold">Esperamos sua inscrição na edição do <strong>Pode Entrar 2026!</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="limitModalVolun" tabindex="-1" aria-labelledby="limitModalVolunLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="limitModalVolunLabel">Inscrições Encerradas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">
                        Agradecemos o seu interesse em participar deste momento tão especial.
                    </p>
                    <p class="fw-semibold">
                        No entanto, as vagas para voluntários desta edição já foram preenchidas.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="validationModalLabel">Erros de validação</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        @if(session('success'))
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif

        @if(session('successVolun'))
            const successModalVolun = new bootstrap.Modal(document.getElementById('successModalVolun'));
            successModalVolun.show();
        @endif

        @if($errors->has('unidade') && $errors->count() == 1)
            const limitModal = new bootstrap.Modal(document.getElementById('limitModal'));
            limitModal.show();
        @elseif($errors->any() && !$errors->has('unidade'))
            const validationModal = new bootstrap.Modal(document.getElementById('validationModal'));
            validationModal.show();
        @endif

        @if($errors->has('unit') && $errors->count() == 1)
            const limitModalVolun = new bootstrap.Modal(document.getElementById('limitModalVolun'));
            limitModalVolun.show();
        @elseif($errors->any() && !$errors->has('unit'))
            const validationModal = new bootstrap.Modal(document.getElementById('validationModal'));
            validationModal.show();
        @endif

        const form = document.getElementById('forms_colaboradores');
        const modalRegulamentoEl = document.getElementById('modalRegulamento');
        const modalRegulamento = new bootstrap.Modal(modalRegulamentoEl)

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let modalFooter = modalRegulamentoEl.querySelector('.modal-footer');
            if (!modalFooter) {
                modalFooter = document.createElement('div');
                modalFooter.classList.add('modal-footer');

                modalFooter.innerHTML = `
                    <div class="me-auto text-start">
                        <small class="text-muted">
                            Por favor, leia o regulamento acima e confirme que está ciente antes de prosseguir.
                        </small>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnConfirmarModal">Confirmar</button>
                `;

                modalRegulamentoEl.querySelector('.modal-content').appendChild(modalFooter);

                modalFooter.querySelector('#btnConfirmarModal').addEventListener('click', () => {
                    modalRegulamento.hide();
                    form.submit();
                });
            }

            modalRegulamento.show();
        });
    </script>
@endpush