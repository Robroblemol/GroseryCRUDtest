<!DOCTYPE html>
<html>
	<head>
		<title><?=$titulo?></title>
	</head>
	<body>
		<h1>Mi	Formulario</h1>
		<?=form_open(base_url().'index.php/formulario/validar',array('name'=>'form','id'=>'form'));?>
		<?=form_label('Nombre','nombre');?>:
		<?=form_input('nombre');?><br/>
		<?=form_label('Apellido','apellido');?>:
		<?=form_input('apellido');?><br/>
		<?=form_submit('enviar','Enviar')?>
		<?=form_close();?><br/>	
		
		<hr>
		
		<h4>Posibles Errores</h4>
		<?=	validation_errors();?>
	</body>
</html>