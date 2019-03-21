<?php
public funtion index(){
    $data["nombre"] = "roberto david ";
    $data["apellidos"] = "Robles Molina";
    $data["profesion"] = "ingeniero";
    $data["empresa"] = "salven a los velociraptor org";
    $this->load->view('welcome_menssages',data);
}
