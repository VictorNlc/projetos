<?php // Make sure there's NO space or characters before this tag

include 'config.php';
session_start();

// Check if the user is logged in.  If not, redirect to the login page.
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); // Redirect to your login page
    exit();
}

// // Database credentials (replace with your actual credentials)
// $servername = "your_servername";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_dbname";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user information (e.g., name)
$user_id = $_SESSION["user_id"];
$sql = "SELECT nome FROM clientes WHERE id = $user_id"; // Adjust the table and column names as needed
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nome_cliente = $row["nome"];
} else {
    $nome_cliente = "Cliente"; // Default name if not found
}


// Fetch user's appointments (current and history)
$agendamentos = [];
$historico = [];

// Current Appointments (example query - adapt to your database schema)
$sql_agendamentos = "SELECT * FROM agendamentos WHERE cliente_id = $user_id AND data_hora >= NOW() ORDER BY data_hora ASC"; // Example query
$result_agendamentos = $conn->query($sql_agendamentos);
if ($result_agendamentos) {
    while ($row = $result_agendamentos->fetch_assoc()) {
        $agendamentos[] = $row;
    }
}


// Appointment History (example query - adapt to your database schema)
$sql_historico = "SELECT * FROM agendamentos WHERE cliente_id = $user_id AND data_hora < NOW() ORDER BY data_hora DESC LIMIT 10"; // Example query, limiting to 10 entries
$result_historico = $conn->query($sql_historico);
if ($result_historico) {
    while ($row = $result_historico->fetch_assoc()) {
        $historico[] = $row;
    }
}



$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Cortes Command">
            <h1>Barbearia - Sistema de Agendamentos</h1>
        </div>
    </header>

    <main class="container">
        <section id="home">
            <h2>Olá, <span id="nome-cliente">[Nome do Cliente]</span>!</h2>

            <h3>Seus Agendamentos:</h3>
            <div id="agendamentos">
                </div>

            <h3>Histórico de Agendamentos:</h3>
            <div id="historico">
                </div>
        </section>
    </main>

    <script src="script.js"></script> </body>
</html>