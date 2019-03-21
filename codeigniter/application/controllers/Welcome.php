<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data["nombres"] = "Roberto David ";
		$data["apellidos"] = "Robles Molina";
		$data["profesion"] = "Ingeniero de Sistemas";
		$data["empresa"] = "Universidad Cooperativa de Colombia Sede Cali";

		$this->load->view('welcome_message',$data);
	}
}
