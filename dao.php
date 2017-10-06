<?php

class PersonaTo
{
	protected $nombre;
	protected $apellido;

	public function setNombre($nombre)
	{
		$this->nombre;
	}

	public function nombre()
	{
		return $this->nombre;
	}

	public function setApellido($apellido)
	{
		$this->apellido;
	}

	public function apellido()
	{
		return $this->apellido;
	}


}


interface PersonaDao
{
	public function create(PersonaTo $personaTo);
}


class PersonaDaoMysql implements PersonaDao
{
	public function __construct()
	{
		//inyecto cualquier dependecia
	}

	public function create(PersonaTo $personaTo)
	{
		//implementacion mysql
	}
}

class PersonaDaoPostgres implements PersonaDao
{
	public function __construct()
	{
		//inyecto cualquier dependecia
	}

	public function create(PersonaTo $personaTo)
	{
		//implementacion postgres
	}
}

class PersonaDaoOracle implements PersonaDao
{
	public function __construct()
	{
		//inyecto cualquier dependecia
	}

	public function create(PersonaTo $personaTo)
	{
		//implementacion oracle
	}
}


class DAOFactory
{
	private static config($name)
	{
		$dictionaryDaos = [
			'personaDao' => PersonaDaoOracle::class
		];

		return new $dictionaryDaos[$name]();
	}


	public static function getPersonaDAO()
	{
		return $self::config('personaDao');
	}
}

//como uso esto
class Cliente
{
	s
	public function __construct()
	{
		$this->personaDao = DAOFactory::getPersonaDAO();
	}

	public function example()
	{
		$personaTo = new PersonaTo();
		$personaTo
			->setNombre('Nazareth')
			->setApellido('Pacheco');

		$this->personaDao->create($personaTo);
	}

}