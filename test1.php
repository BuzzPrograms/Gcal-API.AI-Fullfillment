<?php
header('Content-Type: application/json');
ob_start();
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$action = $request["result"]["action"];
$parameters = $request["result"]["parameters"];

$calID = 'primary'

require_once __DIR__ . '/vendor/autoload.php';
define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');


  if (file_exists($credentialsPath)) {
    $accessToken = json_decode(file_get_contents($credentialsPath), true);
  } else {
    // Return internal server error if no accessToken has been created.
	http_response_code(500);
  }
  $client->setAccessToken($accessToken);

  // Refresh the token if it's expired.
  if ($client->isAccessTokenExpired()) {
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
  }
  return $client;
}
  

  $service = new Google_CalendarService($client); // successfully connected
  $freebusy = new Google_FreeBusyRequest();
  $freebusy->setTimeMin('2013-07-08T08:00:00.000-07:00');
  $freebusy->setTimeMax('2013-07-08T10:00:00.000-07:00');
  $freebusy->setTimeZone('Europe/Berlin');
  $freebusy->setGroupExpansionMax(10);
  $freebusy->setCalendarExpansionMax(10);
  $mycalendars = array( array("id"=> $calID ));
  $freebusy->setItems($mycalendars);
  $createdReq = $service->freebusy->query($freebusy);
  $free = $createdReq->getBusy()
  print($free, true)




  $event = new Google_Event();
  $event->setSummary($parameters[naam]);
  $event->setdescription('Naam: '+ $parameters[naam] + ', telefoonnummer: ' + $parameters[telefoon]', klachten: ' + $parameters[klachten])
  $event->setLocation($parameters[location]);
  $start = new Google_EventDateTime();
  $start->setDateTime('2013-9-29T10:00:00.000-05:00');
  $event->setStart($start);
  $end = new Google_EventDateTime();
  $end->setDateTime('2013-9-29T10:25:00.000-05:00');
  $event->setEnd($end);
  $createdEvent = $cal->events->insert('###', $event);


$output["contextOut"] = array(array("name" => "$next-context", "parameters" =>
array("param1" => $param1value, "param2" => $param2value)));
$output["speech"] = $outputtext;
$output["displayText"] = $outputtext;
$output["source"] = "whatever.php";
ob_end_clean();
echo json_encode($output);
?>