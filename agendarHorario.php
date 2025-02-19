<?php

include 'config.php'
session_start();

// Check if the user is logged in.  If not, redirect to the login page.
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); // Redirect to your login page
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $servico = $_POST["servico"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];

    // Validation
    if (empty($nome) || empty($email) || empty($servico) || empty($data) || empty($hora)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Check for double booking (important!)
        $check_booking_sql = "SELECT id FROM agendamentos WHERE data_hora = '$data $hora'"; // Example query
        $check_booking_result = $conn->query($check_booking_sql);

        if ($check_booking_result->num_rows > 0) {
            $error_message = "This time slot is already booked. Please choose another time.";
        } else {
            // Prepared statement to prevent SQL injection (Best practice!)
            $stmt = $conn->prepare("INSERT INTO agendamentos (cliente_id, servico_id, data_hora) VALUES (?, ?, ?)"); // Make sure servico_id is a foreign key
            $data_hora = $data . " " . $hora; // Combine date and time
            $stmt->bind_param("iis", $_SESSION["user_id"], $servico, $data_hora); // "iis" - integer, integer, string (adjust types)

            if ($stmt->execute()) {
                $success_message = "Appointment booked successfully!";
            } else {
                $error_message = "Error booking appointment: " . $stmt->error;
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
    <title>Agendamento de Cortes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Cortes Command">
            <h1>Bora dar um tapa no visu?</h1>
        </div>
        <!-- <nav>
            <ul>
                <li><a href="#">Agendar Horário</a></li>
            </ul>
        </nav> -->
    </header>
    <main>
        <section class="formulario">
            <h2>Agendar Horário</h2>
            <form action="/agendar" method="POST">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="email" name="email" placeholder="Email" required>
                <select name="servico" required>
                    <option value="">Selecionar Serviço</option>
                    <option value="1">Corte de Cabelo</option>
                    <option value="2">Barba</option>
                    <option value="3">Corte e Barba</option>
                </select>
                <div class="data-hora">
                    <input type="date" name="data" required>
                    <input type="time" name="hora" required>
                </div>
                <button type="submit">Agendar</button>
            </form>
        </section>
    </main>
</body>
</html>