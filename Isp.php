<?php

/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Gilso Reinaldo Neres Assis
* DATA: 20/06
*/ 

// Interface que define métodos para manipulação de usuários
interface UserStorage {
    public function store(User $user);
    public function retrieveAllUsers();
}

// Implementação da interface de repositório de usuários
class UserDatabase implements UserStorage {
    public function store(User $user) {
        // Código para salvar o usuário no banco de dados
    }

    public function retrieveAllUsers() {
        // Código para buscar todos os usuários do banco de dados
    }
}

// Interface para serviços de email
interface EmailSender {
    public function send(User $user, $subject, $body);
    public function sendWelcomeEmail(User $user);
}

// Interface para exportar dados de usuários
interface UserCSVExporter {
    public function exportAsCSV(array $users);
}

// Implementação da interface de exportação de usuários
class CSVExporter implements UserCSVExporter {
    public function exportAsCSV(array $users) {
        $csvContent = "id, name, email\n"; // Cabeçalho do CSV

        // Monta o conteúdo do CSV com base nos usuários
        foreach ($users as $user) {
            $csvContent .= "{$user->id}, {$user->name}, {$user->email}\n";
        }

        file_put_contents('user_data.csv', $csvContent); // Salva o CSV em um arquivo
    }
}

// Cria uma nova instância de User e salva no repositório
$user = new User(1, 'Gilso', 'gilso_neres@hotmail.com', 'secret');
$userRepo = new UserDatabase();
$userRepo->store($user);

// Envia um email de boas-vindas ao usuário
$emailService = new EmailService();
$emailService->sendWelcomeEmail($user);

// Obtém todos os usuários e exporta para um arquivo CSV
$allUsers = $userRepo->retrieveAllUsers();
$csvExporter = new CSVExporter();
$csvExporter->exportAsCSV($allUsers);
?>