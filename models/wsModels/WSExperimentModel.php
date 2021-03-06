<?php

//**********************************************************************************************
//                                       WSExperimentModel.php 
//
// Author(s): Morgane VIDAL
// PHIS-SILEX version 1.0
// Copyright © - INRA - 2017
// Creation date: February 2017
// Contact: morgane.vidal@inra.fr, anne.tireau@inra.fr, pascal.neveu@inra.fr
// Last modification date:  October, 31 2017 : Passage de Trial à Experiment
// Subject: Corresponds to the experiments service - extends WSModel
//***********************************************************************************************

namespace app\models\wsModels;

include_once '../config/web_services.php';

/**
 * Encapsulate the access to the experiments service
 * @see \openSILEX\guzzleClientPHP\WSModel
 * @author Morgane Vidal <morgane.vidal@inra.fr>
 */
class WSExperimentModel extends \openSILEX\guzzleClientPHP\WSModel {
    
    /**
     * initialize access to the experiments service. Calls super constructor
     */
    public function __construct() {
        parent::__construct(WS_PHIS_PATH, "experiments");
    }
    
    /**
     * 
     * @param String $sessionToken connection user token
     * @param String $uri uri of the searched experiment
     * @param Array $params contains the data to send to the get service 
     * e.g.
     * [
     *  "page" => "0",
     *  "pageSize" => "1000",
     *  "uri" => "http://uri/of/my/entity" 
     * ]
     * @return mixed if the experiment exist, an array representing the experiment 
     *               else the error message 
     */
    public function getExperimentByURI($sessionToken, $uri, $params) {
        $subService = "/" . urlencode($uri);
        $requestRes = $this->get($sessionToken, $subService, $params);
        
        if (isset($requestRes->{WSConstants::RESULT}->{WSConstants::DATA}))  {
            return (array) $requestRes->{WSConstants::RESULT}->{WSConstants::DATA}[0];
        } else {
            return $requestRes;
        }
    }
}
