<?php

/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Gilso Reinaldo Neres Assis
* DATA: 20/06/2024
*/ 

class Usuario {
    public $id;
    public $nome;
    public $email;
    public $senha;

    public function __construct($id, $nome, $email, $senha) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }
}

class RepositorioUsuario {
    public function salvar(Usuario $usuario) {
        // Lógica para salvar o usuário
    }

    public function listarUsuarios() {
        // Lógica para obter todos os usuários
    }
}

class ServicoEmail {
    public function enviarEmailBoasVindas(Usuario $usuario) {
        // Lógica para enviar e-mail de boas-vindas
    }
}

class ExportadorUsuario {
    public function exportarParaCSV(array $usuarios) {
        $csv = "id, nome, email\n";

        foreach ($usuarios as $usuario) {
            $csv .= "{$usuario->id}, {$usuario->nome}, {$usuario->email}\n";
        }

        file_put_contents('usuarios.csv', $csv);
    }
}

$usuario = new Usuario(1, 'Gilso', 'gilso_neres@hotmail.com', 'secreto');
$repositorioUsuario = new RepositorioUsuario();
$repositorioUsuario->salvar($usuario);

$servicoEmail = new ServicoEmail();
$servicoEmail->enviarEmailBoasVindas($usuario);

$usuarios = $repositorioUsuario->listarUsuarios();
$exportadorUsuario = new ExportadorUsuario();
$exportadorUsuario->exportarParaCSV($usuarios);
