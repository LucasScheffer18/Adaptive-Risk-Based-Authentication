<!-- otp.php -->
<?php
session_start();
$id_tentativa = $_SESSION['id_tentativa'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Verificação OTP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">Verificação de Segundo Fator</h2>
    <form method="POST" action="otp_verificacao.php">
      <div class="mb-3">
        <label for="otp" class="form-label">Digite o código seguro</label>
        <input type="hidden" name="id_tentativa" value="<?php echo htmlspecialchars($id_tentativa); ?>">
        <input type="text" class="form-control" id="otp" name="codigo" required>
      </div>
      <div class="btn-container">
        <button type="submit" class="btn btn-success">Verificar</button>
      </div>
    </form>
  </div>
</body>
</html>
