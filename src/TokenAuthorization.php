<?php
namespace Dedalo\Afip;

/**
 * Token Autorization
 *
 * @package Dedalo\Afip
 * @author Ivan Muñoz
 **/
class TokenAutorization {
    /**
     * Authorization and authentication web service Token
     *
     * @var string
     **/
    var $token;

    /**
     * Authorization and authentication web service Sign
     *
     * @var string
     **/
    var $sign;

    function __construct($token, $sign)
    {
        $this->token 	= $token;
        $this->sign 	= $sign;
    }
}