 <?php

/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Gilso Reinaldo Neres Assis
* DATA: 20/06/2024
*/ 

class UserHandler {
    private $userStorage;
    private $notificationService;
    private $dataExporter;

    public function __construct(
        UserStorageInterface $userStorage,
        NotificationServiceInterface $notificationService,
        DataExporterInterface $dataExporter
    ) {
        // Inicializa as dependências necessárias
        $this->userStorage = $userStorage;
        $this->notificationService = $notificationService;
        $this->dataExporter = $dataExporter;
    }

    // Método para registrar um novo usuário
    public function createUser(User $user) {
        // Armazena o usuário
        $this->userStorage->add($user);
        // Envia um email de boas-vindas ao usuário
        $this->notificationService->sendWelcomeMessage($user);
    }

    // Método para exportar todos os usuários
    public function exportAllUsers() {
        // Recupera todos os usuários armazenados
        $users = $this->userStorage->fetchAllUsers();
        // Exporta os dados dos usuários para um arquivo CSV
        $this->dataExporter->exportAsCSV($users);
    }
}

// Instancia um novo usuário
$user = new User(1, 'John Doe', 'john@example.com', 'password123');
// Instancia os serviços necessários
$userStorage = new UserRepository();
$notificationService = new EmailService();
$dataExporter = new UserExporter();

// Cria a instância do UserHandler com os serviços injetados
$userHandler = new UserHandler($userStorage, $notificationService, $dataExporter);

// Registra o novo usuário e exporta a lista de usuários
$userHandler->createUser($user);
$userHandler->exportAllUsers();