<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ci_zend extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		// Load Zend helper
		$this->load->helper('zend');
	}
	
	public function insert()
	{
		Zend_Loader::loadClass('Zend_Gdata');
		Zend_Loader::loadClass('Zend_Gdata_Calendar');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Http_Client');
		$username = "";
		$password = "";
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $service);
		$service = new Zend_Gdata_Calendar($client);
		$event = $service->newEventEntry();
		$event->title = $service->newTitle("Test title");
		$event->where = array($service->newWhere("Test Place"));
		$event->content = $service->newContent("Test content");
		$startDate = "2013-01-23";
		$startTime = "14:00";
		$tzOffset = "+01";

		$when = $service->newWhen();
		$when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
		$event->when = array($when);
		try {
			$newEvent = $service->insertEvent($event);
			$event_string = '<ul><li>'. $newEvent->getId() .'</li><li>'. $newEvent->title .'</li><li>'. $newEvent->content .'</li><li>'. $newEvent->when[0]->startTime .'</li><li>'. $newEvent->where[0] .'</li></ul>';
			echo $event_string;
		} catch (Exception $e) {
			 echo $e;
		}
	}
	public function retrieve(){
		Zend_Loader::loadClass('Zend_Gdata');
		Zend_Loader::loadClass('Zend_Gdata_Calendar');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Http_Client');
		$username = "";
		$password = "";
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $service);
		$service = new Zend_Gdata_Calendar($client);
		
		$query = $service->newEventQuery();
		$query->setUser('default');
		$query->setVisibility('private');
		$query->setProjection('full');
		$query->setOrderby('starttime');
		try {
			$eventFeed = $service->getCalendarEventFeed($query);
		} catch (Zend_Gdata_App_Exception $e) {
			echo "Error: ".$e->getMessage();
		}

		echo "<ul>";
		foreach ($eventFeed as $event) {
			echo "<li>" . $event->title . " </li>";
		}
		echo "</ul>";
	}
}

/* End of file ci_zend.php */
/* Location: ./application/controllers/ci_zend.php */
