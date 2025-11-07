AOS.init();

const inputTel = document.querySelectorAll('.maskTel');
const inputRG = document.querySelectorAll('.maskRG');

inputTel.forEach(i => {
    i.addEventListener('input', function (e) {
        let valor = e.target.value.replace(/\D/g, '');

        if (valor.length > 11) valor = valor.slice(0, 11);

        if (valor.length > 10) {
            valor = valor.replace(/^(\d{2})(\d{1})(\d{4})(\d{4})$/, '($1) $2 $3-$4');
        } else if (valor.length > 6) {
            valor = valor.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
        } else if (valor.length > 2) {
            valor = valor.replace(/^(\d{2})(\d{0,5})$/, '($1) $2');
        } else {
            valor = valor.replace(/^(\d*)$/, '($1');
        }

        e.target.value = valor;
    });

    i.addEventListener('blur', function (e) {
        const valor = e.target.value.replace(/\D/g, '');
        const erroMsgId = e.target.id + '_error';

        let msg = document.getElementById(erroMsgId);
        if (msg) msg.remove();

        if (valor.length < 10) {
            msg = document.createElement('div');
            msg.id = erroMsgId;
            msg.className = 'text-white small mt-1';
            msg.innerText = 'Por favor, insira um número de telefone válido com DDD.';
            e.target.parentNode.appendChild(msg);
            e.target.focus();
        }
    });
});

// formulario inscricoes colaboradores
const unidadeSelect = document.getElementById('unidade');
const diretoriaSelect = document.getElementById('diretoria');
const unidadeEscolhaDivVO = document.getElementById('unidadeEscolhaComercialVO');
const unidadeEscolhaDiv = document.getElementById('unidadeEscolhaComercial');
const transporteCaieirasDiv = document.getElementById('transporteCaieiras');
const transportePiraiDiv = document.getElementById('transportePirai');
const transportePiraiSelect = document.getElementById('transporte_pirai');
const rotasPiraiDiv = document.getElementById('rotasPirai');
const rotaPiraiSelect = rotasPiraiDiv?.querySelector('select');
const rota1Detalhe = document.getElementById('rota1Detalhe');
const rota2Detalhe = document.getElementById('rota2Detalhe');

function toggleUnidadeEscolhaComercial() {
    const dir = diretoriaSelect.value.toLowerCase();
    const uni = unidadeSelect.value.toLowerCase();

    unidadeEscolhaDiv?.classList.add('d-none');
    unidadeEscolhaDivVO?.classList.add('d-none');

    const selectInterno = unidadeEscolhaDiv?.querySelector('select');
    if (selectInterno) selectInterno.value = '';

    const selectCVO = unidadeEscolhaDivVO?.querySelector('select');
    if (selectCVO) selectCVO.value = '';

    const isComercial = dir.includes('comercial');
    const isVilaOlimpia = uni === 'vila olímpia';

    if (isComercial && isVilaOlimpia) {
        unidadeEscolhaDiv.classList.remove('d-none');
    } else if (isComercial) {
        unidadeEscolhaDiv.classList.remove('d-none');
    } else if (isVilaOlimpia) {
        unidadeEscolhaDivVO?.classList.remove('d-none');
    }

    if (uni === 'caieiras') {
        transporteCaieirasDiv?.classList.remove('d-none');
        const selectC = transporteCaieirasDiv?.querySelector('select');
        if (selectC) selectC.required = true;
    } else {
        transporteCaieirasDiv?.classList.add('d-none');
        const selectC = transporteCaieirasDiv?.querySelector('select');
        if (selectC) {
            selectC.required = false;
            selectC.value = '';
        } 
    }

    if (uni === 'piraí') {
        transportePiraiDiv?.classList.remove('d-none');
        if (transportePiraiSelect) {
            transportePiraiSelect.required = true;

            transportePiraiSelect.addEventListener('change', function () {
                if (transportePiraiSelect.value === 'Fretado Softys') {
                    rotasPiraiDiv.classList.remove('d-none');
                    if (rotaPiraiSelect) rotaPiraiSelect.required = true;
                } else {
                    rotasPiraiDiv.classList.add('d-none');
                    if (rotaPiraiSelect) {
                        rotaPiraiSelect.required = false;
                        rotaPiraiSelect.value = '';
                    }
                    rota1Detalhe.classList.add('d-none');
                    rota2Detalhe.classList.add('d-none');
                }
            });
        }
    } else {
        transportePiraiDiv?.classList.add('d-none');
        if (transportePiraiSelect) {
            transportePiraiSelect.required = false;
            transportePiraiSelect.value = '';
        } 
        rotasPiraiDiv?.classList.add('d-none');
        if (rotaPiraiSelect) {
            rotaPiraiSelect.required = false;
            rotaPiraiSelect.value = '';
        }
        rota1Detalhe?.classList.add('d-none');
        rota2Detalhe?.classList.add('d-none');
    }
}

unidadeSelect.addEventListener('change', toggleUnidadeEscolhaComercial);
diretoriaSelect.addEventListener('change', toggleUnidadeEscolhaComercial);

rotaPiraiSelect?.addEventListener('change', () => {
    rota1Detalhe.classList.add('d-none');
    rota2Detalhe.classList.add('d-none');

    if (rotaPiraiSelect.value.includes('Rota 1')) {
        rota1Detalhe.classList.remove('d-none');
    } else if (rotaPiraiSelect.value.includes('Rota 2')) {
        rota2Detalhe.classList.remove('d-none');
    }
});

const dependentesInput = document.getElementById('dependentes_qtd');
const convidadosSection = document.getElementById('convidadosSection');
const convidadosContainer = document.getElementById('convidadosContainer');
const avisoMenor = document.getElementById('avisoMenor');
const btnSubmitColaboradores = document.getElementById('submitColaboradores');

dependentesInput.addEventListener('input', function () {
    const qtd = parseInt(dependentesInput.value || 0);
    
    if (qtd <= 0) {
        avisoMenor.classList.remove('d-none'); 
        convidadosContainer.innerHTML = '';   
        convidadosSection.classList.add('d-none');
        return;
    }
    
    avisoMenor.classList.add('d-none');

    const dadosExistentes = [];
    document.querySelectorAll('.card').forEach((card, idx) => {
        const index = idx + 1;
        dadosExistentes[index] = {
            nome: card.querySelector(`[name="convidados[${index}][nome]"]`)?.value || '',
            nascimento: card.querySelector(`[name="convidados[${index}][nascimento]"]`)?.value || '',
            rg: card.querySelector(`[name="convidados[${index}][rg]"]`)?.value || '',
            parentesco: card.querySelector(`[name="convidados[${index}][parentesco]"]`)?.value || '',
            email: card.querySelector(`[name="convidados[${index}][email]"]`)?.value || '',
            aut_nome_responsavel: card.querySelector(`[name="convidados[${index}][aut_nome_responsavel]"]`)?.value || '',
            aut_cpf_responsavel: card.querySelector(`[name="convidados[${index}][aut_cpf_responsavel]"]`)?.value || '',
            aut_rg_responsavel: card.querySelector(`[name="convidados[${index}][aut_rg_responsavel]"]`)?.value || '',
            aut_nome_menor: card.querySelector(`[name="convidados[${index}][aut_nome_menor]"]`)?.value || '',
            aut_data_menor: card.querySelector(`[name="convidados[${index}][aut_data_menor]"]`)?.value || '',
            aut_nome_acomp: card.querySelector(`[name="convidados[${index}][aut_nome_acomp]"]`)?.value || '',
            aut_cpf_acomp: card.querySelector(`[name="convidados[${index}][aut_cpf_acomp]"]`)?.value || '',
            aut_rg_acomp: card.querySelector(`[name="convidados[${index}][aut_rg_acomp]"]`)?.value || '',
            aut_parentesco: card.querySelector(`[name="convidados[${index}][aut_parentesco]"]`)?.value || ''
        };
    });

    convidadosContainer.innerHTML = '';

    if (qtd > 0) {
        convidadosSection.classList.remove('d-none');

        for (let i = 1; i <= qtd && i <= 6; i++) {
            const dados = dadosExistentes[i] || {};
            convidadosContainer.insertAdjacentHTML('beforeend', `
                <div class="card mb-3">
                    <div class="card-body">
                        <h6>Convidado ${i}</h6>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="form-label">Nome completo</label>
                                <input type="text" class="form-control" name="convidados[${i}][nome]" id="convidado_nome_${i}" value="${dados.nome || ''}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Data de nascimento</label>
                                <input type="date" class="form-control nascimento" name="convidados[${i}][nascimento]" data-index="${i}" value="${dados.nascimento || ''}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">RG</label>
                                <input type="text" class="form-control maskRG" name="convidados[${i}][rg]" value="${dados.rg || ''}" required>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="form-label">Grau de parentesco</label>
                            <select class="form-select parentesco" name="convidados[${i}][parentesco]" data-index="${i}" required>
                                <option value="">Selecione...</option>
                                <option value="filho(a)" ${dados.parentesco === 'filho(a)' ? 'selected' : ''}>Filho(a)</option>
                                <option value="cônjuge" ${dados.parentesco === 'cônjuge' ? 'selected' : ''}>Cônjuge</option>
                                <option value="responsável legal" ${dados.parentesco === 'responsável legal' ? 'selected' : ''}>Responsável legal</option>
                                <option value="outra pessoa de confiança - (participação permitida apenas se for acompanhar filho(a) menor de idade)" ${dados.parentesco === 'outra pessoa de confiança - (participação permitida apenas se for acompanhar filho(a) menor de idade)' ? 'selected' : ''}>Outra pessoa de confiança - (participação permitida apenas se for acompanhar filho(a) menor de idade)</option>
                            </select>
                        </div>
                        <div class="extraFields mt-3" id="extra_${i}">
                            ${dados.email ? `<div class="mt-2" id="emailWrapper_${i}">
                                <label class="form-label">E-mail pessoal do convidado (maior de idade)</label>
                                <input type="email" class="form-control" name="convidados[${i}][email]" value="${dados.email}" required>
                            </div>` : ''}
                            ${dados.autorizacao ? `<div class="mt-2" id="autorizacao_${i}">
                                <label class="form-label">Autorização</label>
                                <textarea class="form-control" rows="3" name="convidados[${i}][autorizacao]" readonly>${dados.autorizacao}</textarea>
                            </div>` : ''}
                        </div>
                    </div>
                </div>
            `);
        }

        convidadosContainer.addEventListener('input', function (e) {
            if (e.target.classList.contains('maskRG')) {
                let valor = e.target.value.replace(/\D/g, '');

                if (valor.length > 9) valor = valor.slice(0, 9);

                if (valor.length > 5) {
                    valor = valor.replace(/^(\d{2})(\d{3})(\d{3})(\d{0,1})$/, '$1.$2.$3-$4');
                } else if (valor.length > 2) {
                    valor = valor.replace(/^(\d{2})(\d{0,3})$/, '$1.$2');
                }

                e.target.value = valor;
            }
        });

        document.querySelectorAll('.nascimento').forEach(input => {
            input.removeEventListener('change', handleBirthChange);
            input.addEventListener('change', handleBirthChange);
        });

        document.querySelectorAll('.parentesco').forEach(select => {
            select.removeEventListener('change', handleParentescoChange);
            select.addEventListener('change', handleParentescoChange);
        });

        checkMaiorIdade();
    } else {
        convidadosSection.classList.add('d-none');
    }
});

function calcIdade(dataNasc) {
    const hoje = new Date();
    let idade = hoje.getFullYear() - dataNasc.getFullYear();
    const m = hoje.getMonth() - dataNasc.getMonth();
    if (m < 0 || (m === 0 && hoje.getDate() < dataNasc.getDate())) idade--;
    return idade;
}

function handleBirthChange(e) {
    const index = e.target.dataset.index;
    const dataNasc = new Date(e.target.value);
    const parentescoSelect = document.querySelector(`select[name="convidados[${index}][parentesco]"]`);
    const extraDiv = document.getElementById(`extra_${index}`);
    const emailFieldId = `email_convidado_${index}`;
    const existingEmail = document.getElementById(emailFieldId);

    if (isNaN(dataNasc)) return;

    const idade = calcIdade(dataNasc);

    if (existingEmail) existingEmail.closest('.mt-2').remove();
    const existingAuth = document.getElementById(`autorizacao_${index}`);
    if (existingAuth) existingAuth.remove();    
    
    parentescoSelect.innerHTML = `<option value="">Selecione...</option>`;

    if (idade >= 18) {
        parentescoSelect.insertAdjacentHTML('beforeend', `
            <option value="cônjuge">Cônjuge</option>
            <option value="responsável legal">Responsável legal</option>
            <option value="outra pessoa de confiança - (participação permitida apenas se for acompanhar filho(a) menor de idade)">
                Outra pessoa de confiança - (participação permitida apenas se for acompanhar filho(a) menor de idade)
            </option>
        `);

        extraDiv.insertAdjacentHTML('beforeend', `
            <div class="mt-2" id="emailWrapper_${index}">
                <label class="form-label">E-mail pessoal do convidado (maior de idade)</label>
                <input type="email" class="form-control" name="convidados[${index}][email]" 
                    id="${emailFieldId}" placeholder="email@exemplo.com" required>
            </div>
        `);
    } else if (idade <= 15) {
        parentescoSelect.innerHTML = `<option value="filho(a)" selected>Filho(a)</option>`;
    } else {
        parentescoSelect.innerHTML = `<option value="">Idade entre 16 e 17 não permitida</option>`;
    }
    
    checkMaiorIdade();
}

function handleParentescoChange(e) {
    const index = e.target.dataset.index;
    const extraDiv = document.getElementById(`extra_${index}`);
    const nomeInput = document.getElementById(`convidado_nome_${index}`);
    const existingAuth = document.getElementById(`autorizacao_${index}`);
    const avisoNome = document.getElementById('avisoNome');

    avisoNome.classList.add('d-none');

    if (e.target.value === 'outra pessoa de confiança - (participação permitida apenas se for acompanhar filho(a) menor de idade)') {
        if (!nomeInput.value.trim()) {
            e.target.value = '';
            nomeInput.focus();
            avisoNome.classList.remove('d-none');
            return;
        }

        if (!existingAuth) {
            extraDiv.insertAdjacentHTML('beforeend', `
                <div class="mt-2" id="autorizacao_${index}">
                    <label class="form-label fw-semibold d-block mb-2">
                        Autorização de acompanhamento de menor
                    </label>
                    <div class="border rounded p-3 bg-light">
                        <p>
                            Eu, 
                            <input type="text" name="convidados[${index}][aut_nome_responsavel]" class="form-control d-inline w-auto" placeholder="Nome do responsável" required>,
                            portador(a) do CPF nº 
                            <input type="text" name="convidados[${index}][aut_cpf_responsavel]" class="form-control d-inline w-auto maskCPF" placeholder="000.000.000-00" required>
                            e RG nº 
                            <input type="text" name="convidados[${index}][aut_rg_responsavel]" class="form-control d-inline w-auto maskRG" placeholder="XXXXXXXXX" required>,
                            na qualidade de responsável legal pelo(a) menor 
                            <input type="text" name="convidados[${index}][aut_nome_menor]" class="form-control d-inline w-auto" placeholder="Nome do menor" required>,
                            nascido(a) em 
                            <input type="date" name="convidados[${index}][aut_data_menor]" class="form-control d-inline w-auto" required>,
                            autorizo que o(a) Sr.(a) 
                            <input type="text" name="convidados[${index}][aut_nome_acomp]" class="form-control d-inline w-auto" placeholder="Nome do acompanhante" required>,
                            portador(a) do CPF nº 
                            <input type="text" name="convidados[${index}][aut_cpf_acomp]" class="form-control d-inline w-auto maskCPF" placeholder="000.000.000-00" required>,
                            RG nº 
                            <input type="text" name="convidados[${index}][aut_rg_acomp]" class="form-control d-inline w-auto maskRG" placeholder="XXXXXXXXX" required>,
                            e que mantém a relação de 
                            <input type="text" name="convidados[${index}][aut_parentesco]" class="form-control d-inline w-auto" placeholder="Ex: tio, primo, amigo" required>,
                            acompanhe o menor durante o evento promovido pela empresa <strong>"Pode Entrar"</strong>.
                        </p>

                        <p class="mt-3 mb-1">Declaro estar ciente de que:</p>
                        <ol class="small mb-0">
                            <li>A responsabilidade pela conduta do menor permanece sob minha inteira responsabilidade;</li>
                            <li>O acompanhante designado deverá zelar pela segurança, bem-estar e cumprimento das regras do evento;</li>
                            <li>Em caso de qualquer situação que coloque em risco a integridade do menor ou de terceiros, a empresa poderá determinar a retirada imediata do participante, sem prejuízo de outras medidas cabíveis.</li>
                        </ol>
                    </div>
                </div>
            `);
        }
    } else {
        if (existingAuth) existingAuth.remove();
    }
}

function checkMaiorIdade() {
    const nascimentosInputs = document.querySelectorAll('.nascimento');
    const avisoMenor = document.getElementById('avisoMenor');
    const avisoMaiorQue15 = document.getElementById('avisoMaiorQue15');

    if (nascimentosInputs.length === 0) {
        avisoMenor.classList.add('d-none');
        avisoMaiorQue15.classList.add('d-none');
        btnSubmitColaboradores.disabled = false;
        return;
    }

    let temMaior = false;
    let temMaiorQue15 = false;
    let temAlgumPreenchido = false;

    nascimentosInputs.forEach(input => {
        if (input.value) {
            temAlgumPreenchido = true;

            const dataNasc = new Date(input.value);
            if (!isNaN(dataNasc)) {
                const idade = calcIdade(dataNasc);
                
                if (idade >= 18) temMaior = true;            
                if (idade > 15 && idade < 18) temMaiorQue15 = true;            
            }            
        }
    });

    if (temMaiorQue15) {
        avisoMaiorQue15.classList.remove('d-none');
        btnSubmitColaboradores.disabled = true;
        return;
    } else {
        avisoMaiorQue15.classList.add('d-none');
    }

    if (temAlgumPreenchido && !temMaior) {
        avisoMenor.classList.remove('d-none');
        btnSubmitColaboradores.disabled = true;
    } else {
        avisoMenor.classList.add('d-none');
        btnSubmitColaboradores.disabled = false;
    }
}

document.addEventListener('change', (e) => {
    if (e.target.classList.contains('nascimento') || e.target.classList.contains('parentesco')) {
        checkMaiorIdade();
    }
});

// tabs para formularios
const tabButtons = document.querySelectorAll('button[data-bs-toggle="tab"]');

tabButtons.forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('data-bs-target');
        const target = document.querySelector(targetId);
        
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        
        target.classList.add('active');
    });
});

// formulario inscricoes voluntarios
const unitSelect = document.getElementById('unitSelect');
const supportContainer = document.getElementById('supportUnitContainer');
const termsVoluntarios = document.getElementById('terms');
const btnSubmitVoluntarios = document.getElementById('submitVoluntarios');

unitSelect.addEventListener('change', function () {
    if (this.value === 'Vila Olímpia') {    
        supportContainer.classList.remove('d-none');
    } else {
        supportContainer.classList.add('d-none');
        supportContainer.querySelector('select').value = '';
    }
});

function checkedTermsVoluntarios() {
    if (termsVoluntarios.checked) {
        btnSubmitVoluntarios.disabled = false;
    } else {
        btnSubmitVoluntarios.disabled = true;
    }
}

document.addEventListener('DOMContentLoaded', checkedTermsVoluntarios);
termsVoluntarios.addEventListener('change', checkedTermsVoluntarios);