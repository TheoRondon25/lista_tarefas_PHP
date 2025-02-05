$(document).ready(function() {
    $('select').formSelect();

    // SUBMISSÃO DO FORMULÁRIO
    $('#formTarefa').on('submit', function(event) {
        event.preventDefault();
        const formData = {
            descricao: $('#descricao').val(),
            prazo_limite: $('#prazo_limite').val(),
            responsavel_id: $('#responsavel_id').val(),
            prioridade: $('#prioridade').val()
        };

        $.ajax({
            url: '../src/tarefa.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#mensagem').html(`<span class="green-text">${response.message}</span>`);
                    $('#formTarefa')[0].reset();
                    $('select').formSelect();
                } else {
                    $('#mensagem').html(`<span class="red-text">${response.message}</span>`);
                }
            },
            error: function() {
                $('#mensagem').html('<span class="red-text">Erro ao processar a solicitação.</span>');
            }
        });
    });

    // LISTAR TAREFAS
    $("#btnListar").on('click', function() {
        $.ajax({
            url: '../src/tarefa.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    mostrarTarefas(response.data);
                } else {
                    $('#mensagem').html('<p class="red-text">Erro ao listar tarefas.</p>');
                }
            },
            error: function() {
                $('#mensagem').html('<p class="red-text">Falha na requisição.</p>');
            }
        });
    });

    // MOSTRAR TAREFAS COM BOTÕES DE AÇÃO
    function mostrarTarefas(tarefas) {
        let html = '<ul class="collection">';
        tarefas.forEach(function(tarefa) {
            html += `
                <li class="collection-item" data-id="${tarefa.id}">
                    <strong>${tarefa.descricao}</strong><br>
                    Prazo: ${tarefa.prazo_limite}<br>
                    Prioridade: ${tarefa.prioridade}<br>
                    Responsável ID: ${tarefa.responsavel_id}
                    <div class="right-align">
                        <button class="btn red btnExcluir" data-id="${tarefa.id}">Excluir</button>
                        <button class="btn blue btnEditar" data-id="${tarefa.id}">Editar</button>
                    </div>
                </li>
            `;
        });
        html += '</ul>';
        $('#mensagem').html(html);
    }

    // EXCLUIR TAREFA
    $(document).on('click', '.btnExcluir', function() {
        const id = $(this).data('id');
        if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
            $.ajax({
                url: '../src/tarefa.php',
                method: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify({ id: id }),
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Tarefa excluída com sucesso!');
                        $("#btnListar").click(); // Atualiza a lista
                    } else {
                        alert('Erro ao excluir tarefa.');
                    }
                }
            });
        }
    });

    // EDITAR TAREFA
    $(document).on('click', '.btnEditar', function() {
        const id = $(this).data('id');
        const novaDescricao = prompt('Nova descrição da tarefa:');
        if (novaDescricao) {
            $.ajax({
                url: '../src/tarefa.php',
                method: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify({ id: id, descricao: novaDescricao }),
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Tarefa atualizada com sucesso!');
                        $("#btnListar").click(); // Atualiza a lista
                    } else {
                        alert('Erro ao atualizar tarefa.');
                    }
                }
            });
        }
    });
});



// $(document).ready(function() {
//     // Inicializa o select do Materialize
//     $('select').formSelect();

//     // Evento de submissão do formulário
//     $('#formTarefa').on('submit', function(event) {
//         event.preventDefault(); // Evita o reload da página

//         // Captura os dados do formulário
//         const formData = {
//             descricao: $('#descricao').val(),
//             prazo_limite: $('#prazo_limite').val(),
//             responsavel_id: $('#responsavel_id').val(),
//             prioridade: $('#prioridade').val()
//         };

//         // Envia os dados via AJAX
//         $.ajax({
//             url: '../src/tarefa.php',
//             method: 'POST',
//             data: formData,
//             dataType: 'json',
//             success: function(response) {
//                 if (response.status === 'success') {
//                     $('#mensagem').html(`<span class="green-text">${response.message}</span>`);
//                     $('#formTarefa')[0].reset(); // Limpa o formulário
//                     $('select').formSelect();    // Reaplica o estilo do select
//                 } else {
//                     $('#mensagem').html(`<span class="red-text">${response.message}</span>`);
//                 }
//             },
//             error: function(jqXHR, textStatus, errorThrown) {
//                 console.log('Erro:', textStatus, errorThrown);
//                 console.log('Resposta do servidor:', jqXHR.responseText); // Verifica a resposta do PHP
//                 $('#mensagem').html('<span class="red-text">Ocorreu um erro ao processar a solicitação.</span>');
//             }
//         });
//     });
// });

// $(document).ready(function() {
//     $('select').formSelect();

//     // Evento para o botão de listar tarefas
//     $("button:contains('Listar Tarefas')").on('click', function(event) {
//         event.preventDefault();

//         $.ajax({
//             url: '../src/tarefa.php',  // URL do PHP que fará a consulta
//             method: 'GET',          // Método GET para listar
//             dataType: 'json',
//             success: function(response) {
//                 if (response.status === 'success') {
//                     mostrarTarefas(response.data);
//                 } else {
//                     $('#mensagem').html('<p class="red-text">Erro ao listar tarefas.</p>');
//                 }
//             },
//             error: function() {
//                 $('#mensagem').html('<p class="red-text">Falha na requisição.</p>');
//             }
//         });
//     });

//     // Função para exibir as tarefas na página
//     function mostrarTarefas(tarefas) {
//         let html = '<ul class="collection">';
//         tarefas.forEach(function(tarefa) {
//             html += `
//                 <li class="collection-item">
//                     <strong>${tarefa.descricao}</strong><br>
//                     Prazo: ${tarefa.prazo_limite}<br>
//                     Prioridade: ${tarefa.prioridade}<br>
//                     Responsável ID: ${tarefa.responsavel_id}
//                 </li>
//             `;
//         });
//         html += '</ul>';

//         $('#mensagem').html(html);
//     }
// });
    


