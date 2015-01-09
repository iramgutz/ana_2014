<?php


App::uses('AppController', 'Controller');

App::import('Vendor', 'AnaWS' , ['file' => 'AnaWS' . DS . 'AnaWS.php']);


class APIController extends AppController {


	public $uses = array('CP', 'Tasa' , 'Estado');

	protected $ana;

	public function beforeFilter()
	{

		$this->autoRender = false;		

		$this->ana = new AnaWS();

		header('Content-Type: application/json');
	}

	public function index()
	{

		echo $this->ana->getEstados();

	}

	public function getYears()
	{

		echo json_encode($this->ana->getYears());

	}

	public function getBrands($year , $category = '100')
	{

		$extraFields = [

			'Modelo' => $year,
			'Categoria' => $category
		];
		
		echo json_encode($this->ana->getBrands($extraFields));

	}

	public function getSubBrands($year , $brand = false, $category = '100')
	{

		$extraFields = [

			'Modelo' => $year,
			'Categoria' => $category
		];

		if($brand)
		{
		
			$extraFields['Marca'] = $brand;

		}
		
		echo json_encode($this->ana->getSubBrands($extraFields));

	}

	public function getVehicles($year , $brand , $sub_brand , $category = '100')
	{

		$extraFields = [

			'Modelo' => $year,
			'Marca' => $brand,
			'Submarca' => $sub_brand,
			'Categoria' => $category
		];
		
		echo json_encode($this->ana->getVehicles($extraFields));

	}

	public function getCategories()
	{

		echo $this->ana->getCategories();

	}

	public function getStates()
	{

		echo $this->ana->getStates();

	}

	public function getCities($state)
	{

		$extraFields = [

			'Estado' => $state
		];
		
		echo json_encode($this->ana->getCity($extraFields));

	}

	public function getCotizacion()
	{

		$car = ( isset($_GET['car']) ) ? json_decode($_GET['car'] , true) : [];

		$data = ( isset($_GET['data']) ) ? json_decode($_GET['data'] , true) : [];

		$cotizacion = [
			'amplia' => $this->ana->getCotizacion(1 , $data , $car),
			'amplia_10' => $this->ana->getCotizacion(4, $data , $car),
			'UPT' => $this->ana->getCotizacion(2, $data , $car),
			'limitada' => $this->ana->getCotizacion(3, $data , $car)
		];

		$tasas = $this->Tasa->find('first');

		$cotizacionFinal = [];

		$cotizacionFinal = $this->_calculaPagos($cotizacion , $tasas );

		echo json_encode($cotizacionFinal);
	}


	public function checkCP($cp) {
		

		$this->autoRender  = false;
		
		$results = $this->CP->find('all',[

			'conditions' => [

				'CP.cp' => $cp

			],
		]);

		if($results)
		{

			$estadoId = 0;

			$estado = $this->Estado->find(
				'first',
				[
					'conditions' => [

						'nombre' => $results[0]['CP']['edo']
					]
				]
			);

			if($estado)
			{
				$estadoId = $estado['Estado']['id'];
			}			

			if($estadoId < 10)
				$estadoId = '0'.$estadoId;

			$extraFields = [

				'Estado' => $estadoId
			];

			$delegaciones = $this->ana->getCities($extraFields);

			$ciudadId = '000';

			foreach($delegaciones as $k => $delegacion)
			{
				if(strtolower($delegacion) == strtolower($results[0]['CP']['cd']))
				{

					$ciudadId = $k;

				}
			}

			if(strlen($ciudadId) == 1)
			{
				$ciudadId = '00'.$ciudadId;
			
			}elseif(strlen($ciudadId) == 2){

				$ciudadId = '0'.$ciudadId;

			}

			$result = [

				'cp' => $cp,
				'ciudad' => $results[0]['CP']['cd'],
				'ciudad_id' => $ciudadId,
				'estado' => $results[0]['CP']['edo'],
				'estado_id' => $estadoId,
				'colonias' => []
	 
			];

			foreach($results as $k => $r)
			{
				$result['colonias'][] = $r['CP']['asenta'];
			}

			echo json_encode($result);

		}
	}



	function _calculaPagos($cotizacion,$tasas)
	{

		$cotizacionFinal = [];

		$tiposPago = [
			'sem' => 2,
			'cuatri' => 3,
			'trim' =>4,
		];

		foreach($cotizacion as $k => $c)
		{
			$cotizacionFinal[$k] = [];

			$cotizacionFinal[$k]['contado'] = $c['primatotal'];

			$precio_mensual = ($c['primatotal']/$tasas['Tasa']['iva']) - $tasas['Tasa']['emision'];

			foreach($tiposPago as $k_t => $t)
			{	

				$pago_calculado = ($precio_mensual*$tasas['Tasa'][$k_t])/$t;

				$cotizacionFinal[$k][$k_t] = [

					
					'inicial' => ($pago_calculado+$tasas['Tasa']['emision'])*$tasas['Tasa']['iva'],
					
					'subsecuente' => ($pago_calculado*$tasas['Tasa']['iva'])
				];	

				$cotizacionFinal[$k]['TDC'] = $c['primatotal']/12;				

			} 

		}

		return $cotizacionFinal;
	}

}
