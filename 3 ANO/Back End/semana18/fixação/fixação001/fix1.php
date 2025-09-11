<?php
$preco_produto = 150;
$percentual_desconto = 10;

$resultado = ($preco_produto * $percentual_desconto) / 100;
$preco_final = ( $preco_produto - $resultado);

echo "O desconto é de: " . $resultado;   
echo "O preço final é: " . $preco_final;  
?>