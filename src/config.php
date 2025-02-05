<?php
require 'c:/Documentos/avaliacao-php/vendor/autoload.php';

use Medoo\Medoo;

$database = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'tarefas_db',
    'username' => 'root', 
    'password' => '1234'   
]);

// apenas testando a conexao
// try {
//     $database->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Conexão bem-sucedida!";
// } catch (PDOException $e) {
//     die("Erro de conexão: " . $e->getMessage());
// }
?>

