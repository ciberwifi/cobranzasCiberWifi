<?php
Class ConfiguracionDM
    {	public $prop;
        public $archivoPagosTxt;
		public $archivoPagosCvs;
		public $email;
  	    public $cuenta;
        public $pin;
        public $ruta;
		public $comercio;
        public $sidd;
		
        
		public function __construct($prop, $archivoPagosTxt, $archivoPagosCvs, $email, $cuenta, $pin, $ruta, $comercio, $sid)
  {
	$this->prop=  $prop;
  	$this->archivoPagosTxt =$archivoPagosTxt;
	$this->archivoPagosCvs=  $archivoPagosCvs;
	$this->email = $email;
	$this->cuenta=$cuenta;
	$this->pin=$pin;
	$this->ruta= $ruta;
	$this->comercio=$comercio;
	$this->sidd= $sid;

  
  }
    
  
  public function imprimir(){
	echo $this->prop;
  	echo $this->archivoPagosTxt;
	echo $this->archivoPagosCvs;
	echo $this->email ;
	echo $this->cuenta;
	echo $this->pin; 
	echo $this->ruta;
    
  } 
  } 
  ?>