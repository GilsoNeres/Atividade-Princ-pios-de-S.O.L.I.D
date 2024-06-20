<?php

/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Gilso Reinaldo Neres Assis
* DATA: 20/06/2024
*/ 

// Interfaces que definem os contratos para UserRepository, EmailService e UserExporter
interface UserRepositoryInterface {
    public function save(User $user); // Salva um usuário
    public function getAllUsers(); // Retorna todos os usuários
}

interface EmailServiceInterface {
    public function sendEmail(User $user, $subject, $message); // Envia um e-mail para um usuário
    public function sendWelcomeEmail(User $user); // Envia um e-mail de boas-vindas para um usuário
}

interface UserExporterInterface {
    public function exportToCSV(array $users); // Exporta os usuários para um arquivo CSV
}

// Classe que representa um usuário
class User {
    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($id, $name, $email, $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}

// Implementação concreta da interface UserRepositoryInterface
class UserRepository implements UserRepositoryInterface {
    public function save(User $user) {
        echo "User {$user->name} saved to database.\n";
    }

    public function getAllUsers() {
        return [
            new User(1, 'Gilso', 'gilso_neres@hotmail.com', 'secret'),
            new User(2, 'Gilso', 'gilsoreineres@gmail.com', 'password')
        ];
    }
}

// Implementação concreta da interface EmailServiceInterface
class EmailService implements EmailServiceInterface {
    public function sendEmail(User $user, $subject, $message) {
        echo "Email sent to {$user->email}: {$subject} - {$message}\n";
    }

    public function sendWelcomeEmail(User $user) {
        $this->sendEmail($user, "Welcome", "Thank you for registering!");
    }
}

// Implementação concreta da interface UserExporterInterface
class UserExporter implements UserExporterInterface {
    public function exportToCSV(array $users) {
        $csv = "id, name, email\n";

        foreach ($users as $user) {
            $csv .= "{$user->id}, {$user->name}, {$user->email}\n";
        }

        file_put_contents('users.csv', $csv);
        echo "Users exported to CSV.\n";
    }
}

// Classe principal que utiliza os serviços de UserRepository, EmailService e UserExporter
class UserService {
    private $userRepository;
    private $emailService;
    private $userExporter;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EmailServiceInterface $emailService,
        UserExporterInterface $userExporter
    ) {
        $this->userRepository = $userRepository;
        $this->emailService = $emailService;
        $this->userExporter = $userExporter;
    }

    // Método para registrar um usuário
    public function registerUser(User $user) {
        $this->userRepository->save($user);
        $this->emailService->sendWelcomeEmail($user);
    }

    // Método para exportar os usuários
    public function exportUsers() {
        $users = $this->userRepository->getAllUsers();
        $this->userExporter->exportToCSV($users);
    }
}

// Criação de um usuário com o e-mail modificado
$user = new User(1, 'Gilso', 'gilso_neres@hotmail.com', 'secret');

// Instanciação dos serviços necessários
$userRepo = new UserRepository();
$emailService = new EmailService();
$userExporter = new UserExporter();

// Instanciação da classe UserService e execução dos métodos
$userService = new UserService($userRepo, $emailService, $userExporter);
$userService->registerUser($user);
$userService->exportUsers();
?>
