$(document).ready(function() {
    
    $('select').formSelect();

    $('#formColaborador').on('submit', function(event) {
        event.preventDefault(); // Evita o reload da página

        // Captura os dados do formulário
        const formData = {
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            email: $('#email').val(),            
        };

        // Envia os dados via AJAX
        $.ajax({
            url: 'src/colaborador.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#mensagem').html(`<span class="green-text">${response.message}</span>`);
                    $('#formColaborador')[0].reset(); 
                    $('select').formSelect();   
                    setTimeout(function() {
                        window.location.href = 'html/lista_tarefas.html';
                    }, 1500);
                } else {
                    $('#mensagem').html(`<span class="red-text">${response.message}</span>`);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Erro:', textStatus, errorThrown);
                console.log('Resposta do servidor:', jqXHR.responseText); // Verifica a resposta do PHP
                $('#mensagem').html('<span class="red-text">Ocorreu um erro ao processar a solicitação.</span>');
            }
        });
    });
});
