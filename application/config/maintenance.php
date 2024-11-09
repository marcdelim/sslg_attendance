<?php 
$environment = "";
if(ENVIRONMENT=='production'){
	$environment = "https://138.2.81.160";
}elseif(ENVIRONMENT=='staging'){
	$environment = "http://staging.rex.com.ph";
}else{
	$environment = "http://localhost";
}
$config['site'] = array(
	'maintenace_mode' => false,
	'system_name' => 'SSLG Attendance System',
	'system_description' => 'Supreme Secondary Learner Government',
	'system_slug' => 'SSLG',
	'company' => 'LynTech',
	'powered_by' => 'Matthew Jaiden',
	'mail' => array(
	),
	'userByPass' => hash('sha512','qwer'),
	'defaultPass' => 'password',
	'ApiEndPoint' => [
		'API_KEY' => "3db434896b93963f3524dbc9216baed3",
		'URL' => [
			"AUTHENTICATOR" =>$environment."/user_management/api/auth",
			"MANAGE_USERS" => $environment."/user_management/api/users",
		],
	],
);
