<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo!</title>
</head>
<body>
    <h1>Olá!!</h1>
    <p>
        <?php
        $nomeRecebido = $_POST ['campo_nome'] ;
        
        echo "Olá," . $nomeRecebido . "! Seja muito bem-vindo(a) ao mundo do Back-End! " ;
        ?>
    </p>
</body>
</html>