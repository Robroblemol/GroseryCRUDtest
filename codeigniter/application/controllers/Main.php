<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
function __construct()
    {
        parent::__construct();
 
        $this->load->database();
        $this->load->helper('url');//este objeto permite cargar las url

        $this->load->library('grocery_CRUD');
 
    }
 
public function index()
    {
     ?>   <div>
            <a href='<?php echo site_url('Main/')?>'>Inicio</a> | 
            <a href='<?php echo site_url('Main/actor')?>'>Actores</a> 
            <a href='<?php echo site_url('Main/category')?>'>Cartegorias</a>
            <a href='<?php echo site_url('Main/tarea')?>'>Tarea</a> 
        </div>
       <?php
        echo "<h1>Probando Codeigniter</h1>";//Just an example to ensure that we get into the function
        die();
    }

public function actor(){
        $crud = new grocery_CRUD();
        $crud -> set_subject('Actor');
        $crud->set_table('actor');
        $crud -> columns('fullname','last_update');
        $crud->display_as('fullname','Nombre completo');//muestra alias
        $crud->display_as('last_update','Última actualización');
        $crud->add_fields('fullname');//campo a agregar 
        $crud->edit_fields('fullname','last_update');
        $crud->required_fields('fullname');//campo obligatorio
        $crud->unset_delete(); //para que no se pueda borrar
        $output = $crud->render();
        //$output = $this->grocery_crud->render();
 
        //echo "<pre>";
        //print_r($output);
        //echo "</pre>";
        //die();
        $this->_view_output($output); 
    }
public function category(){
    
    $crud = new grocery_CRUD();//creamos objeto CRUD
    $crud -> set_subject('Categoria');
    $crud -> set_table('category');// indicamos la tabla que se quiere consultar
    $crud -> columns('name');
    $crud -> fields('name');
    $crud->display_as('name','Nombres');
    $output = $crud->render(); // en al variable de salida agregamos 
                                //el objeto que será mostrado.
    $this->_view_output($output);
    
}
public function tarea(){
    $crud = new grocery_CRUD();//creamos objeto CRUD
    $crud -> set_subject('Examenes');
    $crud -> set_table('examens');
    $crud -> columns('id_student','id_subject','exam_name','score','date');
    $crud->display_as('exam_name','Nombre prueba');
    $crud->display_as('date','Fecha');
    $crud->display_as('id_subject','Materia');
    $crud->display_as('score','Calificación');
    $crud->set_relation('id_subject', 'subjects', '{name}');
    $crud->set_relation('id_student', 'students', '{name}');
    $crud->display_as('id_student','Estudiante');
    $crud->unset_delete();//no borrrado
    $crud->add_fields('score','id_subject','id_student','exam_name');
    $crud->required_fields('exam_name','id_student','id_subject','score');
    
    $output = $crud->render(); // en al variable de salida agregamos 
    $this->_view_output($output);
    
    
}
    function _view_output($output = null){
        
        $this->load->view('ViewFrom.php',$output); 
   
    }
} 



 
 
/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
 