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
	


//---------------------------------------------- Registrtos ----------------------------------------------------------------


	public function ObtenerDatosPersonas($rut){

		$this->conexion();

		$tipopro;
		$sqlpro = "SELECT * FROM preingresos where preingresos_rut = '$rut'";
		//$sttemp = $this->mi->query($sqlpro);
		$sttemp = $this->mi->query($sqlpro);
		return $sttemp;
		
		$this->desconexion();

	}






//termino de clase DAO
}

?>