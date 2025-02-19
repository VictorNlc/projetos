<?php
include 'config.php'; 
session_start();


// Get database connection from config.php
$conn = get_db_connection();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"]; 

    // Use a prepared statement to prevent SQL injection
    $sql = "SELECT id, senha FROM clientes WHERE email =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($senha, $row["senha"])) { 
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_email"] = $email;
            header("Location: index.php"); // Redirect to the home page after login
            exit();
        } else {
            $error_message = "Email ou senha inválidos.";
        }
    } else {
        $error_message = "Email ou senha inválidos.";
    }
    $stmt->close();
}

$conn->close();?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Barbearia - Sistema de Agendamentos</h1>
    </header>
    <main class="container">
        <section id="login">
            <section class="formulario">
                <h2>Login de Cliente</h2>
                <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; }?>  
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> 
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </section>
            <p>Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p> 
        </section>
    </main>
</body>
</html>