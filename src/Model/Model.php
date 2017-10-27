<?php

namespace Formation\Model;

use Formation\View\SubjectInterface;
use Formation\View\ObserverInterface;
use Formation\View\View;
use JsonSerializable;

class Model implements SubjectInterface, JsonSerializable
{

	private $observer, $query;
	protected $em;

	public function __construct(View $view = null)
	{
		$this->observer = [];
		if($view)
		{
			$this->attach($view);
		}
		$this->em = require __DIR__ . "/../../app/conf/bootstrap.php";

		$this->query = [];

	}


	public function __set(string $name, $value)
	{
		$this->query[$name] = $value;
	}

	public function __get(string $name)
	{
		return array_key_exists($name, $this->query)
			? $this->query[$name]
			: null;
	}

	public function jsonSerialize()
	{
		return
		[
			"attr" => $this->__get("json"),
			"error" => $this->__get("error")

		];
	}


	public function attach(ObserverInterface $observer)
	{
		$this->observer[get_class($observer)]=$observer;

	}

	public function notify()
	{
		foreach ($this->observer as $value)
		{
			$value->update($this, static::KEY);
		}
		unset($this->em);
		unset($this->observer);
	}

}
