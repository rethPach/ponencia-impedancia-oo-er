<?php


class Juguete extends Model
{
	protected $table = 'juguetes';
	protected $fillable = ['nombre'];

	public function nino()
	{
		return $this->belongsTo(Nino::class, 'nino_id');
	}

	public function nombre()
	{
		return $this->nombre;
	}
}

class Nino extends Model
{
	public static ERES_MI_AMIGO_FIEL = true;

	protected $table = 'ninos';
	protected $fillable = ['nombre'];

	public function amigoFiel()
	{
		return $this->hasOne(Juguete::class, 'juguete_id');
	}

	public function recibirJugueteComoRegaloDeCumpleanos(Juguete $juguete, $esAmigoFiel = false)
	{
		$this->juguetes()->save($juguete);

		$this->setAmigoFiel($juguete, $esAmigoFiel);

		return $this;
	}

	public function juguetes()
	{
		return $this->hasMany(Juguete::class, 'nino_id');
	}

	protected function setAmigoFiel(Juguete $juguete, $esAmigoFiel)
	{
		if(!$esAmigoFiel) return;

		$this->amigoFiel()->save($juguete);
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


class ToyStory1
{

	public function play()
	{
		$andy = Nino::create(['nombre'=>'Andy']);

		$buddy = Juguete::create(['nombre'=>'Buddy']);
		$senorCaraDePapa = Juguete:create(['nombre'=>'Señor Cara De Papa']);
		$rex = Juguete::create(['nombre'=>'Rex']);
		$hank = Juguete::create(['nombre'=>'Hank']);
		$buzz = Juguete::create(['nombre'=>'Buzz']);

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
	}

	protected function output($out)
	{
		echo $out ."<br/>";
	}

}