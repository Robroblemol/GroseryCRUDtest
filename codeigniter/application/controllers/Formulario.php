<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Formulario extends CI_Controller {

    public function index()
    {
        $data = array('titulo' => 'Formulario');
        $this->load->view('formulario_view.php', $data);
    }

    public function validar()
    {
        //recibo todo los datos que vienen  del formulario.
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_message('required','El campo %s es obligatorio');
        
        if ($this->form_validation->run() == FALSE){
                $this->index();
            }
        else {
                echo "Todos los datos estan OK! ".$this->input->post('nombre')."     ".$this->input->post('apellido');
            }
        }
    }

/*  End of file formulario.php  */
/*  Location: ./application/controllers/formulario.php  */

