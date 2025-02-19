<?php
include 'config.php'
// // Database credentials (replace with your actual credentials)
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "barbearia";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    // Validation
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        $error_message = "All fields are required.";
    } elseif ($senha != $confirmar_senha) {
        $error_message = "Passwords do not match.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Check if email already exists
        $check_email_sql = "SELECT email FROM clientes WHERE email = '$email'";
        $check_email_result = $conn->query($check_email_sql);
        if ($check_email_result->num_rows > 0) {
            $error_message = "Email already exists. Please login.";
        } else {
            // Hash the password (Essential!)
            $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

            // Prepared statement to prevent SQL injection (Best practice!)
            $stmt = $conn->prepare("INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $hashed_password); // "sss" for string, string, string

            if ($stmt->execute()) {
                $success_message = "Registration successful. You can now login.";
            } else {
                $error_message = "Error during registration: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia - Cadastro</title>
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
        <section id="cadastro">
            <section class="formulario">
            <h2>Cadastrar Novo Cliente</h2>
            <form action="/REWORK/index.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu Nome Completo" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="Seu E-mail" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="Sua Senha" required>
                </div>
                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirmar Senha" required>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
            </section>
            <p>Já possui uma conta? <a href="login.html">Faça login</a></p>
        </section>
    </main>
</body>
</html>