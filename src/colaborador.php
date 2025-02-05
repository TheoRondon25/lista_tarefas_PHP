<?php
require_once 'config.php';

ob_start();
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($nome && $cpf && $email){
        $database->insert('colaboradores', [
            'nome' => $nome,
            'cpf' => $cpf,
            'email' => $email,            
        ]);

        $response = ['status' => 'success', 'message' => 'Colaborador criado com sucesso!'];
    } else {
        $response = ['status' => 'error', 'message' => 'Todos os campos são obrigatórios'];
    }

    ob_end_clean();
    echo json_encode($response);
    exit();
}




// class Colaborador {
//     private $database;

//     public function __construct($database) {
//         $this->database = $database;
//     }

//     public function adicionar($nome, $cpf, $email) {
//         return $this->database->insert('colaboradores', [
//             'nome' => $nome,
//             'cpf' => $cpf,
//             'email' => $email
//         ]);
//     }

//     public function listar() {
//         return $this->database->select('colaboradores', '*');
//     }

//     public function buscarPorId($id) {
//         return $this->database->get('colaboradores', '*', ['id' => $id]);
//     }

//     public function atualizar($id, $dados) {
//         return $this->database->update('colaboradores', $dados, ['id' => $id]);
//     }

//     public function deletar($id) {
//         return $this->database->delete('colaboradores', ['id' => $id]);
//     }
// }
?>
