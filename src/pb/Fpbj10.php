<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj10
*/

abstract class Fpbj10
{
    const DADOS_PESSOAIS_ENCONTRADOS = 5;
    const DADOS_PESSOAIS_NAO_ENCONTRADOS = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
    /* Esta comentado pois o programa ainda não foi implementado
       return OpusJson::executa('fpbj10', $args, $decode);
    */

        return json_decode('
            {
              "dadosPessoais": {
                "nomeMae": "Mãe do Fulano",
                "nomePai": "Pai do Fulano",
                "dataNascimento": "2016-01-01",
                "dataObito": "2016-01-01",
                "sexo": "MASCULINO",
                "estadoCivil": "SOLTEIRO",
                "relativos": {
                  "relativo": [
                    {
                      "matricula": "",
                      "tipoBeneficiario": "TITULAR"
                    }
                  ]
                },
                "documentos": {
                  "documento": [
                    {
                      "numero": "8888888RJ",
                      "dv": "888888",
                      "serie": "88888888",
                      "orgaoEmissor": "DETRAN",
                      "dataExpedicao": "2016-01-01",
                      "tipoDocumento": "IDENTIDADE"
                    },
                    {
                      "numero": "99999999RJ",
                      "dv": "9999999",
                      "serie": "999999",
                      "orgaoEmissor": "DETRAN",
                      "dataExpedicao": "2016-01-01",
                      "tipoDocumento": "IDENTIDADE"
                    }
                  ]
                },
                "enderecos": {
                  "endereco": [
                    {
                      "cep": {
                        "numero": 2798,
                        "formatado": "12345-123"
                      },
                      "logradouro": "Av. Marechal Câmara",
                      "numero": "123",
                      "complemento": "fundos",
                      "bairro": "Centro",
                      "cidade": {
                        "codigoMunicipioIbge": "999999",
                        "nome": "Rio de Janeiro"
                      },
                      "tipoEndereco": "RESIDENCIAL",
                      "uf": "RJ"
                    },
                    {
                      "cep": {
                        "numero": 42798,
                        "formatado": "12345-123"
                      },
                      "logradouro": "Av. Marechal Câmara",
                      "numero": "123",
                      "complemento": "fundos",
                      "bairro": "Centro",
                      "cidade": {
                        "codigoMunicipioIbge": "999999",
                        "nome": "Rio de Janeiro"
                      },
                      "tipoEndereco": "RESIDENCIAL",
                      "uf": "RJ"
                    }
                  ]
                },
                "telefones": {
                  "telefone": [
                    {
                      "ddd": 21,
                      "numero": 123456789,
                      "tipos": {
                        "tipo": [
                          "CELULAR",
                          "COMERCIAL"
                        ]
                      }
                    },
                    {
                      "ddd": 21,
                      "numero": 123456789,
                      "tipos": {
                        "tipo": [
                          "CELULAR",
                          "COMERCIAL"
                        ]
                      }
                    }
                  ]
                },
                "nacionalidade": {
                  "codigo": 12,
                  "pais": "Brasil"
                },
                "tipoSanguineo": "A+",
                "ocupacao": {
                  "cbo1994": "1-96-20",
                  "cbo2002": "2631-05"
                },
                "emails": {
                  "email": [
                    "fulano@gmail.com",
                    "ciclano@gmail.com"
                  ]
                },
                "tipoBeneficiario": "TITULAR"
              },
              "statusExecucao": {
                "executadoCorretamente": true,
                "mensagens": {
                  "mensagem": [
                    {
                      "codigo": 5,
                      "severidade": "INFO",
                      "mensagem": "Dados pessoais encontrados",
                      "detalhes": ""
                    }
                  ]
                }
              }
            }


        ');
    }
}
