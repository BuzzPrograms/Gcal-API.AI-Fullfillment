<?php
header('Content-Type: application/json');
ob_start();
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$action = $request["result"]["action"];
$parameters = $request["result"]["parameters"];

require_once __DIR__ . '/vendor/autoload.php';

define('APPLICATION_NAME', 'Cesar');
define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
define('SCOPES', implode(' ', array(
  Google_Service_Calendar::CALENDAR_READONLY)
));


function getClient() {
  $client = new Google_Client();
  $client->setApplicationName(APPLICATION_NAME);
  $client->setScopes(SCOPES);
  $client->setAuthConfig(CLIENT_SECRET_PATH);
  $client->setAccessType('offline');

  $credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
  if (file_exists($credentialsPath)) {
    $accessToken = json_decode(file_get_contents($credentialsPath), true);
  } else {
	// Request authorization from the user.
    $authUrl = $client->createAuthUrl();
    printf("Open the following link in your browser:\n%s\n", $authUrl);
    print 'Enter verification code: ';
    $authCode = trim(fgets(STDIN));

    // Exchange authorization code for an access token.
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

    // Store the credentials to disk.
    if(!file_exists(dirname($credentialsPath))) {
      mkdir(dirname($credentialsPath), 0700, true);
    }
    file_put_contents($credentialsPath, json_encode($accessToken));
    printf("Credentials saved to %s\n", $credentialsPath);
  }
  $client->setAccessToken($accessToken);

  // Refresh the token if it's expired.
  if ($client->isAccessTokenExpired()) {
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
  }
  return $client;
}
  
function expandHomeDirectory($path) {
  $homeDirectory = getenv('HOME');
  if (empty($homeDirectory)) {
    $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
  }
  return str_replace('~', realpath($homeDirectory), $path);
}

  // Get the API client and construct the service object.
  $client = getClient();
  $service = new Google_Service_Calendar($client);
  $freebusy = new Google_Service_Calendar_FreeBusyRequest();
  $freebusy->setTimeMin('2017-07-28T16:34:00+02:00'); // time specified in request
  $freebusy->setTimeMax('2017-07-28T19:00:00+02:00'); // 1 hour later
  $freebusy->setTimeZone('Europe/Amsterdam'); //sets the timezone
  $freebusy->setGroupExpansionMax(10); 
  $freebusy->setCalendarExpansionMax(10);
  $item = new Google_Service_Calendar_FreeBusyRequestItem();
  $item->setId('ukf72k2kglld4ac0t9nfpaiudc@group.calendar.google.com'); //sets the calendar ID
  $freebusy->setItems(array($item));
  $query = $service->freebusy->query($freebusy);
  $s = $query->getCalendars();  
  if(empty($s['ukf72k2kglld4ac0t9nfpaiudc@group.calendar.google.com']['modelData']['busy'][0])) { // if not busy set start end end times to 0
    $starttime = 0;
    $endtime = 0;
  } else {
    $starttime = $s['ukf72k2kglld4ac0t9nfpaiudc@group.calendar.google.com']['modelData']['busy'][0]['start'];
    $endtime = $s['ukf72k2kglld4ac0t9nfpaiudc@group.calendar.google.com']['modelData']['busy'][0]['end'];
  }
  //log times
  
  error_log('busy from:', 0);
  error_log($starttime, 0);
  error_log ('till:', 0);
  error_log ($endtime, 0);
  
  $ds = date("d-m-Y h:i:sa", $starttime); //format time to a nicely readable format
  $de = date("d-m-Y h:i:sa", $endtime);
  
  echo $ds $de
  
  if ($starttime = 0) {
   
   $outputtext = 'Dan heb ik nog een plekje vrij!'
   
  } elseif (!$starttime = 0) {
	
    $outputtext = 'ik heb een plekje vrij voor:' .$ds. 'en na' .$de.
  }
   
   
   
   
   
?>