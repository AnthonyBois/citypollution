<?php

namespace Formation\Model;

use Formation\Entity\City;
use Formation\Entity\Api;

class CityModel extends Model
{
	const KEY = "cityModel";

	public function create(string $cityName, $cityApiName, $apiJson="{}")
	{

		try
		{
			$city = new City;
			$api = new Api;

			$api->setApiJson($apiJson);
			$api->setCity($city);
			$city->setCityName($cityName);
			$city->setCityApiName($cityApiName);

			$this->em->persist($api);
			$this->em->flush();
			$this->__set("success", $cityName . " created");
		}

		catch (\Throwable $e)
		{
			$this->__set("error", $cityName . " already exists");
		}

	}

	public function delete(string $cityApiName)
	{
		try
		{
			$this->read($cityApiName);

			$this->em->remove($this->__get("api"));
			$this->em->flush();
			$this->__set("success", $cityApiName . " remove");
		}

		catch (\Throwable $e)
		{
			$this->__set("error", "Can t find city : " . $cityApiName);
		}
	}


	public function read($cityApiName)
	{
	 	$city = $this->em
		->getRepository(City::class)
		->findOneBy(["cityApiName" => $cityApiName]);
		$this->__set(
			"api", $this->em
			->getRepository(Api::class)
			->findOneBy(["city" => $city])
		);
	}

	public function readAll()
	{
	 	$this->__set("city", $this->em->getRepository(City::class)->findBy([], ["cityName" => "ASC"]));
	}

	public function update($json)
	{
		$this->__get("api")->setApiJson($json);
		$this->em->flush();
	}


}
