<?php

namespace Formation;

class Response
{
	protected $status, $reason, $header, $body;

	public function __construct()
	{
		$this->status=200;
		$this->reason="ok";
		$this->header=[];
		$this->body="";
	}

	public function getVersion(): string
	{
		return "HTTP/1.1" . $this->status . "" . $this->reason;
	}

	public function getBody(): string
	{
		return $this->body;
	}

	public function getHeader(): array
	{
		return $this->header;
	}

	public function setBody(string $body)
	{
		$this->body=$body;
	}

	public function addHeader(string $name, string $value)
	{
		$this->header[$name]=$value;
	}

	public function __toString()
	{
		return $this->body;
	}
}

