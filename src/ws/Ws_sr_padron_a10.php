<?php
namespace Dedalo\Afip\ws;
use Dedalo\Afip\AfipWebService;
use Exception;

/**
 * Consulta a Padrón Alcance 10 (ws_sr_padron_a10)
 * 
 * @link http://www.afip.gob.ar/ws/ws_sr_padron_a10/manual_ws_sr_padron_a10_v1.1.pdf WS Specification
 *
 * @author Ivan Muñoz
 * @package Afip
 **/

class Ws_sr_padron_a10 extends AfipWebService {
    var $soap_version 	= SOAP_1_1;
    var $WSDL 			= 'ws_sr_padron_a10-production.wsdl';
    var $URL 			= 'https://aws.afip.gov.ar/sr-padron/webservices/personaServiceA10';
    var $WSDL_TEST 		= 'ws_sr_padron_a10.wsdl';
    var $URL_TEST 		= 'https://awshomo.afip.gov.ar/sr-padron/webservices/personaServiceA10';

    /**
     * Asks to web service for servers status {@see WS 
     * Specification item 3.1}
     *
     * @since 1.0
     *
     * @return object { appserver => Web Service status, 
     * dbserver => Database status, authserver => Autentication 
     * server status}
    **/
    public function GetServerStatus()
    {
        return $this->ExecuteRequest('dummy');
    }

    /**
     * Asks to web service for taxpayer details {@see WS Specification item 3.2}
     *
     * @throws Exception if exists an error in response 
     *
     * @return object|null if taxpayer does not exists, return null,  
     * if it exists, returns persona property of response {@see 
     * WS Specification item 3.2.2}
    **/
    public function GetTaxpayerDetails($identifier)
    {
        $ta = $this->afip->GetServiceTA('ws_sr_padron_a10');

        $params = array(
            'token' => $ta->token,
            'sign' => $ta->sign,
            'cuitRepresentada' => $this->afip->CUIT,
            'idPersona' => $identifier
        );

        try {
            return $this->ExecuteRequest('getPersona', $params)->persona;
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'No existe') !== FALSE)
                return NULL;
            else
                throw $e;
        }
    }

    /**
     * Sends request to AFIP servers
     * 
     * @param string 	$operation 	SOAP operation to do 
     * @param array 	$params 	Parameters to send
     *
     * @return mixed Operation results 
     **/
    public function ExecuteRequest($operation, $params = array())
    {
        $results = parent::ExecuteRequest($operation, $params);

        return $results->{$operation == 'getPersona' ? 'personaReturn' : 'return'};
    }
}