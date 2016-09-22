<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj15
*/

abstract class Fpbj15
{
    const PESSOAS_ENCONTRADAS = 6;
    const PESSOAS_NAO_ENCONTRADAS = 5;
    const DATA_INICIAL_INVALIDA = 4;
    const DATA_FINAL_INVALIDA = 3;
    const DATA_INICIAL_OBRIGATORIA = 2;
    const DATA_FINAL_OBRIGATORIA = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
    //    return OpusJson::executa('fpbj15', $args, $decode);

        return json_decode('
            {
              "pessoas": {
                "pessoa": [
                  {
                    "identificacaoPessoa": {
                      "matriculas": {
                        "matriculaSistemaCentral": {
                          "numero": "123456",
                          "seq": "01"
                        }
                      },
                      "nomePessoa": {
                        "nomeCompleto": "João da Silva",
                        "nomeSocial": "Mônica Paloma da Silva "
                      }
                    }
                  },{
                    "identificacaoPessoa": {
                      "matriculas": {
                        "matriculaSistemaCentral": {
                          "numero": "123456",
                          "seq": "01"
                        }
                      },
                      "nomePessoa": {
                        "nomeCompleto": "Maria da Silva",
                        "nomeSocial": "Marcos da Silva"
                      }
                    }
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
