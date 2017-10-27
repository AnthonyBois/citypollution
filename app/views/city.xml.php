<?php
$xml = new SimpleXMLElement
(
  '<?xml version="1.0" encoding="UTF-8" ?><formation />'
);

foreach  ($cityModel->json->data as $data)
{
  $station = $xml->addChild ("sation");
  $station->addAttribute("name", $data->station->name);
  $station->aqi= $data->aqi;

  $station->addChild ("coordinate");
  $station->coordinate->addChild ("lat");
  $station->coordinate->addChild ("lng");

  $station->coordinate->lat =  $data->station->geo[0];
  $station->coordinate->lng =  $data->station->geo[1];

  $station->time = $data->time->stime;
}

$dom = dom_import_simplexml($xml)->ownerDocument;
$dom->formatOutput = true;
$output = $dom->saveXML();

echo $output;
