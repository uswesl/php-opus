<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj09
*/

abstract class Fpbj09
{
    const PESSOA_ENCONTRADA = 5;
    const PESSOA_NAO_ENCONTRADA = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
    //    return OpusJson::executa('fpbj09', $args, $decode);

        return json_decode('{
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
          },
          "statusExecucao": {
            "executadoCorretamente": true,
            "mensagens": {
              "mensagem": [
                {
                  "codigo": 5,
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
