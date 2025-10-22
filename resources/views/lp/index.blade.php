@extends('main')

@section('title', 'Softys - Pode Entrar')

@section('content')
    <div id="about">
        <div class="element_about"></div>
        <div class="container">
            <div class="row justify-content-between align-items-center">
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
                        <img src="{{ asset('img/images/Mockup-02.jpg') }}" alt="Imagem com unidades, datas e horário" class="img-fluid">
                        <figcaption>Aqui entrará a imagem desenvolvida com unidades, datas e horário</figcaption>
                    </figure>
                    <legend></legend>
                </div>

                <div class="col-12 mt-5">
                    <div id="buttons_about">
                        <button class="btn btn-primary" data-bs-toggle="tab" data-bs-target="#form1">
                            Inscreva-se colaboradores
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="tab" data-bs-target="#form2">
                            Inscreva-se voluntários
                        </button>
                        <a href="/#faq" class="btn btn-primary">
                            Dúvidas
                        </a>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegulamento">
                            Regulamento
                        </button>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sucesso!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    @endif
    
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Erro!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    @endif
    
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Verifique os campos abaixo:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    @endif

                    <div class="tab-content" id="form1">
                        <h3>INSCRIÇÕES COLABORADORES</h3>
    
                        <form action="{{ route('inscricoes.colaboradores.store') }}" method="POST" id="forms_colaboradores">
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
                                <input type="text" class="form-control" name="telefone" required>
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
                                    <option value="Comercial Grandes Contas">Comercial Grandes Contas</option>
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
                                    <option value="Caieiras">Caieiras</option>
                                    <option value="Mogi das Cruzes">Mogi das Cruzes</option>
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
                                <div id="convidadosContainer"></div>
                            </div>
        
                            <div id="avisoMenor" class="alert alert-warning d-none mt-3">
                                Um dos convidados precisa ser maior de idade para acompanhar os dependentes.
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
                                <label class="form-label">Como será o seu deslocamento até a fábrica?</label>
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
                                            <h6 class="fw-bold">Rota 1 – Arrozal / Barra Mansa / Volta Redonda / Pinheiral</h6>
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
                                            <h6 class="fw-bold">Rota 2 – Barra do Piraí / Centro de Eventos Tutucão</h6>
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
                                                <li>Rodoviária de Piraí</li>
                                                <li>Rua Saldanha Marinho, 87 – Próximo à passarela Jaqueira</li>
                                                <li>Rodovia Presidente Dutra – Restaurante</li>
                                                <li>Rodovia Presidente Dutra – Ponto próximo à torre</li>
                                                <li>Rua Tulipas – Bifurcação com Rua Eugênio</li>
                                                <li>Piraí – Centro de Eventos de Piraí</li>
                                                <li>Rua Vista Alegre – Brizolão - Casa Amarela</li>
                                                <li>Rodoviária de Piraí (retorno)</li>
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
    
                        <form action="{{ route('inscricoes.colaboradores.store') }}" method="POST" id="forms_colaboradores">
                            @csrf
        
                            <h4 class="mt-4">Seção 3 - Dados do Colaborador</h4>
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
                                <input type="text" class="form-control" name="telefone" required>
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
                                    <option value="Comercial Grandes Contas">Comercial Grandes Contas</option>
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
                                    <option value="Caieiras">Caieiras</option>
                                    <option value="Mogi das Cruzes">Mogi das Cruzes</option>
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
                                <div id="convidadosContainer"></div>
                            </div>
        
                            <div id="avisoMenor" class="alert alert-warning d-none mt-3">
                                Um dos convidados precisa ser maior de idade para acompanhar os dependentes.
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
                                <label class="form-label">Como será o seu deslocamento até a fábrica?</label>
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
                                            <h6 class="fw-bold">Rota 1 – Arrozal / Barra Mansa / Volta Redonda / Pinheiral</h6>
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
                                            <h6 class="fw-bold">Rota 2 – Barra do Piraí / Centro de Eventos Tutucão</h6>
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
                                                <li>Rodoviária de Piraí</li>
                                                <li>Rua Saldanha Marinho, 87 – Próximo à passarela Jaqueira</li>
                                                <li>Rodovia Presidente Dutra – Restaurante</li>
                                                <li>Rodovia Presidente Dutra – Ponto próximo à torre</li>
                                                <li>Rua Tulipas – Bifurcação com Rua Eugênio</li>
                                                <li>Piraí – Centro de Eventos de Piraí</li>
                                                <li>Rua Vista Alegre – Brizolão - Casa Amarela</li>
                                                <li>Rodoviária de Piraí (retorno)</li>
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
                </div>            

                <div class="modal fade" id="modalRegulamento" tabindex="-1" aria-labelledby="modalRegulamentoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalRegulamentoLabel">Regulamento</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>1. Público-Alvo</h6>
                                <p>O evento é exclusivo para cônjuges e filhos de colaboradores da Softys, com idade entre 5 e 15 anos.</p>

                                <h6>2. Inscrição</h6>
                                <p>A participação no evento depende de inscrição prévia obrigatória por meio do hotsite oficial.</p>

                                <h6>3. Vestuário</h6>
                                <p>É obrigatório o uso de calça, sapato fechado e camiseta/blusa que cubra os ombros.</p>

                                <h6>4. Local e Conduta</h6>
                                <p>O evento será realizado nas instalações das plantas da Softys. Todos os participantes devem seguir rigorosamente as orientações de segurança e conduta fornecidas pela organização.</p>

                                <h6>5. Alterações na Programação</h6>
                                <p>A Softys reserva-se o direito de alterar a programação do evento, caso necessário, garantindo sempre o bem-estar e a segurança de todos os participantes.</p>

                                <h6>Termos de Consentimento</h6>
                                <ul>
                                    <li>Autorizo a empresa SOFTYS BRASIL LTDA, inscrita no CNPJ sob o n.º 44.145.845/0001-40, com sede na Rua Chedid Jafet, nº 222, conj. 11, Bloco C, 1º andar, Vila Olímpia, CEP 04551-065, São Paulo/SP (“Softys”), a utilizar os meus dados pessoais, incluindo nome, minha imagem, voz ou outros na ação "Pode entrar".</li>
                                    <li>Entendo que este consentimento é fornecido a título gratuito, isto é, não receberei qualquer pagamento, compensação ou outro tipo de remuneração.</li>
                                    <li>Concordo com o fato de que a Softys pode, a partir de agora ou a qualquer momento no futuro, retocar ou editar a Gravação, conforme necessário e a seu exclusivo critério.</li>
                                    <li>Entendo que a Gravação e o Material poderão ser lançados publicamente por meio do Facebook, Instagram, YouTube, LinkedIn, TV e outras mídias digitais, após o qual a Softys não será responsável pelo gerenciamento ou uso posterior, sobre os quais não detém poder de ingerência.</li>
                                    <li>Se você tiver qualquer dúvida ou solicitação em relação a este Termo de Consentimento, entre em contato com: <a href="mailto:juridico.brasil@softys.com">juridico.brasil@softys.com</a> e <a href="mailto:dpo.brasil@softys.com">dpo.brasil@softys.com</a></li>
                                    <li>No caso de ausência do responsável legal, o menor de idade será acompanhado por uma pessoa maior de idade, previamente autorizada pelos responsáveis legais. Os pais ou responsáveis legais declaram estar cientes e de acordo que qualquer incidente ou dano envolvendo o menor de idade será de integral responsabilidade dos próprios responsáveis legais e/ou do acompanhante autorizado. A Softys isenta-se de qualquer responsabilidade por danos, incidentes ou ocorrências que envolvam o menor de idade, tanto durante o acompanhamento por terceiros quanto durante a participação no programa.</li>
                                    <li>Por meio do presente instrumento, renuncio a qualquer direito de inspecionar ou aprovar a Gravação antes de seu uso.</li>
                                    <li>Concordo que a Gravação, bem como quaisquer fotografias, gravações de vídeo ou áudio criadas a partir da Gravação, devem permanecer como propriedade exclusiva da Softys.</li>
                                    <li>Compreendi que o Material objeto do presente formulário não envolverá conteúdo prejudicial, vexatório, ofensivo, danoso ou que de qualquer forma viole os direitos do(a) menor.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="faq">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>FAQ</h1>
                    <p>
                        Tem alguma dúvida? A gente te ajuda!
                    </p>
            
                    <h6 class="mt-5">Perguntas Frequentes - Pode Entrar</h6>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection