<h1>Informe configuración codeigniter 3.</h1>

<h2>Preparando entorno cloud 9.</h2>

Se selecciona la el workspace con los php, Apache & Mysql precargado.
Se agrada la carpeta de codeigniter al workspace de c9 (Fliles->Upload local file).
Por defecto para acceder al mySql desde c9 el usuario es tu nombre de usuario de c9, la contraseña vacía. Para poner contraseña se debe ingresar las siguientes línea de código dentro de mysql:
```
SET PASSWORD FOR 'myUser'@'%' = PASSWORD('test'); 
```

En la carpeta config en el archivo database.php ingresamos los datos de configuración de nuestra base de datos.
```
'hostname' => 'localhost',
'username' => 'tunombredesusario',//ingresar tu usuario de C9
'password' => '1234',
'database' => 'c9',
'dbdriver' => 'mysqli',
```
Dentro de la carpeta de grosery CRUD hay un archivo de ejemplo que para realizar un tabla de actores con los siguientes campos.
```
CREATE TABLE IF NOT EXISTS `actor` (
  `actor_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(250) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`actor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=201 ;
```
<h2> Agregando archivos de Grosery CRUD al proyecto. </h2>

Cuando descargamos la carpeta Grosery CRUD dentro de ella habrá una carpeta llamada aplicación, dentro de esa carpeta harpa  las carpetas correspondientes a un proyecto de codeigniter (application) donde solo habrá los archivos correspondientes a grosery crud, pegamos cada uno de esos archivo en su carpeta correspondiente a nuestro proyecto.

Creamos un archivo Main.php donde pegamos el siguiente código:
```
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
    }
public function index(){
        echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        die();
    }
public function actor(){
        $crud = new grocery_CRUD();
        $crud->set_table('actor');
        $output = $this->grocery_crud->render();
 
        //echo "<pre>";
        //print_r($output);
        //echo "</pre>";
        //die();
        $this->_view_output($output);
    }
    function _view_output($output = null){
         $this->load->view('ViewActors.php',$output); 
    }

}

```
Si corremos el proyecto con el botón  en c9 y abrimos la direcion de nuestro proyecto https://practicacodeigniter-nombredeusuario.c9users.io/codeigniter/index.php/main/ debemos ver lo que se muestra en la funcion index del archivo Main.php. Si a la anterior dirección le agregamos el nombre de la función debemos poder ver los atributos del objeto stdClass Object

 <h2>Creación vista para visualización de valores de tabla actor.</h2>
 
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" /> 
<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?> 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover{
    text-decoration: underline;
}
</style>
</head>
<body>
<!-- Beginning header -->
    <div>
        <a href='<?php echo site_url('Main/')?>'>Inicio</a> | 
        <a href='<?php echo site_url('Main/actor')?>'>Actores</a> |
    </div>
<!-- End of header-->
    <div style='height:20px;'></div>  
    <div>
<?php echo $output; ?>
 
    </div>
<!-- Beginning footer -->
<div>Footer</div>
<!-- End of Footer -->
</body>
</html>
```
Con el código anterior creamos la vista, con la variable $css_files traemos los estilo que implementa grocery crud, y con la variable $js_files el javascrip. obtenemos la siguiente vista.



Algo interesante que podemos notar, es la forma como se gestionan las vistas, en vez de pasar la dirección del archivo con la vista, lo que se hace es llamar la vista desde una funcion desde el controlador .
 ```
<a href='<?php echo site_url('Main/')?>'>Inicio</a> 
<a href='<?php echo site_url('Main/actor')?>'>Actores</a> 
 ```
Además no es necesario crear una vista para quedar tabla que realicemos bastaría solo con enviar el $output con la tabla que queremos que se visualice, lo que ahorra tiempo, esto como se muestra en la siguientes líneas.

```
public function category(){
    $crud = new grocery_CRUD();//creamos objeto CRUD
    $crud -> set_table('category');// indicamos la tabla que se quiere consultar
    $output = $crud->render(); // en la variable de salida agregamos 
                                //el objeto que será mostrado.
   $this->_view_output($output);
    
}
    function _view_output($output = null){
         $this->load->view('ViewActors.php',$output); 
    }
} 
```
Como la función category usa la misma función  _view_output() de la función actor con lo que obtenemos la siguiente vista.


Con la función $crud -> set_subject('Category'); le indicamos mostramos el nombre del los registros es decir, que ya no nos aparecerá el el String por defecto Record sino que tendremos el nombre de nuestro registro Category.

Con la función $crud -> columns(); recibe un string con la columna que queremo traer, y con la función  $crud->display_as('nombreCampo','nombreMostrado'); le asignamos el nombre que queremos que tenga ese campo en nuestra vista.

```
        $crud -> columns('fullname','last_update');
        $crud->display_as('fullname','Nombre completo');
        $crud->display_as('last_update','Última actualización');
```


Con las funciones $crud->add_fields('nombreCampo1',nombreCampo2); $crud->edit_fields('nombreCampo1','nombreCampo2'); y $crud->required_fields('fullname'); seleccionamos los campo que el usuario puede agregar, editar respectivamente y los campo requeridos. 

En nuestro caso para la tabla actores solo agregaremos el nombre obligatoriamente, pero al modificar podremos modificar la última actualización como ejemplo.
```
        $crud->add_fields('fullname');
        $crud->edit_fields('fullname','last_update');
        $crud->required_fields('fullname');
```

Con las funciones unset_add, unset_edit,unset_delete y  unset_operations
 hacemos que en la vista no se pueda agregar, editar, borrar y ningunas de las anteriores. Además con unset_columns(‘columna1’,columna2) especificamos que columnas no queremos que aparezcan en la vista principal 
