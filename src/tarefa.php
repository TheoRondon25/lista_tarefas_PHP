<?php
require_once 'config.php';

ob_start();
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

function getRequestData() {
    return json_decode(file_get_contents('php://input'), true);
}
// METODO POST
if ($method === 'POST') {
    $descricao = $_POST['descricao'] ?? '';
    $prazo_limite = $_POST['prazo_limite'] ?? '';
    $responsavel_id = $_POST['responsavel_id'] ?? '';
    $prioridade = $_POST['prioridade'] ?? '';

    if ($descricao && $prazo_limite && $responsavel_id && $prioridade){
        $database->insert('tarefas', [
            'descricao' => $descricao,
            'prazo_limite' => $prazo_limite,
            'responsavel_id' => $responsavel_id,
            'prioridade' => $prioridade
        ]);

        $response = ['status' => 'success', 'message' => 'Tarefa criada com sucesso!'];
    } else {
        $response = ['status' => 'error', 'message' => 'Todos os campos são obrigatórios'];
    }

    ob_end_clean();
    echo json_encode($response);
    exit();
}
//METODO GET
if ($method === 'GET') {

    $query = "SELECT * FROM tarefas";
    try {
        $tarefas = $database->query($query)->fetchAll(PDO::FETCH_ASSOC);

        if ($tarefas) {
            $tarefas = array_map(function($tarefa) {
                return [
                    'id' => $tarefa['id'],
                    'descricao' => $tarefa['descricao'],
                    'prazo_limite' => $tarefa['prazo_limite'],
                    'responsavel_id' => $tarefa['responsavel_id'],
                    'prioridade' => $tarefa['prioridade'],
                    'data_cadastro' => $tarefa['data_cadastro'],
                    'data_executada' => $tarefa['data_executada'],
                ];
            }, $tarefas);
            echo json_encode(['status' => 'success', 'data' => $tarefas], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Nenhuma tarefa encontrada.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao consultar o banco de dados: ' . $e->getMessage()
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    exit();   
}

if ($method === 'PUT') {
    $data = getRequestData();
    $id = $data['id'] ?? null;
    $descricao = $data['descricao'] ?? null;

    if ($id && $descricao) {
        $update = $database->update('tarefas', [
            'descricao' => $descricao
        ], [
            'id' => $id
        ]);

        if ($update->rowCount()) {
            echo json_encode(['status' => 'success', 'message' => 'Tarefa atualizada com sucesso!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Falha ao atualizar a tarefa.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dados inválidos para atualização.']);
    }
    exit();
}

// MÉTODO DELETE (Excluir tarefa)
if ($method === 'DELETE') {
    $data = getRequestData();
    $id = $data['id'] ?? null;

    if ($id) {
        $delete = $database->delete('tarefas', ['id' => $id]);

        if ($delete->rowCount()) {
            echo json_encode(['status' => 'success', 'message' => 'Tarefa excluída com sucesso!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Falha ao excluir a tarefa.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID da tarefa é obrigatório para exclusão.']);
    }
    exit();
}

// METEODO PUT
// if ($method === 'PUT') {
//     $data = getRequestData();
//     $id = $data['id'] ?? null;
//     $descricao = $data['descricao'] ?? null;
//     $prazo_limite = $data['prazo_limite'] ?? null;
//     $responsavel_id = $data['responsavel_id'] ?? null;
//     $prioridade = $data['prioridade'] ?? null;

//     if ($id && ($descricao || $prazo_limite || $responsavel_id || $prioridade)) {
//         $updateData = array_filter([
//             'descricao' => $descricao,
//             'prazo_limite' => $prazo_limite,
//             'responsavel_id' => $responsavel_id,
//             'prioridade' => $prioridade
//         ]);

//         $database->update('tarefas', $updateData, ['id' => $id]);

//         $response = ['status' => 'success', 'message' => 'Tarefa atualizada com sucesso!'];
//     } else {
//         $response = ['status' => 'error', 'message' => 'ID da tarefa e pelo menos um campo para atualização são obrigatórios.'];
//     }

//     ob_end_clean();
//     echo json_encode($response);
//     exit();
// }

// // MÉTODO DELETE
// if ($method === 'DELETE') {
//     $data = getRequestData();
//     $id = $data['id'] ?? null;

//     if ($id) {
//         $database->delete('tarefas', ['id' => $id]);

//         $response = ['status' => 'success', 'message' => 'Tarefa deletada com sucesso!'];
//     } else {
//         $response = ['status' => 'error', 'message' => 'ID da tarefa é obrigatório para exclusão.'];
//     }

//     ob_end_clean();
//     echo json_encode($response);
//     exit();
// }

echo json_encode(['status' => 'error', 'message' => 'Método não suportado']);
?>
 



// METEODO PUT
// if ($method === 'PUT') {
//     $data = getRequestData();
//     $id = $data['id'] ?? null;
//     $descricao = $data['descricao'] ?? null;
//     $prazo_limite = $data['prazo_limite'] ?? null;
//     $responsavel_id = $data['responsavel_id'] ?? null;
//     $prioridade = $data['prioridade'] ?? null;

//     if ($id && ($descricao || $prazo_limite || $responsavel_id || $prioridade)) {
//         $updateData = array_filter([
//             'descricao' => $descricao,
//             'prazo_limite' => $prazo_limite,
//             'responsavel_id' => $responsavel_id,
//             'prioridade' => $prioridade
//         ]);

//         $database->update('tarefas', $updateData, ['id' => $id]);

//         $response = ['status' => 'success', 'message' => 'Tarefa atualizada com sucesso!'];
//     } else {
//         $response = ['status' => 'error', 'message' => 'ID da tarefa e pelo menos um campo para atualização são obrigatórios.'];
//     }

//     ob_end_clean();
//     echo json_encode($response);
//     exit();
// }

// // MÉTODO DELETE
// if ($method === 'DELETE') {
//     $data = getRequestData();
//     $id = $data['id'] ?? null;

//     if ($id) {
//         $database->delete('tarefas', ['id' => $id]);

//         $response = ['status' => 'success', 'message' => 'Tarefa deletada com sucesso!'];
//     } else {
//         $response = ['status' => 'error', 'message' => 'ID da tarefa é obrigatório para exclusão.'];
//     }

//     ob_end_clean();
//     echo json_encode($response);
//     exit();
// }


