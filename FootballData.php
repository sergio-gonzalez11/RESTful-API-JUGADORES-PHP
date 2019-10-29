<?php

/**
 * This service class encapsulates football-data.org's RESTful API.
 *
 * @author Sergio González Ruano
 * @date 24.10.2019 | switched to v2 09.08.2018
 * 
 */
class FootballData {
    
    public $config;
    public $url;
    public $request = array();
        
    public function __construct() {
        $this->config = parse_ini_file('config.ini', true);

        
	// some lame hint for the impatient
	if($this->config['authToken'] == 'YOUR_AUTH_TOKEN' || !isset($this->config['authToken'])) {
		exit('Get your API-Key first and edit config.ini');
	}
        
        $this->url = $this->config['url']; 
        
        $this->request['http']['method'] = 'GET';
        $this->request['http']['header'] = 'X-Auth-Token: ' . $this->config['authToken'];
    }


    public function findStandingsByCompetition($id) {
	$resource = 'competitions/' . $id . '/standings';
        $response = file_get_contents($this->url . $resource, false, 
                                      stream_context_create($this->request));

        return json_decode($response);
    }

    
    /**
     * Function returns one unique team identified by a given id.
     * 
     * @param int $id
     * @return stdObject team
     */    
    public function findTeamById($id) {
        $resource = 'teams/' . $id;
        $response = file_get_contents($this->url . $resource, false, 
                                      stream_context_create($this->request));
        
        return json_decode($response);
    }
 

}
