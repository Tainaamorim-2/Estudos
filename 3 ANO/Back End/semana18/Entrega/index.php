<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculadora de tinta</title>
</head>
<body>
    <!--Título e frase de introdução-->

    <h1>Calculadora de  </h1>

    <p>Vai pintar a parede e não sabe quanta tinta comprar?  Nossa Calculadora de Tinta ajuda você a descobrir a quantidade exata em poucos segundos! É só informar a largura e a altura da parede, e pronto: mostramos a área e o quanto de tinta será necessário para o serviço.</p>

    <!--Formulário-->
    <header>
        <h1>Calcule a cor para sua parede! </h1>
    </header>
    <section>
        <form action="index.php" method="post">
            <label for="largura">Largura da parede (m)</label>
            <input type="number" name="largura" id="largura" required>
            <label for="altura">Altura da Parede (m)</label>
            <input type="number" name="altura" id="altura">
            <input type="submit" value="Calcular">

        </form> 
    </section>



</body>
</html>