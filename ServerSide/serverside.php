<?php
session_start();

$usuario_id = $_SESSION['usuario_id'];
$tipo = $_SESSION['usuario_tipo'];





if (isset($_GET['filtro'])) {
	$valor = $_GET['filtro'];

} else {
	$valor = -1;
}





define("HOST_SS", "10.10.1.12");
define("DATABASE_SS", "bd_contratacion");
define("USER_SS", "admin");
define("PASSWORD_SS", "prize2019");



class TableData
{

	private $_db;
	public function __construct()
	{
		try {
			$host = HOST_SS;
			$database = DATABASE_SS;
			$user = USER_SS;
			$passwd = PASSWORD_SS;

			$this->_db = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $passwd, array(
					PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			)
			);
		} catch (PDOException $e) {
			error_log("Failed to connect to database: " . $e->getMessage());
		}
	}
	public function get($table, $index_column, $columns)
	{

		global $valor, $usuario_id, $tipo;


		// Paging
		$sLimit = "";
		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
			$sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
		}

		// Ordering
		$sOrder = "preingresos_fecha_registros";
		if (isset($_GET['iSortCol_0'])) {
			$sOrder = "ORDER BY  ";
			for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
				if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
					$sortDir = (strcasecmp($_GET['sSortDir_' . $i], 'ASC') == 1) ? 'ASC' : 'DESC';
					$sOrder .= "`" . $columns[intval($_GET['iSortCol_' . $i])] . "` " . $sortDir . ", ";
				}
			}

			$sOrder = substr_replace($sOrder, "", -2);
			if ($sOrder == "ORDER BY") {
				$sOrder = "";
			}
		}


		if ($tipo == 0 || $tipo == 5) {

			$usuario_filtro =' ';
			$usuario_filtro2 = ' ';
			$usuario_filtro3 = ' ';

		} else {
			$usuario_filtro = ' and preingresos_usuario_id='. $usuario_id;
			$usuario_filtro2 = 'preingresos_usuario_id='. $usuario_id;
			$usuario_filtro3 = ' where preingresos_usuario_id='. $usuario_id;
		}



		if ($valor == 0) {

			$condicion1 = 'preingresos_estado=0 '.$usuario_filtro;
			$condicion2 = 'and preingresos_estado=0 '.$usuario_filtro;
			$condicion3 = 'where preingresos_estado=0 '.$usuario_filtro;

		} else if ($valor == 1) {

			$condicion1 = 'preingresos_estado=1 '.$usuario_filtro;
			$condicion2 = 'and preingresos_estado=1 '.$usuario_filtro;
			$condicion3 = 'where preingresos_estado=1 '.$usuario_filtro;

		} else if ($valor == 2) {

			$condicion1 = 'preingresos_estado=2 '.$usuario_filtro;
			$condicion2 = 'and preingresos_estado=2 '.$usuario_filtro;
			$condicion3 = 'where preingresos_estado=2 '.$usuario_filtro;

		} else if ($valor == 3) {

			$condicion1 = 'preingresos_estado=3 '.$usuario_filtro;
			$condicion2 = 'and preingresos_estado=3 '.$usuario_filtro;
			$condicion3 = 'where preingresos_estado=3 '.$usuario_filtro;

		} else if ($valor == -1) {

			$condicion1 = ' '.$usuario_filtro2;
			$condicion2 = ' '.$usuario_filtro;
			$condicion3 = ' '.$usuario_filtro3;

		}




		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = $condicion3;



		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
			$sWhere = "WHERE (";
			for ($i = 0; $i < count($columns); $i++) {
				if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
					$sWhere .= "`" . $columns[$i] . "` LIKE :search OR ";
				}
			}
			$sWhere = substr_replace($sWhere, "", -3);
			$sWhere .= ')';
		}

		// Individual column filtering
		for ($i = 0; $i < count($columns); $i++) {
			if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
				if ($sWhere == "") {
					$sWhere = "WHERE ";
				} else {
					$sWhere .= " AND ";
				}
				$sWhere .= "`" . $columns[$i] . "` LIKE :search" . $i . " " . $condicion1;
			}
		}

		// SQL queries get data to display
		$sQuery = "SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $columns)) . "`,preingresos_id FROM `" . $table . "` " . $sWhere . " " . $condicion2 . "  " . $sOrder . " " . $sLimit;
		$statement = $this->_db->prepare($sQuery);

		// Bind parameters
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
			$statement->bindValue(':search', '%' . $_GET['sSearch'] . '%', PDO::PARAM_STR);
		}
		for ($i = 0; $i < count($columns); $i++) {
			if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
				$statement->bindValue(':search' . $i, '%' . $_GET['sSearch_' . $i] . '%', PDO::PARAM_STR);
			}
		}

		$statement->execute();
		$rResult = $statement->fetchAll();

		$iFilteredTotal = current($this->_db->query('SELECT FOUND_ROWS()')->fetch());

		// Traer el total de row de la tabla
		$sQuery = "SELECT COUNT(`" . $index_column . "`) FROM `" . $table . "`" . $condicion3 . "";
		$iTotal = current($this->_db->query($sQuery)->fetch());

		// Output
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);

		// Return array of values
		foreach ($rResult as $aRow) {

			$row = array();
			for ($i = 0; $i < count($columns); $i++) {


				$id = $aRow['preingresos_id'];

				if ($columns[$i] == "preingresos_estado") {
					// Special output formatting for 'version' column
					if ($aRow[$columns[$i]] == 0) {

						$row[] = "
						  <a title='Modificar' href='preingresos_modificar?id=$id'>
							<i width='50' height='50' class='bi bi-check-circle fa-2x' style='font-size: 1.5rem; margin-left:10px;color: green'></i>
						  </a>
						  <a title='Eliminar' href='preingresos_eliminar.php?id=$id' onclick='javascript: return confirm('¿Desea Eliminar Este Usuario?');'>
						  <i class='bi bi-trash-fill fa-2x ' style='font-size: 1.5rem;margin-left:10px;color:red'></i>
		  
						</a>
						";
					} else if ($aRow[$columns[$i]] == 1) {
						$row[] = "
						<a title='Modificar' href='preingresos_modificar?id=$id'>
						  <i width='50' height='50' class='bi bi-exclamation-circle-fill fa-2x' style='font-size: 1.5rem; margin-left:10px;color: orange'></i>
						</a>
						<a title='Eliminar' href='preingresos_eliminar.php?id=$id' onclick='javascript: return confirm('¿Desea Eliminar Este Usuario?');'>
						<i class='bi bi-trash-fill fa-2x ' style='font-size: 1.5rem;margin-left:10px;color:red'></i>
		
					  </a>
					  ";
					} else if ($aRow[$columns[$i]] == 2) {
						$row[] = "
						<a title='Modificar' href='preingresos_modificar?id=$id'>
						  <i width='50' height='50' class='bi bi-check-circle-fill fa-2x' style='font-size: 1.5rem; margin-left:10px;color: blue'></i>
						</a>
						<a title='Eliminar' href='preingresos_eliminar.php?id=$id' onclick='javascript: return confirm('¿Desea Eliminar Este Usuario?');'>
						<i class='bi bi-trash-fill fa-2x ' style='font-size: 1.5rem;margin-left:10px;color:red'></i>
		
					  </a>
					  ";
					} else if ($aRow[$columns[$i]] == 3) {
						$row[] = "
						<a title='Modificar' href='preingresos_modificar?id=$id'>
						  <i width='50' height='50' class='bi bi-check-circle-fill fa-2x' style='font-size: 1.5rem; margin-left:10px;color: green'></i>
						</a>
						<a title='Eliminar' href='preingresos_eliminar.php?id=$id' onclick='javascript: return confirm('¿Desea Eliminar Este Usuario?');'>
						<i class='bi bi-trash-fill fa-2x ' style='font-size: 1.5rem;margin-left:10px;color:red'></i>
		
					  </a>
					  ";
					} else {
						$row[] = 'holaa';
					} //$row[] = ($aRow[ $columns[$i] ]=="0") ? '-' : $aRow[ $columns[$i] ];
				} else if ($columns[$i] != ' ') {
					$row[] = $aRow[$columns[$i]];
				}
			}
			$output['aaData'][] = $row;
		}

		echo json_encode($output);
	}
}
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate');
// Create instance of TableData class
$table_data = new TableData();

$table_data->get('preingresos', 'preingresos_id', array('preingresos_fecha_registro', 'preingresos_nombre', 'preingresos_apellidop', 'preingresos_rut', 'preingresos_empresa', 'preingresos_usuario', 'preingresos_estado'));
?>