<?php

    /**
   * Método para validar se o campo digitado é do tipo number
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $capos campos que serão validados
   */
function validarTipoNumero($campos) {
    $erros = [];

    foreach ($campos as $campo => $valor) {
        if (!is_numeric($valor)) {
            $erros[] = "O campo $campo deve ser númerico.";
        }
    }

    return $erros;
}