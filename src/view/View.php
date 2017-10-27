<?php

namespace Formation\View;

use Formation\Response;

class View implements ObserverInterface
{
	
	private $reponse, $subject;

	public function __construct()
	{
		$this->reponse = new Response;
	}	

	private function getFileName(string $name): string
	{
		return __DIR__ ."/../../app/views/" . str_replace("..", "", $name) . ".php";
	}

	public function update(SubjectInterface $subject, $key = null)
	{
		$modelAlias = $key ? (string) $key : get_class($subject);
		$this->subject[$modelAlias]=$subject;
	}

	public function render(string $view, array $data) : Response
	{

		$fileName =  $this->getFileName($view);
		if (is_file($fileName))
		{
			extract($data);
			extract($this->subject);
			ob_start();
			include $fileName;
			$output=ob_get_contents();
			ob_clean();
			$this->reponse->setBody($output);
			return $this->reponse;
		}
		throw new \Exception("View " . $view . " no found");	
	}
}