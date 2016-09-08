<?php

namespace capesesp;

use capesesp\pb\Fpbj08;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj08Test extends OpusJsonTestCase
{

    public function testPlanosEncontrados()
    {
        $args = array(46,0);
        $jsonObj = Fpbj08::executa($args);
        $this->assertCodigo($jsonObj, Fpbj08::LISTA_PLANOS_ASSISTENCIAIS, $args);
    }

    public function testBeneficiarioNaoVinculado()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj08::executa($args);
        $this->assertCodigo($jsonObj, Fpbj08::BENEFICIARIO_NAO_VINCULADO, $args);
    }

    public function testBeneficiarioNaoEncontrado()
    {
        $args = array(46,99);
        $jsonObj = Fpbj08::executa($args);
        $this->assertCodigo($jsonObj, Fpbj08::BENEFICIARIO_NAO_ENCONTRADO, $args);
    }

    public function testSequencialInvalido()
    {
        $args = array(46,'x');
        $jsonObj = Fpbj08::executa($args);
        $this->assertCodigo($jsonObj, Fpbj08::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalido()
    {
        $args = array('cc',0);
        $jsonObj = Fpbj08::executa($args);
        $this->assertCodigo($jsonObj, Fpbj08::MATRICULA_INVALIDA, $args);
    }

   public function testMatriculaApenasMedicoNacional()
    {
        $args = ['46','00'];
        $jsonObj = Fpbj08::executa($args);

        $planoMedicoNacional = new \StdClass();
        $planoMedicoNacional->descricaoPlano = Fpbj08::PLANO_MEDICO;
        $planoMedicoNacional->registroPlanoAns = Fpbj08::ASSISTENCIA_BASICA_II;
        $planoMedicoNacional->codigoCarteira = Fpbj08::CODIGO_NACIONAL;


        $this->assertContainsOnly($jsonObj->planos[0], [$planoMedicoNacional]);

    }

    /**
    * @dataProvider associadosPlanoMedicoiNacional
    */
    public function testPlanoMedicoNacional($matricula, $sequencial, $registroAns, $abrangencia, $odonto)
    {
        $args = [$matricula, $sequencial];
        $jsonObj = Fpbj08::executa($args);

        $planoMedico = new \StdClass();
        $planoMedico->descricaoPlano = Fpbj08::PLANO_MEDICO;
        $planoMedico->registroPlanoAns = $registroAns;
        $planoMedico->codigoCarteira = $abrangencia;

        $planos[] = $planoMedico;

        $this->assertEquals($planos, $jsonObj->planos);
    }

   /**
    * @dataProvider associadosPlanoMedicoRegional
    */
    public function testPlanoMedicoRegional($matricula, $sequencial, $registroAns, $abrangencia, $odonto)
    {
        $args = [$matricula, $sequencial];
        $jsonObj = Fpbj08::executa($args);

        $planoMedico = new \StdClass();
        $planoMedico->descricaoPlano = Fpbj08::PLANO_MEDICO;
        $planoMedico->registroPlanoAns = $registroAns;
        $planoMedico->codigoCarteira = $abrangencia;

        $planos[] = $planoMedico;

        $this->assertEquals($planos, $jsonObj->planos);
    }

   /**
    * @dataProvider associadosPlanoMedicoRegionalEOdonto
    */
    public function testPlanoMedicoRegionalEOdonto($matricula, $sequencial, $registroAns, $abrangencia, $odonto)
    {
        $args = [$matricula, $sequencial];
        $jsonObj = Fpbj08::executa($args);

        $planoMedico = new \StdClass();
        $planoMedico->descricaoPlano = Fpbj08::PLANO_MEDICO;
        $planoMedico->registroPlanoAns = $registroAns;
        $planoMedico->codigoCarteira = $abrangencia;

        $planoOdonto = new \StdClass();
        $planoOdonto->descricaoPlano = Fpbj08::PLANO_ODONTO;
        $planoOdonto->registroPlanoAns = Fpbj08::ODONTOLOGICO;
        $planoOdonto->codigoCarteira = Fpbj08::CODIGO_ODONTO;

        $planos[] = $planoMedico;
        $planos[] = $planoOdonto;

        $this->assertEquals($planos, $jsonObj->planos);
    }

   /**
    * @dataProvider associadosPlanoMedicoNacionalEOdonto
    */
    public function testPlanoMedicoNacionalEOdonto($matricula, $sequencial, $registroAns, $abrangencia, $odonto)
    {
        $args = [$matricula, $sequencial];
        $jsonObj = Fpbj08::executa($args);

        $planoMedico = new \StdClass();
        $planoMedico->descricaoPlano = Fpbj08::PLANO_MEDICO;
        $planoMedico->registroPlanoAns = $registroAns;
        $planoMedico->codigoCarteira = $abrangencia;

        $planoOdonto = new \StdClass();
        $planoOdonto->descricaoPlano = Fpbj08::PLANO_ODONTO;
        $planoOdonto->registroPlanoAns = Fpbj08::ODONTOLOGICO;
        $planoOdonto->codigoCarteira = Fpbj08::CODIGO_ODONTO;

        $planos[] = $planoMedico;
        $planos[] = $planoOdonto;

        $this->assertEquals($planos, $jsonObj->planos);
    }

    public function associadosPlanoMedicoRegional(){
        return array(
                   array('432116','1',Fpbj08::SOB_MEDIDA_NORDESTE_ENFERMARIA, 'regional',false),
                   array('432116','1',Fpbj08::SOB_MEDIDA_NORDESTE_ENFERMARIA, 'regional',false),
                   array('432116','1',Fpbj08::SOB_MEDIDA_NORDESTE_ENFERMARIA,'regional',false),
                   array('349740','1',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_ENFERMARIA,'regional',false),
                   array('454519','1',Fpbj08::SOB_MEDIDA_NORDESTE_ENFERMARIA,'regional',false),
                   array('485074','2',Fpbj08::SOB_MEDIDA_SUL_ENFERMARIA,'regional',false),
                   array('485074','3',Fpbj08::SOB_MEDIDA_SUL_ENFERMARIA,'regional',false),
                   array('374302','7',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_ENFERMARIA,'regional',false),
                   array('374302','8',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_ENFERMARIA,'regional',false),
                   array('374302','9',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_ENFERMARIA,'regional',false),
                   array('374302','10',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_ENFERMARIA,'regional',false),
                   array('432116','7',Fpbj08::SOB_MEDIDA_NORDESTE_ENFERMARIA,'regional',false),
                   array('485074','4',Fpbj08::SOB_MEDIDA_SUL_ENFERMARIA,'regional',false),
                   array('1785803','3',Fpbj08::SOB_MEDIDA_SUDESTE_I_APARTAMENTO,'regional',false),
                   array('349740','0',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_ENFERMARIA,'regional',false),
                   array('432116','0',Fpbj08::SOB_MEDIDA_NORDESTE_ENFERMARIA,'regional',false),
                   array('454519','0',Fpbj08::SOB_MEDIDA_NORDESTE_ENFERMARIA,'regional',false),
                   array('374302','0',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_ENFERMARIA,'regional',false),
                   array('485074','0',Fpbj08::SOB_MEDIDA_SUL_ENFERMARIA,'regional',false),
                );
    }

    public function associadosPlanoMedicoNacionalEOdonto(){
        return array(
                    array('306315','2',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                    array('306315','3',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                    array('494837','1',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                    array('306315','4',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                    array('429093','1',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                    array('429093','2',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                    array('325093','1',Fpbj08::ASSISTENCIA_SUPERIOR_I,'nacional',true),
                    array('429093','4',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                    array('429093','6',Fpbj08::ASSISTENCIA_BASICA_4,'nacional',true),
                    array('306315','0',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                    array('325093','0',Fpbj08::ASSISTENCIA_SUPERIOR_I,'nacional',true),
                    array('429093','0',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                    array('494837','0',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',true),
                );
    }

    public function associadosPlanoMedicoRegionalEOdonto(){
        return array(
                    array('1785803','1',Fpbj08::SOB_MEDIDA_SUDESTE_I_APARTAMENTO,'regional',true),
                    array('1620396','1',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_APARTAMENTO,'regional',true),
                    array('1620396','2',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_APARTAMENTO,'regional',true),
                    array('1785803','2',Fpbj08::SOB_MEDIDA_SUDESTE_I_APARTAMENTO,'regional',true),
                    array('1620396','3',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_APARTAMENTO,'regional',true),
                    array('1620396','0',Fpbj08::SOB_MEDIDA_NORTE_CENTRO_OESTE_APARTAMENTO,'regional',true),
                    array('1785803','0',Fpbj08::SOB_MEDIDA_SUDESTE_I_APARTAMENTO,'regional',true)
                );
    }


    public function associadosPlanoMedicoNacional(){
        return array(
                    array('454519','2',Fpbj08::REFERENCIAL,'nacional',false),
                    array('454519','12',Fpbj08::ASSISTENCIA_BASICA_4,'nacional',false),
                    array('482806','5',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',false),
                    array('352015','5',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',false),
                    array('482806','7',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',false),
                    array('482806','8',Fpbj08::REFERENCIAL,'nacional',false),
                    array('431306','9',Fpbj08::REFERENCIAL,'nacional',false),
                    array('432116','10',Fpbj08::REFERENCIAL,'nacional',false),
                    array('352015','0',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',false),
                    array('431306','0',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',false),
                    array('482806','0',Fpbj08::ASSISTENCIA_BASICA_I,'nacional',false),
                    array('454519','11',Fpbj08::ASSISTENCIA_SUPERIOR_4,'nacional',false),
                );
            }

}
