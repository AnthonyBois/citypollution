<?php

namespace Formation\Controller;

use Formation\Response;
use Formation\Client;
use Formation\Model\CityModel;

class IndexController extends Controller
{
	const TOKEN = "85c592926e6bc1419a53286269019b639f3239c0";

	private function consume(CityModel $model)
	{
		if (!isset($model->json->status)
			|| "ok" !== $model->json->status
			|| [] === $model->json->data
			|| time() > $model->json->data[0]->time->vtime + 86400)
		{
			$response = (new Client)->send(
				"https://api.waqi.info/search/?keyword="
				. $model->api->getCity()->getCityApiName()
				. "&token="
				. self::TOKEN
			);

			if (!$response->getBody())
			{
				throw new \Exception("Cant consume api");
			}

			return $response->getBody();
		}
	}

	public function index() : Response
	{
		$model = new CityModel($this->getView());
		$model->readAll();
		$model->notify();
		return $this->render("index");
	}

	public function city() : Response
	{

		$this->setFormat((string) filter_input(INPUT_GET, "format"));
		$exploded = explode("/", (string) filter_input(INPUT_SERVER, "REDIRECT_URL"));
		$cityApiName = end($exploded);
		$model = new CityModel($this->getView());
		$model->read($cityApiName);

		try
		{
			if (!$model->api)
			{
				throw new \Exception("The city does not exists");
			}

			$model->json = json_decode($model->api->getApiJson());

			if (($json = $this->consume($model)))
			{
				$model->update ($json);
				$model->json = json_decode($json);
			}
		}

		catch (\throwable $e)
		{
			$model->error = $e->getMessage();
		}

		finally
		{
			$model->notify();

			//var_dump(json_encode($model));
			$response = $this->render
			(
				"city"
				. ("xml" === $this->getFormat() ? ".xml": "")
			);
			$this->addContent ($response);
			return $response;
		}
	}
}
