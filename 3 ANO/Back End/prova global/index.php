<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Prova Global</title>
</head>
<body>
    <?php 
    $preco = $_REQUEST['preco'] ?? '0';
    $quantidade= $_REQUEST['quant'] ?? '0';
    $reaj = 12.5;
    $min = 30.00;
    $max = 50.00;

    ?>

    <main>
        <h1>Calcular Valor dos Produtos</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>">
            <label for="preco">Preço do Produto (R$)</label>
            <input type="number" name="preco" id="preco" min="0.10" step="0.01" value="<?=$preco?>">
            <label for= "quant"> Quantidade:</label>
            <input type="number" name="quant" id="quant" value="<?=$quantidade?>" required>
        <input type= "submit" value="Enviar">
        </form>
    </main>

    <?php 
    //Calculo do subtotal dos itens
    $subtotal = $preco * $quantidade;
    //calcular o imposto
    $imposto= $subtotal * ($reaj/ 100);
    $novo= $subtotal + $imposto;
    //calcular o valor do frete
    $frete =mt_rand($min,$max)/100;
    $valorTotalComFrete= $novo + $frete;

    echo " Produto:  R$ "  . number_format($preco, 2, ',', '.'). "<br>" ; 
    echo "Subtotal:  R$ "  . number_format($subtotal, 2, ',', '.'). "<br>"  ;
    echo "Imposto (12,5%) : R$ " . number_format($imposto, 2, ',', '.'). "<br>"  ;
    echo "Total Final: R$ " . number_format($novo, 2, ',', '.'). "<br>" ;
    echo "Frete : R$ " . number_format($frete, 2, ",", "."). "<br>" ;
    echo "Valor Total com Frete R$ :" . number_format($valorTotalComFrete, 2, ",", "."). "<br>" ;
    ?>

    

</body>
</html>