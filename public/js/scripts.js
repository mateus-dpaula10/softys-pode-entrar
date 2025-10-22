const unidadeSelect = document.getElementById('unidade');
const diretoriaSelect = document.getElementById('diretoria');
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

    if (dir.includes('comercial') || uni === 'vila olímpia') {
        unidadeEscolhaDiv.classList.remove('d-none');
    } else {
        unidadeEscolhaDiv.classList.add('d-none');
        const selectInterno = unidadeEscolhaDiv.querySelector('select');
        if (selectInterno) selectInterno.value = '';
    }

    if (uni === 'caieiras') {
        transporteCaieirasDiv?.classList.remove('d-none');
    } else {
        transporteCaieirasDiv?.classList.add('d-none');
        const selectC = transporteCaieirasDiv?.querySelector('select');
        if (selectC) selectC.value = '';
    }

    if (uni === 'piraí') {
        transportePiraiDiv?.classList.remove('d-none');
    } else {
        transportePiraiDiv?.classList.add('d-none');
        if (transportePiraiSelect) transportePiraiSelect.value = '';
        rotasPiraiDiv?.classList.add('d-none');
        rotaPiraiSelect && (rotaPiraiSelect.value = '');
        rota1Detalhe?.classList.add('d-none');
        rota2Detalhe?.classList.add('d-none');
    }
}

unidadeSelect.addEventListener('change', toggleUnidadeEscolhaComercial);
diretoriaSelect.addEventListener('change', toggleUnidadeEscolhaComercial);

transportePiraiSelect?.addEventListener('change', function () {
    if (transportePiraiSelect.value === 'Fretado Softys') {
        rotasPiraiDiv.classList.remove('d-none');
    } else {
        rotasPiraiDiv.classList.add('d-none');
        rotaPiraiSelect && (rotaPiraiSelect.value = '');
        rota1Detalhe.classList.add('d-none');
        rota2Detalhe.classList.add('d-none');
    }
});

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
            autorizacao: card.querySelector(`[name="convidados[${index}][autorizacao]"]`)?.value || ''
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
                                <input type="text" class="form-control" name="convidados[${i}][rg]" value="${dados.rg || ''}" required>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="form-label">Grau de parentesco</label>
                            <select class="form-select parentesco" name="convidados[${i}][parentesco]" data-index="${i}" required>
                                <option value="">Selecione...</option>
                                <option value="filho(a)" ${dados.parentesco === 'filho(a)' ? 'selected' : ''}>Filho(a)</option>
                                <option value="cônjuge" ${dados.parentesco === 'cônjuge' ? 'selected' : ''}>Cônjuge</option>
                                <option value="responsável legal" ${dados.parentesco === 'responsável legal' ? 'selected' : ''}>Responsável legal</option>
                                <option value="outra pessoa de confiança" ${dados.parentesco === 'outra pessoa de confiança' ? 'selected' : ''}>Outra pessoa de confiança</option>
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

    if (!isNaN(dataNasc)) {
        const idade = calcIdade(dataNasc);
        
        if (idade >= 18) {
            parentescoSelect.innerHTML = `
                <option value="">Selecione...</option>
                <option value="filho(a)">Filho(a)</option>
                <option value="cônjuge">Cônjuge</option>
                <option value="responsável legal">Responsável legal</option>
                <option value="outra pessoa de confiança">Outra pessoa de confiança</option>
            `;
            
            if (!existingEmail) {
                extraDiv.insertAdjacentHTML('beforeend', `
                    <div class="mt-2" id="emailWrapper_${index}">
                        <label class="form-label">E-mail pessoal do convidado (maior de idade)</label>
                        <input type="email" class="form-control" name="convidados[${index}][email]" id="${emailFieldId}" placeholder="email@exemplo.com" required>
                    </div>
                `);
            }
        } else {
            if (existingEmail) existingEmail.closest('.mt-2').remove();
            parentescoSelect.innerHTML = `<option value="filho(a)" selected>Filho(a)</option>`;

            const existingAuth = document.getElementById(`autorizacao_${index}`);
            if (existingAuth) existingAuth.remove();
        }
        
        checkMaiorIdade();
    }
}

function handleParentescoChange(e) {
    const index = e.target.dataset.index;
    const extraDiv = document.getElementById(`extra_${index}`);
    const nomeInput = document.getElementById(`convidado_nome_${index}`);
    const existingAuth = document.getElementById(`autorizacao_${index}`);

    if (e.target.value === 'outra pessoa de confiança') {
        if (!existingAuth) {
            extraDiv.insertAdjacentHTML('beforeend', `
                <div class="mt-2" id="autorizacao_${index}">
                    <label class="form-label">Autorização</label>
                    <textarea class="form-control" rows="3" name="convidados[${index}][autorizacao]" readonly>
                        Autorizo ${nomeInput.value || '________________'} a acompanhar meu(s) dependente(s) menor(es) de idade no evento.
                    </textarea>
                </div>
            `);
        }
    } else {
        if (existingAuth) existingAuth.remove();
    }
}

function checkMaiorIdade() {
    const nascimentosInputs = document.querySelectorAll('.nascimento');
    let temMaior = false;
    let totalConvidados = nascimentosInputs.length;

    nascimentosInputs.forEach(input => {
        const index = input.dataset.index;
        const dataNasc = new Date(input.value);

        if (!isNaN(dataNasc)) {
            const idade = calcIdade(dataNasc);
            if (idade >= 18) temMaior = true;            
        }
    });

    const avisoMenor = document.getElementById('avisoMenor');

    if ((totalConvidados === 1 && !temMaior) || (totalConvidados > 1 && !temMaior)) {
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