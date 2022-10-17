<?php

$dataNascimentoParam = $_GET["dataNascimento"];

if ($dataNascimentoParam === null || trim($dataNascimentoParam) === "") {
    die("Necessário preencher a data de nascimento");
}

$dataArray = explode("-", $dataNascimentoParam);
$ano = $dataArray[0];
$dataNascimento = new DateTime($dataNascimentoParam);
echo "<p> Seu aniversario é em: ". $dataNascimento -> format("d/m/Y") . "</p>";

function montarData($dataString, $ano) {
    $data = $dataString . "/" . $ano;
    $dataFormatada = str_replace("/", "-", $data);
    return new DateTime($dataFormatada);
}

$xml = simplexml_load_file('signos.xml') or die('Erro ao ler signos.xml.');

foreach ($xml->signo as $signo) {
    $dataInicio = montarData($signo -> dataInicio, $ano);
    $dataFim = montarData($signo -> dataFim, $ano);

    if ($dataNascimento >= $dataInicio && $dataNascimento <= $dataFim) {
        echo "<p> Seu signo é: " . $signo -> signoNome . " - " . $signo -> descricao . "</p>";
        echo "<p> de: ". $signo -> dataInicio . " até " . $signo -> dataFim . "</p>";
    }
}

?>