<?php 

	class Vertice{

		private $id;
		private $visitado;
			
		public function __construct($i){

			$this->id = $i;
			$this->visitado = false;

		}

		public function Getid(){

			return $this->id;

		}

		public function Setid($i){

			$this->id = $i;

		}

		public function Getvisitado(){

			return $this->visitado;

		}

		public function Setvisitado($v){

			$this->visitado =$v;

		}

	}





 ?>
