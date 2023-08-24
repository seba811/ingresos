<?php
class actaactivo{

	private $id;
	private $qbiz_nombre;
    private $qbiz_apellidop;
    private $qbiz_apellidom;
    private $banco_qbiz;
    private $cta_banco_qbiz;
    private $prevision_qbiz;
    private $salud_qbiz;
    private $estudios_qbiz;
    private $nacionalidad_qbiz;
    private $sexo_qbiz;
    private $edad_qbiz;
    private $estado_civil_qbiz;
    private $direccion_qbiz;
    private $comuna_qbiz;
    private $telefono_qbiz;
    private $correo_qbiz;
    private $pre_faena;
    private $pre_faena_cod;
    private $pre_area;
    private $pre_cargo;
    private $pre_turno;
    private $pre_exemple; // no encontradso en bd
    private $pre_temporadas;
    private $pre_emergencia_nombre;
    private $pre_emergencia_parentesco; // no encontradso en bd
    private $pre_emergencia_fono;
    private $pre_enfermedad;
    private $pre_enfermedad_detalle;
    private $pre_transportista;
    private $pre_transportista_nombre;

    //EXTRAS
    private $ciudad_qbiz;
	
	
	public function __construct(
        
        $id, 
        $qbiz_nombre, 
        $qbiz_apellidop,
        $qbiz_apellidom, 
        $banco_qbiz, 
        $cta_banco_qbiz,
        $prevision_qbiz, 
        $salud_qbiz, 
        $estudios_qbiz,
        $nacionalidad_qbiz, 
        $sexo_qbiz, 
        $edad_qbiz,
        $estado_civil_qbiz, 
        $direccion_qbiz, 
        $comuna_qbiz,
        $telefono_qbiz, 
        $correo_qbiz, 
        $pre_faena,
        $pre_faena_cod, 
        $pre_area, 
        $pre_cargo,
        $pre_turno, 
        $pre_exemple, 
        $pre_temporadas, 
        $pre_emergencia_nombre, 
        $pre_emergencia_parentesco, 
        $pre_emergencia_fono, 
        $pre_enfermedad, 
        $pre_enfermedad_detalle,
        $pre_transportista, 
        $pre_transportista_nombre
        
        ){
            
		$this->id = $id;
        $this->qbiz_nombre = $qbiz_nombre;
        $this->qbiz_apellidop = $qbiz_apellidop;
        $this->qbiz_apellidom = $qbiz_apellidom;
        $this->banco_qbiz = $banco_qbiz;
        $this->cta_banco_qbiz = $cta_banco_qbiz;
        $this->prevision_qbiz = $prevision_qbiz;
        $this->salud_qbiz = $salud_qbiz;
        $this->estudios_qbiz = $estudios_qbiz;
        $this->nacionalidad_qbiz = $nacionalidad_qbiz;
        $this->sexo_qbiz = $sexo_qbiz;
        $this->edad_qbiz = $edad_qbiz;
        $this->estado_civil_qbiz = $estado_civil_qbiz;
        $this->direccion_qbiz = $direccion_qbiz;
        $this->comuna_qbiz = $comuna_qbiz;
        $this->telefono_qbiz = $telefono_qbiz;
        $this->correo_qbiz = $correo_qbiz;
        $this->pre_faena = $pre_faena;
        $this->pre_faena_cod = $pre_faena_cod;
        $this->pre_area = $pre_area;
        $this->pre_cargo = $pre_cargo;
        $this->pre_turno = $pre_turno;
        $this->pre_exemple = $pre_exemple; // no encontradso en bd
        $this->pre_temporadas = $pre_temporadas;
        $this->pre_emergencia_nombre = $pre_emergencia_nombre;
        $this->pre_emergencia_parentesco = $pre_emergencia_parentesco; // no encontradso en bd
        $this->pre_emergencia_fono = $pre_emergencia_fono;
        $this->pre_enfermedad = $pre_enfermedad;
        $this->pre_enfermedad_detalle = $pre_enfermedad_detalle;
        $this->pre_transportista = $pre_transportista;
        $this->pre_transportista_nombre = $pre_transportista_nombre;

	}
	
	public function getId(){
		return $this->id;
	}
	public function getqbiz_nombre(){
		return $this->qbiz_nombre;
	}
    public function getqbiz_apellidop(){
		return $this->qbiz_apellidop;
	}
	public function getqbiz_apellidom(){
		return $this->qbiz_apellidom;
	}
    public function getbanco_qbiz(){
		return $this->banco_qbiz;
	}
	public function getcta_banco_qbiz(){
		return $this->cta_banco_qbiz;
	}
    public function getprevision_qbiz(){
		return $this->prevision_qbiz;
	}
	public function getsalud_qbiz(){
		return $this->salud_qbiz;
	}
    public function getestudios_qbiz(){
		return $this->estudios_qbiz;
	}
	public function getnacionalidad_qbiz(){
		return $this->nacionalidad_qbiz;
	}
    public function getsexo_qbiz(){
		return $this->sexo_qbiz;
	}
	public function getedad_qbiz(){
		return $this->edad_qbiz;
	}
    public function getestado_civil_qbiz(){
		return $this->estado_civil_qbiz;
	}
	public function getdireccion_qbiz(){
		return $this->direccion_qbiz;
	}
    public function getcomuna_qbiz(){
		return $this->comuna_qbiz;
	}
	public function gettelefono_qbiz(){
		return $this->telefono_qbiz;
	}
    public function getcorreo_qbiz(){
		return $this->correo_qbiz;
	}
	public function getpre_faena(){
		return $this->pre_faena;
	}
    public function getpre_faena_cod(){
		return $this->pre_faena_cod;
	}
	public function getpre_area(){
		return $this->pre_area;
	}
    public function getpre_cargo(){
		return $this->pre_cargo;
	}
	public function getpre_turno(){
		return $this->pre_turno;
	}
    public function getpre_exemple(){
		return $this->pre_exemple;
	}
	public function getpre_temporadas(){
		return $this->pre_temporadas;
	}
    public function getpre_emergencia_nombre(){
		return $this->pre_emergencia_nombre;
	}
	public function getpre_emergencia_parentesco(){
		return $this->pre_emergencia_parentesco;
	}
    public function getpre_emergencia_fono(){
		return $this->pre_emergencia_fono;
	}
	public function getpre_enfermedad(){
		return $this->pre_enfermedad;
	}
    public function getpre_enfermedad_detalle(){
		return $this->pre_enfermedad_detalle;
	}
	public function getpre_transportista(){
		return $this->pre_transportista;
	}
    public function getpre_transportista_nombre(){
		return $this->pre_transportista_nombre;
	}


}
?>