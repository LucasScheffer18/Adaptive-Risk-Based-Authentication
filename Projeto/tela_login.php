<!-- Tela de Login -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">  
  <div class="container container mt-5">
    <h2 class="mb-4">Login</h2>
    <form method="POST" action="login.php">
      <div class="mb-3">
        <label for="email" class="form-label">Email: </label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="senha" class="form-label">Senha: </label>
        <input type="password" class="form-control" id="senha" name="senha" required>
      </div>
      <div class="btn-container">
        <button type="submit" class="btn btn-primary">Entrar</button>
      </div>
      <div class="text-center mt-3">
        <a href="cadastro.php">Criar uma conta</a>
      </div>
    </form>
  </div>
  <script>
    navigator.geolocation.getCurrentPosition(function(position) {
        // Envia latitude e longitude via POST para salvar no backend
        fetch('salvar_localizacao.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                latitude: position.coords.latitude,
                longitude: position.coords.longitude
            })
        });
    }, function(error) {
        console.warn('Erro ao obter localização:', error.message);
    });
  </script>

</body>
</html>