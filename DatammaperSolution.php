<?php

class Nino
{
	public static ERES_MI_AMIGO_FIEL = true;

	protected $nombre;
	protected $jueguetes;
	protected $amigoFiel;

	public function __construct($nombre)
	{
		$this->nombre = $nombre;
		$this->juguetes = new ArrayCollection();
	}

	public function recibirJugueteComoRegaloDeCumpleanos(Juguete $juguete, $esAmigoFiel = false)
	{
		$juguete->setNino($this); 

		$this->juguetes->add($juguete);

		$this->setAmigoFiel($juguete, $esAmigoFiel);

		return $this;
	}

	protected function setAmigoFiel(Juguete $juguete, $esAmigoFiel)
	{
		if(!$esAmigoFiel) return;

		$this->amigoFiel = $juguete;
	}

	public function cuantosJuguetesTienes()
	{
		return $this->juguetes->count();
	}

	public function quienEsTuAmigoFiel()
	{
		return $this->amigoFiel->nombre(). 'Es mi amigo fiel!';
	}
}

class Juguete
{
	protected $nombre
	protected $nino;

	public function __construct($nombre)
	{
		$this->nombre = $nombre;
	}

	public function setNino(Nino $nino)
	{
		$this->nino = $nino;
	}
}


class ToyStory1
{

	public function play()
	{
		$andy = new Nino('Andy');

		$buddy = new Juguete('Buddy');
		$senorCaraDePapa = new Juguete('Señor Cara De Papa');
		$rex = new Juguete('Rex');
		$hank = new Juguete('Hank');
		 

		$andy
			->recibirJugueteComoRegaloDeCumpleanos($senorCaraDePapa)
			->recibirJugueteComoRegaloDeCumpleanos($rex)
			->recibirJugueteComoRegaloDeCumpleanos($hank)
			->recibirJugueteComoRegaloDeCumpleanos(
				$buddy, Nino::ERES_MI_AMIGO_FIEL);


		$this->output( $andy->cuantosJuguetesTienes() );
		$this->output( $andy->quienEsTuAmigoFiel() );

		$andy->recibirJugueteComoRegaloDeCumpleanos(
			$buzz, Nino::ERES_MI_AMIGO_FIEL);

		$this->output( $andy->cuantosJuguetesTienes() );
		$this->output( $andy->quienEsTuAmigoFiel() );

		//alternativas para tapar este goteo? 
		//EventDispatcher, CommandDecorators.
		$this->persistAndFlushOrFail([ $andy, $buddy, $senorCaraDePapa, $rex, $hank ]);

	}

	public function persistAndFlushOrFail($models)
	{
		foreach ($models as $model) 
			$this->em->persist($model);	
		
		$this->em->flush();
	}

	protected function output($out)
	{
		echo $out ."<br/>";
	}


}
