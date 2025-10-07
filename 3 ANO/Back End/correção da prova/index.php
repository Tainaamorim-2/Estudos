<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC-Pronto</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>

    <?php
    // Captura os dados enviados pelo formulário
    $produto = $_REQUEST['preco'] ?? 0;
    $quantia = $_REQUEST['quantia'] ?? 1;
    $cep = $_REQUEST['cep'] ?? 35188000;

    // ----- COTAÇÃO DO DÓLAR -----
    $inicio = date("m-d-Y", strtotime("-7 days"));
    $fim = date("m-d-Y");
    $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/' .
        'CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?' .
        '@dataInicial=\'' . $inicio . '\'&@dataFinalCotacao=\'' . $fim . '\'' .
        '&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

    $dados = json_decode(file_get_contents($url), true);
    $cotacao = $dados["value"][0]["cotacaoCompra"] ?? 5.00; // valor padrão se API falhar
    ?>

    <main>
        <h1>Carrinho</h1>
        <p>"Vamos calcular o valor do produto"</p>
        <p>Informe os dados necessários:</p>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
            <fieldset>
                <legend><strong>&#x1F4E6; Produto</strong></legend>
                <label for="preco">Qual o valor do produto desejado?</label>
                <input type="number" name="preco" id="preco" min="0.01" step="0.01" required value="<?= $produto ?>">
                <br><br>
                <label for="quantia">Quantos desse produto você deseja?</label>
                <input type="number" name="quantia" id="quantia" min="1" required value="<?= $quantia ?>">
            </fieldset>

            <fieldset>
                <legend><strong>&#x1F69A; Entrega</strong></legend>
                <label for="cep">CEP:</label>
                <input type="number" name="cep" id="cep" minlength="8" maxlength="8" required placeholder="35188000" value="<?= $cep ?>">
            </fieldset>

            <input type="submit" value="Calcular">
        </form>
    </main>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['preco'])) {

        // ----- CÁLCULOS -----
        $subtotal = $produto * $quantia;
        $imposto = ($subtotal * 12.5) / 100;
        $total_final = $subtotal + $imposto;

        // Frete aleatório entre R$30 e R$150
        $frete = mt_rand(30, 150);
        $valor_com_frete = $total_final + $frete;

        // Conversão para dólar
        $preco_dolar = $valor_com_frete / $cotacao;

        // Cálculo simbólico do prazo de entrega
        $sobra = $cep / 1000000;
        $mes = (int)($sobra / 30);
        $sobra = $sobra % 30;
        $semana = (int)($sobra / 7);
        $dia = $sobra % 7;
    ?>

        <section>
            <h2>--- Orçamento PC-Pronto ---</h2>
            <ul>
                <li>Produto: <strong>R$<?= number_format($produto, 2, ",", ".") ?> (x<?= $quantia ?>)</strong></li>
                <li>Subtotal: <strong>R$<?= number_format($subtotal, 2, ",", ".") ?></strong></li>
                <li>Imposto (12,5%): R$<?= number_format($imposto, 2, ",", ".") ?></li>
                <li>Total Final: R$<?= number_format($total_final, 2, ",", ".") ?></li>
                <li>Frete: R$<?= number_format($frete, 2, ",", ".") ?></li>
                <li><strong>Valor Total com Frete: R$<?= number_format($valor_com_frete, 2, ",", ".") ?></strong></li>
                <li>Cotação do Dólar Hoje: R$<?= number_format($cotacao, 2, ",", ".") ?></li>
                <li><strong>Total em Dólares: US$<?= number_format($preco_dolar, 2, ".", ",") ?></strong></li>
            </ul>

            <h2>Entrega</h2>
            <ul>
                <li><?= $mes ?> Meses</li>
                <li><?= $semana ?> Semanas</li>
                <li><?= $dia ?> Dias</li>
            </ul>
        </section>

    <?php } ?>

    <footer>
        <p><small>Pâmela - PC Pronto | &copy; 2025</small></p>
    </footer>

</body>
</html>