<?php

namespace Formation\View;

interface SubjectInterface
{
	public function attach(ObserverInterface $observer);

	public function notify();

}