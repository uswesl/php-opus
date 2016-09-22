<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj11
*/

abstract class Fpbj11
{
    const DADOS_FUNCIONAIS_ENCONTRADOS = 5;
    const DADOS_FUNCIONAIS_NAO_ENCONTRADOS = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
    //    return OpusJson::executa('fpbj11', $args, $decode);

        return json_decode('
            {
              "dadosFuncionais": {
                "unidadePagadora": {
                  "codigo": "123456",
                  "siglaUF": "RJ"
                },
                "qualificacao": "SERVIDOR",
                "matriculaSiape": {
                  "numero": 123456
                },
                "orgao": {
                  "codigo": "12",
                  "nome": "Descricao do orgão",
                  "cnpj": "1234560111"
                }
              },
              "statusExecucao": {
                "executadoCorretamente": true,
                "mensagens": {
                  "mensagem": [
                    {
                      "codigo": 4,
                      "severidade": "INFO",
                      "mensagem": "Dados retornados",
                      "detalhes": "Dados referente as identificação da Pessoa"
                    }
                  ]
                }
              }
            }');
    }
}
