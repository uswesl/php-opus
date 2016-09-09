<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj14
*/

abstract class Fpbj14
{
    const DADOS_PREVIDENCIAIS_ENCONTRADOS = 5;
    const DADOS_PREVIDENCIAIS_NAO_ENCONTRADOS = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
    //    return OpusJson::executa('fpbj14', $args, $decode);

        return json_decode('
            {
              "dadosPrevidenciais": {
                "planoPrevidencia": [
                  {
                    "matriculas": {
                      "matriculaSistemaCentral": {
                        "numero": "123213",
                        "sequencial": "01"
                      }
                    },
                    "baseSalarialPrevidencial": 1111111111111111111111111111,
                    "dataInscricao": "2016-08-18",
                    "dataCancelamento": "2016-08-19",
                    "dataInscricaoPeculio": "2016-08-19",
                    "dataCancelamentoPeculio": "2016-08-19",
                    "numeroInscricaoPrevidencia": 123456,
                    "numerInscricaoPeculio": 123456789,
                    "codigoBeneficio": 123456,
                    "situacaoBeneficio": 123456,
                    "tiposPeculio": "A",
                    "condicaoPeculio": "CANCELADO",
                    "statusBeneficiario": "SUSPENSO"
                  }
                ]
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
            }

        ');
    }
}
