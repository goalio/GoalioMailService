GoalioMailService
=================

Provide configurable Mail Transport Factory  and simple messaging for ZF2

Usage
-----

	// The template used by the PhpRenderer to create the content of the mail
	$viewTemplate = 'module/email/testmail';
	
	// The ViewModel variables to pass into the renderer
	$value = array('foo' => 'bar');

	$mailService = $this->getServiceManager()->get('goaliomailservice_message');
	$message = $mailService->createTextMessage($from, $to, $subject, $viewTemplate, $values);	
	$mailService->send($message);