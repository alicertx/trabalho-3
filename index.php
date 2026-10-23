
<?php
session_start();

require_once __DIR__ . '/app/controller/usuarioController.php';
require_once __DIR__ . '/app/controller/controller.php';

$usuarioController = new UsuarioController();
$tarefaController = new tarefaController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'autenticar':
        $usuarioController->autenticar();
        break;

    case 'painel':
        $usuarioController->painel();
        break;

    case 'logout':
        $usuarioController->logout();
        break;

    case 'tarefas':
        if (!isset($_SESSION['id'])) {
            header("Location: index.php");
            exit;
        }
        $tarefaController->index();
        break;

    case 'criar':
        if (!isset($_SESSION['id'])) {
            header("Location: index.php");
            exit;
        }
        $tarefaController->criar();
        break;

    case 'excluir':
        if (!isset($_SESSION['id'])) {
            header("Location: index.php");
            exit;
        }
        $tarefaController->excluir();
        break;

    case 'editar':
        if (!isset($_SESSION['id'])) {
            header("Location: index.php");
            exit;
        }
        $tarefaController->editar();
        break;

    default:
        $usuarioController->index();
        break;
}
?>
