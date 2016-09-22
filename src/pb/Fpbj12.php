<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj12
*/

abstract class Fpbj12
{
    const DADOS_BANCARIOS_ENCONTRADOS = 5;
    const DADOS_BANCARIOS_NAO_ENCONTRADOS = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
    //    return OpusJson::executa('fpbj12', $args, $decode);

        return json_decode('
            {
              "dadosBancarios": {
                "dadoBancario": [
                  {
                    "banco": {
                      "codigo": "123465",
                      "nome": "Nome do Banco"
                    },
                    "agencia": {
                      "codigo": "123456",
                      "dv": "12"
                    },
                    "conta": {
                      "numero": "123456"
                    },
                    "tipoDadoBancario": "CONTA_CORRENTE_PAGAMENTO"
                  },
                  {
                    "banco": {
                      "codigo": "0000000",
                      "nome": "Nome do Banco"
                    },
                    "agencia": {
                      "codigo": "000000",
                      "dv": "12"
                    },
                    "conta": {
                      "numero": "00000"
                    },
                    "tipoDadoBancario": "CONTA_CORRENTE_SIAPE"
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
            }');
    }
}
