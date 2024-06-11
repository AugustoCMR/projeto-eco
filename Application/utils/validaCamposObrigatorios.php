<?php
function validarCamposObrigatorios($campos) {
    $erros = [];

    foreach ($campos as $campo => $valor) {
        if (empty($valor)) {
            $erros[] = "O campo $campo é obrigatório.";
        }
    }

    return $erros;
}