<?php


App::uses('AppController', 'Controller');


class SiteController extends AppController {


	public $uses = array();

	public $components = array('Email');


	public function index() {
		
		$this->layout = 'ana';

	}

	public function sendCotizacion()
	{
		$data = $this->data;

		$this->autoRender = false;
		$this->set(compact('data'));
		$this->Email->from = 'ANA Seguros<mekate_1@corpasin.com.mx>';
        $this->Email->to = $data['datos']['email'];
        $this->Email->subject = 'Cotizacon';
        $this->Email->sendAs = 'html';
        $this->Email->template = 'cotizacion';
		$this->Email->send();

	}

	public function sendFax()
	{
		$data = $this->data;

		$this->autoRender = false;
		$this->set(compact('data'));
		$this->Email->from = 'ANA Seguros<mekate_1@corpasin.com.mx>';
        $this->Email->to = 'iram@clicker360.com';
        $this->Email->subject = 'Enviar cotización por fax';
        $this->Email->sendAs = 'html';
        $this->Email->template = 'fax';
		$this->Email->send();

	}
}