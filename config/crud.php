<?php

function stdToArray($obj) {
		$reaged = (array)$obj;
		foreach($reaged as $key => &$field) {
				if(is_object($field))$field = stdToArray($field);
		}
		return $reaged;
}

function jsonize($array) {
		$array = uformat($array);

		$new_array = array();

		foreach($array as $key=>$value) {
				$new_array[] = $value;
		}

		return json_encode($new_array);
}

function uformat($array) {
		foreach($array as $key=>$value) {
				if(is_array($value)) {
						foreach($value as $k=>$v) {
								if(is_numeric($k)) {
										unset($array[$key][$k]);
								}
								else {
										$array[$key][$k] = $v;
								}
						}
				}
		}

		return $array;
}

function dateDb($date) {

  $tempDate = explode("/",$date );

  if(count($tempDate)<=1){
    return null;
  }

  return $tempDate[2].'-'.$tempDate[1].'-'.$tempDate[0];
}

function getNotes($text) {
	return explode('#',$text);
}

function dateToFr($data) {
  $string = "";
  $dt = array();
  $date = array();
  $time = array();
  $month = array("Jan","Fev","Mar","Avr","Mai","Jun",
                "Jul","Aou","Sep","Oct","Nov","Dec");


  $dt = explode(" ",$data);
  $date = explode("-",@$dt[0]);
  $time = explode(":",@$dt[1]);

  foreach ($month as $key => $value) {
    if(@$date[1] == ($key+1)){
      $string = @$date[2]." ".$value." ".@$date[0]." à ".@$time[0]."h".@$time[1]."min";
    }
  }


  return $string;
}

class MySQLClient {
	private $collection = null;
	private $database = null;
	private $hostname = null;
	private $key_ignore = array('order','limit','between','offset');
	private $id = null;

	function __construct($hostname = null) {
		$this->hostname = $hostname;
	}

	function setDatabase($database) {
		try {
            if(is_string($database)) {
                $this->database = new PDO('mysql:host='.$this->hostname.';dbname='.$database,'hayatic','ds8jezWcs4vuNNn');
            } else if(is_object($database)) {
                $this->database = $database;
            }
            $this->database->exec("SET CHARACTER SET utf8");
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e){

        }
	}

	function setCollection($collection) {
		$this->collection = $collection;
	}

	function schema() {
		$requete = 'DESCRIBE '.$this->collection;
		$result = $this->database->prepare($requete);
		$result -> execute();
		$array = $result -> fetchAll();
		return $array;
	}

  function redress($data) {
    $return = Array();
    $i = 0;
    foreach ($data as $k=>$v) {
      foreach ($v as $key => $value) {
        $int = (int)$key;
        if (empty($int)) {
          $return[$i][$key] = $value;
        }
      }
      $i++;
    }
    return $return;
  }

	function find($critere="all") {
		$requete = "";

		if($critere=="all") {
			$requete = 'SELECT * FROM '.$this->collection;
		} else {
			if (is_array($critere)) {
				$nombre = count($critere);
				$compteur = 0;$condition = "";
				foreach ($critere as $cle => $valeur) {
					/* 
					* Update for multiple case 2017-02-12
					*/  
					if(is_array($valeur)) {
						$operator = 'IN';
						$search = "'".implode("','",$valeur)."'";
						$search = "(".$search.")";
					} else {
						$operator = 'LIKE';
						$search = "'".$valeur."'";
					}
					
					if(!in_array($cle,$this->key_ignore))
					{
						if($compteur==0){
							$condition = ' WHERE (`'.$cle.'` '.$operator.' '.$search.')';
						}
						else{
							$condition .= ' AND (`'.$cle.'` '.$operator.' '.$search.')';
						}
					}
					$compteur++;
				}

				$type = "";
				$limiter = "";
				$ordering = "";
				$between = "";
        $offset = "";

				if (key_exists('between', $critere)) {
					$array = $critere['between'];
					$column_array = $array['column'];
					$exp1 = $array['exp1'];
					$exp2  = ''.$array['exp2'];
					$column = "";
					$compteur = 0;

					foreach ($column_array as $k => $v) {
						if($compteur==0){
							$column = '`'.$v.'`';
						} else {
							$column .= ' OR `'.$v.'`';
						}
						$compteur++;
					}

					$limiter = ' WHERE '.$column.' BETWEEN \''.$exp1.'\' AND \''.$exp2.'\'';
				}

				if (key_exists('limit', $critere)) {
					$array = $critere['limit'];
					$begin = @$array[0];
          $end = null;
          if(!empty($array[1])){
            $end = ', '.$array[1];
          }
					$limiter = ' LIMIT '.$begin.''.$end;
				}

        if (key_exists('offset', $critere)) {
					$value = $critere['offset'];
					$offset = ' OFFSET '.$value;
				}

				if (key_exists('order', $critere)) {
					$array = $critere['order'];
					$type = $array['type'];
					$array = $array['filter'];
					$nombre = count($array);
					$compteur = 0;

					foreach ($array as $key => $value) {
						if($compteur==0){
							$ordering = ' ORDER BY `'.$value.'`';
						} else {
							$ordering .= ' AND `'.$value.'`';
						}
						$compteur++;
					}
				}

			$requete = 'SELECT * FROM `'.$this->collection.'` '.$between.''.$condition.''.$ordering.' '.$type.' '.$limiter.' '.$offset;

			} else {
				$requete = $critere;
			}
		}

		$result = $this->database->prepare($requete);
		$result -> execute();
		$array = $result -> fetchAll();

		return $this->redress($array);
	}


  function save($critere=""){
    if($critere==""){
      return -1;
    } else {
      if (is_array($critere)) {
        $nombre = count($critere);
        $compteur = 0;
        $column = "";
        $values = "";
        foreach ($critere as $cle => $valeur) {
          if ($compteur==0) {
            $column = '`'.$cle.'`';
            $values = '"'.addslashes((string)$valeur).'"';
          } else {
            $column .= ',`'.$cle.'`';
            $values .= ',"'.addslashes((string)$valeur).'"';
          }
          $compteur++;
        }
      }
      $requete = 'INSERT INTO '.$this->collection.' ('.$column.') VALUES ('.$values.')';
    }
    $result = $this->database->prepare($requete);
    $result -> execute();

    $return = $this->database->lastInsertId();
    return $return;
  }

  function update($id,$critere="") {
    $requete = null;
  	if ($critere=="") {
  		return -1;
  	} else {
  		if (is_array($critere)) {
  			$nombre = count($critere);
  			$compteur = 0;
  			$update = "";

  			foreach ($critere as $cle => $valeur){
  				if($compteur==0){
  					$update = '`'.$cle.'` = \''.addslashes((string)$valeur).'\'';
  				} else {
  					$update .= ', `'.$cle.'` = \''.addslashes((string)$valeur).'\'';
  				}
  				$compteur++;
  			}
  		}

			if (is_array($id)) {
				$key = array_keys($id)[0];
				$value = $id[$key];
				$requete = 'UPDATE `'.$this->collection.'` SET '.$update.' WHERE `'.$key.'`=\''.$value.'\'';
			} else {
				$requete = 'UPDATE `'.$this->collection.'` SET '.$update.' WHERE `'.$this->id.'`='.$id;
			}
  	}

    $statement = $this->database->prepare($requete);

  	if($statement->execute()){
  		return 1;
  	}

  	return -1;
  }

  function remove($id) {
    $target = null;
    if(is_array($id)){
      foreach ($id as $key => $value) {
        $target = "`".$key."` = '".$value."'";
      }
    } else {
      $target = $this->id.'`='.$id;
    }

  	$requete = 'DELETE FROM `'.$this->collection.'` WHERE '.$target;
  	$result = $this->database->prepare($requete);
  	$result -> execute();
  }
}
