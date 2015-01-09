<?php 

include 'XMLConstruct.php';

class ClientSoap {

	private $host;
	private $usuario;
	private $clave;
	private $negocio;
	private $headers = [];
	private $xml_post_string;

	public function __construct($config = array())
	{		

		if(!empty($config['host']))
		{

			$this->setHost($config['host']);
		}

		if(!empty($config['usuario']))
		{

			$this->setUsuario($config['usuario']);
		}

		if(!empty($config['clave']))
		{

			$this->setClave($config['clave']);
		}

		if(!empty($config['negocio']))
		{

			$this->setNegocio($config['negocio']);
		}
		

	}

	public function getHost()
	{

		return $this->host;

	}

	public function setHost($host)
	{
		$this->host = $host;
	}

	public function getUsuario()
	{

		return $this->usuario;

	}

	public function setUsuario($usuario)
	{
		$this->usuario = $usuario;
	}

	public function getClave()
	{

		return $this->clave;

	}

	public function setClave($clave)
	{
		$this->clave = $clave;
	}

	public function getNegocio()
	{

		return $this->negocio;

	}

	public function setNegocio($negocio)
	{
		$this->negocio = $negocio;
	}

	public function getHeaders()
	{
		return $this->headers;
	}

	public function setHeaders($headers)
	{
	
		$this->headers = $headers;

	}

	public function setHeader($header)
	{
		$headers = $this->getHeaders();

		array_push($headers, $header);

		$this->setHeaders($headers);

	}

	public function addHeaders($headers = array())
	{
		foreach($headers as $header)
		{
			$this->setHeader($header);
		}
	}

	public function generateXMLFromArray($array)
	{	
		$xml = new XMLConstruct();

		$xml->fromArray($array);
		$this->setXmlPostString($xml->getDocument()); 
	}

	public function setXmlPostString($xml_post_string)
	{
		$this->xml_post_string = $xml_post_string;
	}

	public function getXmlPostString()
	{
		return $this->xml_post_string;
	}

	public function sendRequest()
	{
		$this->setHeader("Content-length: " . strlen($this->getXmlPostString()));

		/*print_r($this->getHost());

		print_r($this->getHeaders());

		print_r($this->getXmlPostString());*/

		//exit();

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $this->getHost());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getXmlPostString());
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());

		$response = curl_exec($ch);	

		return $response;
	}

	
}