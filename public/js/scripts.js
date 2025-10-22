const unidadeSelect = document.getElementById('colaborador_unidade');
const diretoriaSelect = document.getElementById('colaborador_diretoria');
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
        rotaPiraiSelect && (rotasPiraiSelectq.value = '');
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