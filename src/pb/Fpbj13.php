<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj13
*/

abstract class Fpbj13
{
    const DADOS_ASSISTENCIAIS_ENCONTRADOS = 5;
    const DADOS_ASSISTENCIAIS_NAO_ENCONTRADOS = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
    //    return OpusJson::executa('fpbj13', $args, $decode);

        return json_decode('
            {
              "dadosAssistenciais": {
                "cns": {
                  "numero": "123456"
                },
                "planosAssistenciais": {
                  "planoAssistencial": [
                    {
                      "descricaoProduto": "Basico 1",
                      "statusBeneficiario": "ATIVO",
                      "matricula": {},
                      "registroAns": {
                        "registro": "123456"
                      },
                      "segmentacao": "ASSISTENCIAL",
                      "intervaloVinculo": {
                        "dataVinculo": "2016-01-01",
                        "dataDesligamento": "2016-01-01"
                      },
                      "uf": "RJ",
                      "acomodacao": "ENFERMARIA",
                      "contrato": "COLETIVO_EMPRESARIAL",
                      "abrangencia": "NACIONAL",
                      "coberturaAns": {
                        "descricao": "XXXXXXXXXXXXXXX"
                      },
                      "patrocinadorOriginal": {
                        "nome": "Funasa"
                      },
                      "mensagensCarencia": {
                        "mensagem": [
                          "mensagem 1",
                          "mensagem 2",
                          "mensagem 3"
                        ]
                      }
                    }
                  ]
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
            }

');
    }
}
