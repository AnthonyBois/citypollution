<?php

namespace Formation\Controller;

use Formation\Response;
use Formation\View\View;

class Controller
{
	private $view, $format;

	public function __construct()
	{
		$this->view = new View;
	}

	public function setFormat(string $format)
	{
		$this->format = $format;
	}

	public function getFormat() : string
	{
		return $this->format;
	}

	public function addContent(Response $response)
	{
		$contentType = "xml" === $this->format
								 ? "application/xml"
								 : ("pdf" === $this->format
								 ? "application/pdf"
								 : "text/html");
		$response->addHeader(
			"Content-Type",
			$contentType . "; charset=utf-8"
		);
	}

	public function getView() : View
	{
		return $this->view;
	}

	protected function render(string $view, array $data = []) : Response
	{
		return $this->view->render($view, $data);

	}


}
