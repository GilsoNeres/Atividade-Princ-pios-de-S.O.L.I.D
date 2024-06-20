<?php

/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Gilso Reinaldo Neres Assis
* DATA: 20/06/2024
*/ 

// Interface que define o contrato para serviços de e-mail
interface ServicoEmailInterface {
    public function enviarEmail(Usuario $usuario, $assunto, $mensagem);
}

// Implementação básica do serviço de e-mail
class ServicoEmail implements ServicoEmailInterface {
    public function enviarEmail(Usuario $usuario, $assunto, $mensagem) {
        // Implementação para enviar e-mail
    }

    // Método específico para enviar e-mail de boas-vindas
    public function enviarEmailBoasVindas(Usuario $usuario) {
        $this->enviarEmail($usuario, "Bem-vindo", "Obrigado por se cadastrar!");
    }
}

// Extensão do serviço de e-mail com funcionalidade adicional
class ServicoEmailAdicional extends ServicoEmail {
    // Método específico para enviar e-mail de boas-vindas com desconto
    public function enviarEmailBoasVindasComDesconto(Usuario $usuario) {
        $this->enviarEmail($usuario, "Bem-vindo", "Obrigado por se cadastrar! Aqui está um código de desconto.");
    }
}
