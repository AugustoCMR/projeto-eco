<?php

 /**
   * Método para validar se todos os campos obrigatórios foram preenchidos
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   * @param $campos campos obrigatórios
   */
function validarCamposObrigatorios($campos) {
    $erros = [];

    foreach ($campos as $campo => $valor) {
        if (empty($valor)) {
            $erros[] = "O campo $campo é obrigatório.";
        }
    }

    return $erros;
}