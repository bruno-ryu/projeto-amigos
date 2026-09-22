// js/script.js — Validações e interações do cliente

// Confirmação de exclusão
function confirmarExclusao(nome) {
    return confirm(`Tem certeza de que deseja excluir o amigo "${nome}"?\nEsta ação não pode ser desfeita.`);
}

// Validação do formulário de amigo
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-amigo');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        let valido = true;
        let mensagens = [];

        const nome = form.querySelector('#nome').value.trim();
        const sobrenome = form.querySelector('#sobrenome').value.trim();
        const email = form.querySelector('#email').value.trim();

        if (nome === '') { valido = false; mensagens.push('O nome é obrigatório.'); }
        if (sobrenome === '') { valido = false; mensagens.push('O sobrenome é obrigatório.'); }
        if (email === '') {
            valido = false; mensagens.push('O e-mail é obrigatório.');
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            valido = false; mensagens.push('Informe um e-mail válido.');
        }

        // Validação da data de nascimento (não pode ser futura)
        const dataInput = form.querySelector('#data_nascimento');
        if (dataInput && dataInput.value) {
            const data = new Date(dataInput.value + 'T00:00:00');
            const hoje = new Date();
            hoje.setHours(0, 0, 0, 0);
            if (data > hoje) {
                valido = false;
                mensagens.push('A data de nascimento não pode ser no futuro.');
            }
        }

        if (!valido) {
            e.preventDefault();
            alert('Corrija os erros abaixo:\n\n- ' + mensagens.join('\n- '));
        }
    });

    // Validação do formulário de login
    const formLogin = document.getElementById('form-login');
    if (formLogin) {
        formLogin.addEventListener('submit', function (e) {
            const email = formLogin.querySelector('#email').value.trim();
            const senha = formLogin.querySelector('#senha').value.trim();
            if (email === '' || senha === '') {
                e.preventDefault();
                alert('Preencha o e-mail e a senha.');
            }
        });
    }
});