<?php

require_once __DIR__ . '/../config/database.php';

class Tarefa {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function listar($usuarioId) {
        $sql = "SELECT * FROM tarefas
                WHERE usuario_id = ?
                ORDER BY data_criacao DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $tarefas = [];

        while ($row = $resultado->fetch_assoc()) {
            $tarefas[] = $row;
        }

        $stmt->close();

        return $tarefas;
    }

    public function criar($descricao, $usuarioId) {
        $sql = "INSERT INTO tarefas (descricao, usuario_id)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $descricao, $usuarioId);

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function excluir($id, $usuarioId) {
        $sql = "DELETE FROM tarefas
                WHERE id = ? AND usuario_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $id, $usuarioId);

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function editar($id, $descricao, $usuarioId) {
        $sql = "UPDATE tarefas
                SET descricao = ?
                WHERE id = ? AND usuario_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii", $descricao, $id, $usuarioId);

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }
}

?>