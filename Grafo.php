<?php 

include('Vertice.php');

	class Grafo{

		private $matrizA;
		private $vectorO;
		private $dirigido;
		
		public function __construct($dir = true){
			$this->matrizA = null;
			$this->vectorO = null;
			$this->dirigido = $dir;
		}


		public function GetMatriz(){

			return $this->matrizA;

		}

		public function GetVector(){

			return $this->vectorO;

		}

		public function GetVertice($v){

			return $this->vectorO[$v];

		}


		public function AgregarVertice($v){


		if($v != null){	
			if(!isset($this->vectorO[$v->Getid()])){

				$this->matrizA[$v->Getid()] = null;
				$this->vectorO[$v->Getid()] = $v;

			}else{

				return false;

			}

			return true;

		}else{

			return false;

		}

	}

		public function AgregarArista($O,$D,$p = null){

			if(isset($this->vectorO[$O]) && isset($this->vectorO[$D])){

				$this->matrizA[$O][$D] = $p;

			}else{

				return false;

			}

			return true;

		}


		public function GetAdyacentes($v){

			return $this->matrizA[$v];

		}

		public function Grado_Salida($v){

			if ($this->matrizA[$v]==null) {
				return $s=0;
			}else{
				return count($this->matrizA[$v]);
			}

		}


		public function Grado_Entrada($v){

			$cont = 0;

			if($this->matrizA != null){

				foreach($this->matrizA as $Ni => $VObj){

					if($VObj != null){

						foreach($VObj as $Vi => $valor){

							if($Vi == $v){

								$cont++;

							}
						}
					}
				}
			}

			return $cont;
		}

		public function Grado($v){

			$val = $this->Grado_Entrada($v) + $this->Grado_Salida($v);


			return $val;

		}


		public function EliminarArista($O,$D){

			if(isset($this->matrizA[$O][$D])){

				unset($this->matrizA[$O][$D]);

			}else{

				return false;

			}

			return true;

		}


		public function EliminarVertice($v){
			
			if(isset($this->vectorO[$v])){

				foreach($this->matrizA as $Ni => $VObj){

					if($VObj != null){

						foreach($VObj as $Vn => $val){

							if($Vn == $v){

								unset($this->matrizA[$Ni][$Vn]);

							}
						}
					}
				}

				unset($this->matrizA[$v]);
				unset($this->vectorO[$v]);

			}else{

				return false;

			}

			return true;

		}


		public function Mostrar($n){

		    echo "<b>Recorrido de Matriz Adyacencia :</b></br>";

		    foreach ($n->GetMatriz() as $Nd => $valAy) {
		    	echo "<br>".$Nd.":";
		    	if ($valAy != null) {
		    		foreach ($valAy as $idO => $valObj) {
		    			echo " | ".$idO ." | ".$valObj." | ";
		    		}
		    	}
		    }

		}


	}


?>