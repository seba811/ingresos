<?php
class Dao{

	private function conexion(){
		$this->mi = new MySQLi("10.10.1.12", "admin","prize2019", "reclutamiento");
		//$this->mi = new MySQLi('localhost','root','admin','reclutamiento');
			if($this->mi->connect_errno){
			die('Error al Conectarse' .$this->mi->connect_error);
		}
		
	}
	
	public function desconexion(){
		$this->mi->close();
		//mysqli_close( $conexion );
	}
	


//--------------------------------------------------------------------------------------------------------------


	public function ObtenerDatosPersonas($rut){

		$this->conexion();

		$tipopro;
		$sqlpro = "SELECT * FROM inscripcion where rut = '$rut'";
		//$sttemp = $this->mi->query($sqlpro);
		$rssql = $this->mi->query($sqlpro);
		while($rstemp = $rssql->fetch_array(MYSQLI_BOTH)){
		
			$idinscripcion = $rstemp['idinscripcion'];
			$rut = $rstemp['rut'];
			$nombre = $rstemp['nombre'];
			$apellidoP = $rstemp['apellidoP']; 
			$apellidoM = $rstemp['apellidoM'];
			$nacimiento = $rstemp['nacimiento'];
			$sexo = $rstemp['sexo'];
			$direccion = $rstemp['direccion']; 
			$comuna = $rstemp['comuna'];
			$fono = $rstemp['fono'];
			$estadoCivil = $rstemp['estadoCivil'];
			$correo = $rstemp['correo']; 
			$estudios = $rstemp['estudios'];
			$turno = $rstemp['turno'];
			$contactoEmergencia = $rstemp['contactoEmergencia'];
			$fonoEmergencia = $rstemp['fonoEmergencia'];
			$discapacidad = $rstemp['discapacidad'];
			$trabajoAntes = $rstemp['trabajoAntes'];
			$experienciaCerezas = $rstemp['experienciaCerezas'];
			$areasExperiencia = $rstemp['areasExperiencia'];
			$situacionMigratoria = $rstemp['situacionMigratoria'];
			$empresa = $rstemp['empresa'];
			$tallaRopa = $rstemp['tallaRopa'];
			$tallaCalzado = $rstemp['tallaCalzado'];
			$fechaIngreso = $rstemp['fechaIngreso'];
			$preferenciaTurno = $rstemp['preferenciaTurno'];
			$tipoContrato = $rstemp['tipoContrato'];
			$faena = $rstemp['faena'];
			$faenaCod = $rstemp['faenaCod'];
			$transportista = $rstemp['transportista'];
			$transportistaNombre = $rstemp['transportistaNombre'];
			$usuario = $rstemp['usuario'];
			$area = $rstemp['area'];
			$tipoInscripcion = $rstemp['tipoInscripcion'];
			$nombreInscripcion = $rstemp['nombreInscripcion'];
			$enfermedadCronica = $rstemp['enfermedadCronica'];
			$enfermedadDetalle = $rstemp['enfermedadDetalle'];
			$banco = $rstemp['banco'];
			$ctaBanco = $rstemp['ctaBanco']; 
			$nacionalidad = $rstemp['nacionalidad'];
			$prevision = $rstemp['prevision'];
			$salud = $rstemp['salud'];
			$cargo = $rstemp['cargo'];
			$estado = $rstemp['estado'];
			$c_temporadas = $rstemp['c_temporadas'];
			$tipo_contrato = $rstemp['tipo_contrato'];
			$fechaInscripcion = $rstemp['fechaInscripcion'];
			$datospersona = new persona(
        
				$idinscripcion,
				$rut,
				$nombre,
				$apellidoP, 
				$apellidoM,
				$nacimiento,
				$sexo,
				$direccion, 
				$comuna,
				$fono,
				$estadoCivil,
				$correo, 
				$estudios,
				$turno,
				$contactoEmergencia,
				$fonoEmergencia,
				$discapacidad,
				$trabajoAntes,
				$experienciaCerezas,
				$areasExperiencia,
				$situacionMigratoria,
				$empresa,
				$tallaRopa,
				$tallaCalzado,
				$fechaIngreso,
				$preferenciaTurno,
				$tipoContrato,
				$faena,
				$faenaCod,
				$transportista,
				$transportistaNombre,
				$usuario,
				$area,
				$tipoInscripcion,
				$nombreInscripcion,
				$enfermedadCronica,
				$enfermedadDetalle,
				$banco,
				$ctaBanco, 
				$nacionalidad,
				$prevision,
				$salud,
				$cargo,
				$estado,
				$c_temporadas,
				$tipo_contrato,
				$fechaInscripcion
				
				);
		}
		return $productoobtenido;
		
		$this->desconexion();

	}



	/*
	
	public function ObtenerDatosPersonas($rut){

		$this->conexion();

		$tipopro;
		$sqlpro = "SELECT * FROM preingresos where preingresos_rut = '$rut'";
		//$sttemp = $this->mi->query($sqlpro);
		$sttemp = $this->mi->query($sqlpro);
		while($rstemp = $stidpro->fetch_array(MYSQLI_BOTH)){
		
			$idproducto       = $rstemp[0];
			$tipoproducto     = $rstemp[1];
			int= $rstemp[0];
			rut = $rstemp[0];
			nombre = $rstemp[0];
			apellidoP = $rstemp[0]; 
			apellidoM = $rstemp[0];
			nacimiento = $rstemp[0];
			sexo = $rstemp[0];
			direccion = $rstemp[0]; 
			comuna = $rstemp[0];
			fono = $rstemp[0];
			estadoCivil = $rstemp[0];
			correo = $rstemp[0]; 
			estudios = $rstemp[0];
			turno = $rstemp[0];
			contactoEmergencia = $rstemp[0];
			fonoEmergencia = $rstemp[0];
			discapacidad = $rstemp[0];
			trabajoAntes = $rstemp[0];
			experienciaCerezas = $rstemp[0];
			areasExperiencia = $rstemp[0];
			situacionMigratoria = $rstemp[0];
			empresa = $rstemp[0];
			tallaRopa = $rstemp[0];
			tallaCalzado = $rstemp[0];
			fechaIngreso = $rstemp[0];
			preferenciaTurno = $rstemp[0];
			tipoContrato = $rstemp[0];
			faena = $rstemp[0];
			faenaCod = $rstemp[0];
			transportista = $rstemp[0];
			transportistaNombre = $rstemp[0];
			usuario = $rstemp[0];
			area = $rstemp[0];
			tipoInscripcion = $rstemp[0];
			nombreInscripcion = $rstemp[0];
			enfermedadCronica = $rstemp[0];
			enfermedadDetalle = $rstemp[0];
			banco = $rstemp[0];
			ctaBanco = $rstemp[0]; 
			nacionalidad = $rstemp[0];
			prevision = $rstemp[0];
			salud = $rstemp[0];
			cargo = $rstemp[0];
			estado = $rstemp[0];
			c_temporadas = $rstemp[0];
			tipo_contrato = $rstemp[0];
			fechaInscripcion = $rstemp[0];
			$productoobtenido = new producto($idproducto, null, null, null, $tipoproducto);
		}
		return $productoobtenido;
		
		$this->desconexion();

	}
	
	*/



//termino de clase DAO
}

?>