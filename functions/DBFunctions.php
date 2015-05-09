<?

class DBFunctions
{
	protected $connection;
	protected $db;
	
	function __construct() 
	{
		$connection = mysql_connect('localhost', 'root', '') or die('Non connesso al DB Server : ' . mysql_error());
		$db = mysql_select_db('petgestdb', $connection) or die ('Non connesso al DataBase di petGest : ' . mysql_error());			
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function insertRows($table,$rows)
	{
		$values = array_map('mysql_real_escape_string', array_values($rows));
		$keys = array_keys($rows);
		
		foreach ($values as $key=>$val)
			$values[$key] = $this->parseNull($val);
       
		return mysql_query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES ('.implode(',', $values).')');
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function insertViewRows($table,$rows,$columns,$id)
	{	
		$i = 0;
		foreach ($columns as $val)
		{
			$keys[$i++] = $val['name'];
		}
		foreach ($rows as $key=>$val)
		{
			if($val != null)
			{
				$values = array_map('mysql_real_escape_string', array_values(array($id,$val)));
				echo 'INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES ('.implode(',', $values).')';
				mysql_query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES ('.implode(',', $values).')');
			}
		} 
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function updateRows($table,$rows)
	{
		$values = array_map('mysql_real_escape_string', array_values($rows));
		$keys = array_keys($rows);
		$query = '';
		
		foreach ($values as $key=>$val)
		{
			$val = $this->parseNull($val);
			if($keys[$key] != 'ID' and $key < count($values)-1 )
				$query .= ' `'.$keys[$key].'` = '.$val.',';
			else if ($keys[$key] != 'ID')
				$query .= ' `'.$keys[$key].'` = '.$val;
				
		}
		
		return mysql_query('UPDATE `'.$table.'` SET '.$query.' WHERE `ID` = '.$rows['ID']);
	}

	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function deleteRow($table,$rows)
	{	
		return mysql_query('DELETE  FROM`'.$table.'` WHERE `ID` = '.$rows['ID']);
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function deleteOtherRows($table,$column,$id)
	{	
		return mysql_query('DELETE  FROM`'.$table.'` WHERE `'.$column.'` = '.$id);
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function deleteRows($table,$id)
	{	
		return mysql_query('DELETE  FROM`'.$table.'` WHERE `ID` = '.$id);
	}

	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function getRows($table,$key,$column)
	{
		return mysql_query('SELECT * FROM `'.$table.'` WHERE `'.$column.'` LIKE \'%'.$key.'%\'');
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function getLastID($table)
	{
		$query = 'SELECT Auto_increment FROM information_schema.tables WHERE table_name = \''.$table.'\'';
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$lastid = $row['Auto_increment'];
				}
				return $lastid-1;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function getCustomRows($table,$key,$column,$customs)
	{
		return mysql_query('SELECT '.implode(',', $customs).' FROM `'.$table.'` WHERE `'.$column.'` LIKE \''.$key.'%\'');
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function getCustomPazienti($table,$key,$column,$customs)
	{
		return mysql_query('SELECT '.implode(',', $customs).' FROM `'.$table.'` WHERE `'.$column.'` = \''.$key.'\'');
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function getCustomVaccini($table,$key,$column,$customs)
	{
		return mysql_query('SELECT '.implode(',', $customs).' FROM `'.$table.'` WHERE `id_paziente` = \''.$key.'\' ORDER BY data_scadenza DESC');
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	/// RITORNA I DATI DI UN CLIENTE
	///
	//////////////////////////////////////////////////////////////////
	function getCliente($id)
	{
		$query = "SELECT * FROM clienti WHERE id = $id";
		$columns = $this->getAssocColumns('clienti');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$clienti = array_combine($columns,$row);
				}
				return $clienti;
			}
		}
	}
	
	function getClientiMail()
	{
		$query = "SELECT * FROM clienti WHERE mail not null";
		$columns = $this->getAssocColumns('mail');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$mail[] = array_combine($columns,$row);
				}
				return $mail;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	/// RITORNA I DATI DI UNA MAIL
	///
	//////////////////////////////////////////////////////////////////
	function getMail($id)
	{
		$query = "SELECT * FROM mail WHERE id = $id";
		$columns = $this->getAssocColumns('mail');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$mail = array_combine($columns,$row);
				}
				return $mail;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	/// RITORNA I DATI DI UN FORNITORE
	///
	//////////////////////////////////////////////////////////////////
	function getFornitore($id)
	{
		$query = "SELECT * FROM fornitori WHERE id = $id";
		$columns = $this->getAssocColumns('fornitori');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$fornitori = array_combine($columns,$row);
				}
				return $fornitori;
			}
		}
	}

	//////////////////////////////////////////////////////////////////	
	///
	/// RITORNA I DATI DI UN VACCINO
	///
	//////////////////////////////////////////////////////////////////
	function getVaccino($id)
	{
		$query = "SELECT * FROM vaccini WHERE id = $id";
		$columns = $this->getAssocColumns('vaccini');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$vaccino = array_combine($columns,$row);
				}
				return $vaccino;
			}
		}
	}
	
	function getAvvisi($data)
	{
		$query = "SELECT * FROM vaccini WHERE data_avviso = '$data' AND avviso = 2";
		$columns = $this->getAssocColumns('vaccini');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$vaccino[] = array_combine($columns,$row);
				}
				return $vaccino;
			}
		}
	}
	
	function getOperazioni($data)
	{
		$query = "SELECT * FROM operazioni WHERE data = '$data' AND tipo = 'inviomail'";
		$columns = $this->getAssocColumns('operazioni');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$operazione = array_combine($columns,$row);
				}
				return $operazione;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	/// RITORNA I DATI DI UN PAZIENTE
	///
	//////////////////////////////////////////////////////////////////
	function getPaziente($id)
	{
		$query = "SELECT * FROM pazienti WHERE id = $id";
		$columns = $this->getAssocColumns('pazienti');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$paziente = array_combine($columns,$row);
				}
				return $paziente;
			}
		}
	}
	
	function getPazienti($cliente)
	{
		$query = "SELECT * FROM pazienti WHERE id_cliente = $cliente";
		$columns = $this->getAssocColumns('pazienti');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$pazienti[] = array_combine($columns,$row);
				}
				return $pazienti;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	/// RITORNA I DATI DI UN ESAME CLINICO/GENERALE
	///
	//////////////////////////////////////////////////////////////////
	function getEsameGenerale($id)
	{
		$query = "SELECT * FROM esami_generali WHERE id = $id";
		$columns = $this->getAssocColumns('esami_generali');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$esame = array_combine($columns,$row);
				}
				return $esame;
			}
		}
	}
	
	function getEsameClinico($id)
	{
		$query = "SELECT * FROM esami_clinici WHERE id = $id";
		$columns = $this->getAssocColumns('esami_clinici');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$esame = array_combine($columns,$row);
				}
				return $esame;
			}
		}
	}
	
	function getEsameUrine($id)
	{
		$query = "SELECT * FROM esami_urine WHERE id = $id";
		$columns = $this->getAssocColumns('esami_urine');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$esame = array_combine($columns,$row);
				}
				return $esame;
			}
		}
	}
	
	function getEsami($paziente)
	{
		$esami = null;
		
		$clinici = "SELECT ID,data,'Esame Clinico' FROM esami_generali WHERE id_paziente = $paziente ORDER BY data desc";
		$urine = "SELECT ID,data,'Esame Urine' FROM esami_urine WHERE id_paziente = $paziente ORDER BY data desc";
		
		$columns = array('ID','data','tipo');
		
		if($result = mysql_query($clinici))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$esami[$row['data'].'.'.$row['ID'].'_clinico'] = array_combine($columns,$row);
				}
			}
		}
		
		if($result = mysql_query($urine))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$esami[$row['data'].'.'.$row['ID'].'_urine'] = array_combine($columns,$row);
				}
			}
		}
		
		if(!is_null($esami))
			krsort($esami);
		return $esami;
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////
	function getAmbulatorio($id)
	{
		$query = "SELECT * FROM ambulatorio WHERE ID = '1'";
		$columns = $this->getAssocColumns('ambulatorio');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$ambulatorio = array_combine($columns,$row);
				}
				return $ambulatorio;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	/// RITORNA I DATI DI UN PREVENTIVO
	///
	//////////////////////////////////////////////////////////////////
	function getPreventivo($id)
	{
		$query = "SELECT * FROM preventivi WHERE ID = $id";
		$columns = $this->getAssocColumns('preventivi');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$preventivi = array_combine($columns,$row);
				}
				return $preventivi;
			}
		}
	}
	
	function getPreventivi($cliente)
	{
		$query = "SELECT * FROM preventivi WHERE id_cliente = $cliente";
		$columns = $this->getAssocColumns('preventivi');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$preventivi[] = array_combine($columns,$row);
				}
				return $preventivi;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	/// RITORNA I DATI DI UNA FATTURA
	///
	//////////////////////////////////////////////////////////////////
	function getFattura($id)
	{
		$query = "SELECT * FROM fatture WHERE ID = $id";
		$columns = $this->getAssocColumns('fatture');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$fattura = array_combine($columns,$row);
				}
				return $fattura;
			}
		}
	}
	
	function getFatture($cliente)
	{
		$query = "SELECT * FROM fatture WHERE id_cliente = $cliente";
		$columns = $this->getAssocColumns('fatture');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$fatture[] = array_combine($columns,$row);
				}
				return $fatture;
			}
		}
	}
	
	function getFattureMese($anno,$mese,$columns)
	{
		$query = "SELECT ID,totale_imponibile,totale_IVA,totale_fattura,data,nome,cognome
					FROM fatture
					WHERE YEAR(data) = $anno AND MONTH(data) = $mese";
		return mysql_query($query);
	}
	
	function getPrestazioni($id,$tipo)
	{
		$query = "SELECT * FROM istanze_prestazioni WHERE id_riferimento = $id AND tipo = $tipo";
		$columns = $this->getAssocColumns('istanze_prestazioni');
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				$i=1;
				while($row = mysql_fetch_assoc($result))
				{
					$prestazioni[$i++] = array_combine($columns,$row);
				}
				return $prestazioni;
			}
		}
	}
		
	function getNumeroFattura($year)
	{
		$query = 'SELECT ID,YEAR(data_di_modifica) as year,numero_fattura FROM fatture ORDER by ID DESC LIMIT 1';
		
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					print_r($row);
					if($year > $row['year'])
						$numerofattura = 1;
					else
						$numerofattura = $row['numero_fattura']+1;
				}
				return $numerofattura;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////
	function getRegioni()
	{
		$query = "SELECT * FROM regioni ORDER BY regione";
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$regioni[] = array(
						'cod_regione' => $row['cod_regione'],
						'regione' => $row['regione']
					);
				}
				return $regioni;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////
	function getRegione($cod_regione)
	{
		$query = "SELECT * FROM regioni WHERE cod_regione = '".$cod_regione."' ORDER BY cod_regione";
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$regione = $row['regione'];
				}
				return $regione;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////
	function getProvincia($cod_provincia)
	{
		$query = "SELECT * FROM province WHERE cod_provincia = '".$cod_provincia."' ORDER BY cod_provincia";
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$provincia = $row['sigla'];
				}
				return $provincia;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////
	function getComune($cod_istat)
	{
		$query = "SELECT * FROM comuni WHERE cod_istat = '".$cod_istat."' ORDER BY comune";
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$comune = $row['comune'];
				}
				return $comune;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////
	function getCap($cod_istat)
	{
		$query = "SELECT * FROM cap WHERE cod_istat = '".$cod_istat."'";
		if($result = mysql_query($query))
		{
			if(mysql_num_rows($result) == 1)
			{
				$row = mysql_fetch_assoc($result);
				$cap = $row['cap'];
				return $cap;
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function getID()
	{
		$row = mysql_fetch_assoc(mysql_query('SELECT LAST_INSERT_ID() as id'));
		return $row['id'];
	}	
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function getColumns($table)
	{
		$results = mysql_query('SHOW COLUMNS FROM '.$table) or die('Query non valida: ' . mysql_error());
		
		$i = 0;
		$values = null;
		while($row = mysql_fetch_assoc($results))
		{
			$utils = explode('(',$row['Type']);
			if($utils[0] == 'set' or $utils[0] == 'enum')
			{
				$utils[1] = str_replace(')','',$utils[1]);
				$values = explode(',',$utils[1]);
			}
			if(count($utils)>1)
			{
				$columns[$row['Field']]= array('name'=>$row['Field'],
										'layout'=>strtoupper(substr($row['Field'],0,1)).str_replace('_',' ',substr($row['Field'],1)),
										'type'=>$utils[0],
										'size'=>str_replace(')','',$utils[1]),
										'value'=>$values);
			}
			else
			{
				$columns[$row['Field']]= array('name'=>$row['Field'],
										'layout'=>strtoupper(substr($row['Field'],0,1)).str_replace('_',' ',substr($row['Field'],1)),
										'type'=>$utils[0],
										'size'=>'none',
										'value'=>$values);
			}
		}
		
		mysql_free_result($results);
		
		return $columns;
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function getAssocColumns($table)
	{
		$results = mysql_query('SHOW COLUMNS FROM '.$table) or die('Query non valida: ' . mysql_error());

		while($row = mysql_fetch_assoc($results))
			$columns[$row['Field']]= $row['Field'];
		
		mysql_free_result($results);
		
		return $columns;
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function parseNull($data)
	{
		if (!empty($data))
			if (strtolower(chop($data)) == 'null')
				return 'NULL';
			else
				return '\'' . $data . '\'';
		else
			return 'NULL';
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function close_DB()
	{
		mysql_close();
	}
}

?>
