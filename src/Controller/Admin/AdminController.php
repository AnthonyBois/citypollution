<?php

namespace Formation\Controller\Admin;

use Formation\Response;
use Formation\Controller\Controller;
use Formation\Model\CityModel;

class AdminController extends Controller
{

	
	public function admin(): Response
	{
		$model = new CityModel($this->getView());

		if (($cityName = filter_input(INPUT_POST, "city_name")) && ($cityApiName = filter_input(INPUT_POST, "city_api_name"))) 
		{
			$model->create($cityName, $cityApiName);
		}
		else if (($cityApiName = filter_input(INPUT_GET, "delete"))) 
		{
			$model->delete($cityApiName);
		}
		$model->readAll();
		$model->notify();
		return $this->render("admin/admin");
	}
}