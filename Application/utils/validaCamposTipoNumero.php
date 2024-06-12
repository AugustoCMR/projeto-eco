<?php
function validarTipoNumero($campos) {
    $erros = [];

    foreach ($campos as $campo => $valor) {
        if (!is_numeric($valor)) {
            $erros[] = "O campo $campo deve ser númerico.";
        }
    }

    return $erros;
}