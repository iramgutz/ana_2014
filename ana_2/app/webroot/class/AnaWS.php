<?php

include 'ClientSoap.php';

class AnaWS extends ClientSoap{

	private $XMLInit = [ 

		'soap:Envelope' => [
		
		   'attributes' => [
		
		        'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance' ,
		        'xmlns:xsd' => 'http://www.w3.org/2001/XMLSchema' ,
		        'xmlns:soap' => 'http://schemas.xmlsoap.org/soap/envelope/' 
		    ],

		    'content' => [
			    'soap:Body' => [                

		            'content' => []

		            ]

		        ]

		    ]

		];

	public function  __construct()
	{

		parent::__construct(
			[

				'host' => 'https://server.anaseguros.com.mx/ananetws/service.asmx?WSDL' ,

				'usuario' => '01027',

				'clave' => 'PLIEG34344',

				'negocio' => '325'
			]

		);

		$headers = [
		    "POST /ananetws/service.asmx HTTP/1.1",
		    "Host: server.anaseguros.com.mx",
		    "Content-type: text/xml;charset=\"utf-8\"",
		    "Accept: text/xml",
		    "Cache-Control: no-cache",
		    "Pragma: no-cache",   
		]; 

		parent::setHeaders($headers);

	}



	public function getEstados()
	{

		$method = 'EDOS';

		return json_encode($this->getBasicRequest($method));

	}

	public function getModelo()
	{
		
		$method = 'Modelo';

		return json_encode($this->getBasicRequest($method));

	}

	public function getBancos()
	{		

		$method = 'Bancos';

		return json_encode($this->getBasicRequest($method));

	}

	private function getBasicRequest($method)
	{	
		parent::setHeader("SOAPAction: http://tempuri.org/".$method);

		$contents = $this->XMLInit;

		$contents['soap:Envelope']['content']['soap:Body']['content'] = [
			$method => [
	            'attributes' => [
	                'xmlns' => 'http://tempuri.org/'	
	            ],	
	            'content' => [
			        'Negocio' => [
		                'content' => parent::getNegocio()
		            ],		    
		            'Usuario' => [
		                'content' => parent::getUsuario()
		            ],		     
		            'Clave' => [
		                'content' => parent::getClave()
		            ]
		       ]		      
		    ]		    
		];

		parent::generateXMLFromArray($contents);

		$response = parent::sendRequest();

		print_r($response);

		//$response = $this->parseResponse($response , '<'.$method.'Result>' , '</'.$method.'Result>');		
		
		//return $response;
	}

	

	public function parseResponse($response , $initString , $endString)
	{

		$response = str_replace('&lt;', '<', $response);

		$response = str_replace('&gt;', '>', $response);

		$init = strpos($response, $initString) + strlen($initString);

		$end = strpos($response, $endString) - $init;

		$response = substr($response, $init , $end );

		$responseArray = new SimpleXMLElement($response);

		return $responseArray;

	}

}

