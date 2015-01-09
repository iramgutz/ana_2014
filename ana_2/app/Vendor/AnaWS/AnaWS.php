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

	public function getYears()
	{
		
		$method = 'Modelo';

		return $this->getBasicRequest($method);

	}

	public function getBrands($extraFields = [])
	{
		
		$method = 'Marca';

		$fields = [

			'Modelo' => [

				'content' => $extraFields['Modelo']

			],

			'Categoria' => [

				'content' => $extraFields['Categoria']

			]

		];

		return $this->getBasicRequest($method , $fields);

	}

	public function getSubBrands($extraFields = [])
	{
		
		$method = 'SubMarca';

		foreach($extraFields as $k => $f)
		{

			$fields[$k] = [
				'content' => $f
			];

		}	

		return $this->getBasicRequest($method , $fields , 'clave');

	}

	public function getVehicles($extraFields = [])
	{
		
		$method = 'Vehiculo';

		foreach($extraFields as $k => $f)
		{

			$fields[$k] = [
				'content' => $f
			];

		}	


		return $this->getBasicRequest($method , $fields , 'clave');

	}

	public function getCategories()
	{
		
		$method = 'Categoria';

		return json_encode($this->getBasicRequest($method));

	}

	public function getBancos()
	{		

		$method = 'Bancos';

		return json_encode($this->getBasicRequest($method));

	}

	public function getStates()
	{		

		$method = 'EDOS';

		return json_encode($this->getBasicRequest($method , [] , 'id'));

	}

	public function getCities($extraFields = [])
	{
		
		$method = 'DelMun';

		foreach($extraFields as $k => $f)
		{

			$fields[$k] = [
				'content' => $f
			];

		}	

		return $this->getBasicRequest($method , $fields);

	}

	public function getCotizacion($type = 1 , $data = array() , $car = array())
	{
		

		$typePlan = $type;

		if($type == 4){
			$typePlan = 1;
		}

		parent::setHost('https://server.anaseguros.com.mx/ananetws/servicetext.asmx?WSDL');

		$headers = [
		    "POST /ananetws/servicetext.asmx HTTP/1.1",
		    "Host: server.anaseguros.com.mx",
		    "Content-type: text/xml;charset=\"utf-8\"",
		    "Accept: text/xml",
		    "Cache-Control: no-cache",
		    "Pragma: no-cache",   
		]; 

		parent::setHeaders($headers);

		$method = 'TransaccionText2';

		$xmlCoberturas;

		switch($type){
			case 1:
			$xmlCoberturas = '
			<cobertura id="02" desc="" sa="" tipo="3" ded="5" pma=""/>
			<cobertura id="04" desc="" sa="" tipo="3" ded="10" pma=""/>
			<cobertura id="06" desc="" sa="200000" tipo="" ded="" pma=""/>
			<cobertura id="07" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="10" desc="" sa="" tipo="B" ded="" pma=""/>
			<cobertura id="12" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="13" desc="" sa="2" tipo="" ded="" pma=""/>
			<cobertura id="18" desc="" sa="Ana Rent" tipo="" ded="" pma=""/>
			<cobertura id="23" desc="" sa="100000" tipo="" ded="" pma=""/>
			<cobertura id="25" desc="" sa="500000" tipo="" ded="" pma=""/>
			<cobertura id="26" desc="" sa="500000" tipo="" ded="" pma=""/>
			<cobertura id="27" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="28" desc="" sa="Segullantas" tipo="" ded="" pma=""/>
			<cobertura id="34" desc="" sa="2000000" tipo="" ded="" pma=""/>
			<cobertura id="35" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="36" desc="" sa="" tipo="" ded="" pma=""/>
			';
			break;
			case 2:
			$xmlCoberturas = '
			<cobertura id="01" desc="" sa="" tipo="3" ded="5" pma=""/>
			<cobertura id="04" desc="" sa="" tipo="3" ded="10" pma=""/>
			<cobertura id="06" desc="" sa="200000" tipo="" ded="" pma=""/>
			<cobertura id="07" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="10" desc="" sa="" tipo="B" ded="" pma=""/>
			<cobertura id="12" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="13" desc="" sa="2" tipo="" ded="" pma=""/>
			<cobertura id="23" desc="" sa="100000" tipo="" ded="" pma=""/>
			<cobertura id="25" desc="" sa="500000" tipo="" ded="" pma=""/>
			<cobertura id="26" desc="" sa="500000" tipo="" ded="" pma=""/>
			<cobertura id="27" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="28" desc="" sa="Segullantas" tipo="" ded="" pma=""/>
			<cobertura id="34" desc="" sa="2000000" tipo="" ded="" pma=""/>
			<cobertura id="37" desc="" sa="" tipo="" ded="" pma=""/>
			';
			break;
			case 3:
			$xmlCoberturas = '
			<cobertura id="04" desc="" sa="" tipo="3" ded="10" pma=""/>
			<cobertura id="06" desc="" sa="200000" tipo="" ded="" pma=""/>
			<cobertura id="07" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="10" desc="" sa="" tipo="B" ded="" pma=""/>
			<cobertura id="12" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="13" desc="" sa="2" tipo="" ded="" pma=""/>
			<cobertura id="23" desc="" sa="100000" tipo="" ded="" pma=""/>
			<cobertura id="25" desc="" sa="500000" tipo="" ded="" pma=""/>
			<cobertura id="26" desc="" sa="500000" tipo="" ded="" pma=""/>
			<cobertura id="27" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="28" desc="" sa="Segullantas" tipo="" ded="" pma=""/>
			<cobertura id="34" desc="" sa="2000000" tipo="" ded="" pma=""/>
			<cobertura id="37" desc="" sa="" tipo="" ded="" pma=""/>
			';
			break;
			case 4:
			$xmlCoberturas = 
			'
			<cobertura id="02" desc="" sa="" tipo="1" ded="5" pma=""/>
			<cobertura id="04" desc="" sa="" tipo="1" ded="10" pma=""/>
			<cobertura id="06" desc="" sa="200000" tipo="" ded="" pma=""/>
			<cobertura id="07" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="08" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="09" desc="" sa="Auto Sustituto" tipo="" ded="" pma=""/>
			<cobertura id="10" desc="" sa="" tipo="B" ded="" pma=""/>
			<cobertura id="12" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="13" desc="" sa="2" tipo="" ded="" pma=""/>
			<cobertura id="18" desc="" sa="Ana Rent" tipo="" ded="" pma=""/>
			<cobertura id="23" desc="" sa="100000" tipo="" ded="" pma=""/>
			<cobertura id="24" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="25" desc="" sa="500000" tipo="" ded="" pma=""/>
			<cobertura id="26" desc="" sa="500000" tipo="" ded="" pma=""/>
			<cobertura id="27" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="28" desc="" sa="Segullantas" tipo="" ded="" pma=""/>
			<cobertura id="34" desc="" sa="2000000" tipo="" ded="" pma=""/>
			<cobertura id="35" desc="" sa="" tipo="" ded="" pma=""/>
			<cobertura id="36" desc="" sa="" tipo="" ded="" pma=""/>
			';
			break;	
		}

		$fields['XML'] = [
				'content' => "<transacciones xmlns=''>
            <transaccion version='1' tipotransaccion='C' cotizacion='' negocio='325' tiponegocio=''>
              <vehiculo id='1' amis='".( (!empty($car['vehicle'])) ? $car['vehicle'] : '')."' modelo='".( (!empty($car['year'])) ? $car['year'] : '')."' descripcion='' uso='1' servicio='1' plan='".$typePlan."' motor='' serie='' repuve='' placas='' conductor='' conductorliciencia='' conductorfecnac='' conductorocupacion='' estado='".( (!empty($data['ciudad_id']) && !empty($data['estado_id'])) ? $data['estado_id'].$data['ciudad_id'] : '')."' poblacion='' color='01' dispositivo='' fecdispositivo='' tipocarga='' tipocargadescripcion=''>
                ".
                $xmlCoberturas
                ."
              </vehiculo>
              <asegurado id='' nombre='".( (!empty($data['datos']['nombre'])) ? $data['datos']['nombre'] : '')."' paterno='".( (!empty($data['datos']['apellido_paterno'])) ? $data['datos']['apellido_paterno'] : '')."' materno='".( (!empty($data['datos']['apellido_materno'])) ? $data['datos']['apellido_materno'] : '')."' calle='' numerointerior='' numeroexterior='' colonia='".( (!empty($data['datos']['colonia'])) ? $data['datos']['colonia'] : '')."' poblacion='' estado='".( (!empty($data['ciudad_id']) && !empty($data['estado_id'])) ? $data['estado_id'].$data['ciudad_id'] : '')."' cp='".( (!empty($data['cp'])) ? $data['cp'] : '')."' pais='MEXICO' tipopersona='1'/>
              <poliza id='' tipo='A' endoso='' fecemision='".date('d/m/Y')."' feciniciovig='".date('d/m/Y')."' fecterminovig='".date('d/m/Y', time()+(60*60*24*365))."' moneda='0' bonificacion='0' formapago='C' agente='05945' tarifacuotas='1404' tarifavalores='1404' tarifaderechos='1404' beneficiario='' politicacancelacion='1'/>
              <prima primaneta='' derecho='' recargo='' impuesto='' primatotal='' comision=''/>
              <recibo id='' feciniciovig='' fecterminovig='' primaneta='' derecho='' recargo='' impuesto='' primatotal='' comision='' cadenaoriginal='' sellodigital='' fecemision='' serie='' folio='' horaemision='' numeroaprobacion='' anoaprobacion='' numseriecertificado=''/>
              <error/>
            </transaccion>
          </transacciones>"
			];

		$cotizacion = $this->getTransactionRequest( $method , $fields );

		return $cotizacion['transaccion']['prima']['@attributes'];

		//return json_encode($this->getTransactionRequest( $method , $fields ));




	}

	private function getBasicRequest($method , $extraFields = [] , $key = 'id')
	{	
		parent::setHeader("SOAPAction: http://tempuri.org/".$method);

		$contents = $this->XMLInit;

		$content = [
		    'Negocio' => [
			    'content' => parent::getNegocio()
		    ],		    
		    'Usuario' => [
		    	'content' => parent::getUsuario()
		    ],		     
		    'Clave' => [
		    	'content' => parent::getClave()
		    ]
		];	    

		$content = $content + $extraFields;

		$contents['soap:Envelope']['content']['soap:Body']['content'] = [
			$method => [
	           'attributes' => [
	                'xmlns' => 'http://tempuri.org/'	
	            ],	
	            'content' => $content 
		    ]		    
		];

		parent::generateXMLFromArray($contents);

		$response = parent::sendRequest();

		$response = $this->parseResponse($response , $method , $key);		
		
		return $response;
	}

	private function getTransactionRequest($method , $extraFields = [] )
	{	
		parent::setHeader("SOAPAction: http://tempuri.org/".$method);

		$contents = $this->XMLInit;

		$content = [
		    'Negocio' => [
			    'content' => parent::getNegocio()
		    ],		    
		    'Usuario' => [
		    	'content' => parent::getUsuario()
		    ],		     
		    'Clave' => [
		    	'content' => parent::getClave()
		    ]
		];	    

		$content = $content + $extraFields;

		$contents['soap:Envelope']['content']['soap:Body']['content'] = [
			$method => [
	           'attributes' => [
	                'xmlns' => 'http://tempuri.org/'	
	            ],	
	            'content' => $content 
		    ]		    
		];

		parent::generateXMLFromArray($contents);

		$response = parent::sendRequest();

		$response = $this->parseTransactionResponse($response , $method );		
		
		return $response;
	}

	

	public function parseResponse($response , $method , $key)
	{  

		$initString = '<'.$method.'Result>';

		$endString = '</'.$method.'Result>'; 

		$responseString = strtolower($method);

		if($method == 'EDOS')
			$responseString = 'estado';

		$response = str_replace('&lt;', '<', $response);

		$response = str_replace('&gt;', '>', $response);

		$init = strpos($response, $initString) + strlen($initString);

		$end = strpos($response, $endString) - $init;

		$response = substr($response, $init , $end );

		$responseObject = simplexml_load_string($response);

		$responseArray2 = (array) $responseObject;

		$responseArray2 = (array) $responseArray2[$responseString];

		if(is_string($responseArray2))
		{
			$responseArray2 = [$responseArray2];
		}

		foreach($responseArray2 as $id => $value)
		{

			$responseArray2[$value] = $value;

			unset($responseArray2[$id]);
		}

		$responseKeys = array_keys($responseArray2);

		$count = 0;

		foreach($responseObject->{$responseString} as $a => $b) {
		    
		    foreach($responseObject->{$responseString}[$count]->attributes() as $k => $att){

		    	if($k == $key){

		    		$attr = (string) $att;

		    		if(isset($responseKeys[$count]))
		    		{

		    			$responseArray2[$attr] = $responseArray2[$responseKeys[$count]];

		    			unset($responseArray2[$responseKeys[$count]]);

		    		}

		    	}
		    }

		    $count++;
		
		}

		return $responseArray2;

	}

	public function parseTransactionResponse($response , $method )
	{  

		$initString = '<'.$method.'Result>';

		$endString = '</'.$method.'Result>'; 

		$responseString = strtolower($method);

		if($responseString == 'transacciontext2')
		{
			$responseString = 'transaccion';
		}


		$response = str_replace('&lt;', '<', $response);

		$response = str_replace('&gt;', '>', $response);

		$init = strpos($response, $initString) + strlen($initString);

		$end = strpos($response, $endString) - $init;

		$response = substr($response, $init , $end );

		$responseObject = simplexml_load_string($response);

		//$responseArray2 = (array) $responseObject;

		//$responseArray2 = (array) $responseArray2[$responseString]; 

		$responseArray2 = $this->object_to_array($responseObject);

		return $responseArray2;

	}

	public function object_to_array($obj) {
	    
	    if(is_object($obj)) $obj = (array) $obj;

	    if(is_array($obj)) {
	        
	        $new = array();

	        foreach($obj as $key => $val) {

	            $new[$key] = $this->object_to_array($val);
	        }
	    }
	    
	    else $new = $obj;
	    
	    return $new;       

	}

}

