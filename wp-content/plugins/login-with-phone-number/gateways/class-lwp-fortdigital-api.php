<?php

/**
 * LWP_Fortdigital_Api class.
 *
 * The class names need to defined in format: LWP_%s_Api, where %s means Api name, e.g. LWP_Infobip_Api
 * The class methods need to end with api key name
 *
 * @package Login with phone number
 */

/**
 * Class LWP_Fortdigital_Api class.
 */
class LWP_Fortdigital_Api
{

	/**
	 * Api Key
	 *
	 * @var string
	 */
	public $user;
	public $password;
	public $token;
	public $sender;

	/**
	 * Gateway Endpoint
	 */
	private const ENDPOINT = "https://mx.fortdigital.net/http/send-message";

	/**
	 * LWP_Handle_Messaging constructor.
	 */
	public function __construct()
	{
		$options = get_option('idehweb_lwp_settings');
		if (!isset($options['idehweb_fortdigital_user'])) $options['idehweb_fortdigital_user'] = '';
		if (!isset($options['idehweb_fortdigital_password'])) $options['idehweb_fortdigital_password'] = '';
		if (!isset($options['idehweb_fortdigital_sender'])) $options['idehweb_fortdigital_sender'] = '';
		$this->user = $options['idehweb_fortdigital_user'];
		$this->password = $options['idehweb_fortdigital_password'];
		$this->sender = $options['idehweb_fortdigital_sender'];
		//        $this->api_key   = trim( $plugin_settings['api_key'] );
	}

	public function lwp_send_sms($phone, $text)
	{
		$url = self::ENDPOINT;
		$params = array(
			'username'	=> $this->user,
			'password'	=> $this->password,
			'to'		=> $phone,
			'from'		=> $this->sender,
			'message'	=> $text
		);

		$url = $url . "?" . http_build_query($params);


		$response = wp_safe_remote_get(
			$url,
			array(
				//				'method'      => 'GET',
				'timeout'     => 60,
				'redirection' => 5,
				//				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(),
				//                'headers' => [
				//                    'Authorization' => "Basic $auth"
				//                ],
				//				'body'        => array(
				//					'Body'      => $text,
				//					'From'          => $this->number,
				//					'To' => $phone
				//				),
				'cookies'     => array(),
			)
		);

		$user_message = '';
		$dev_message  = array();
		$res_param    = array();

		if (is_wp_error($response)) {
			$dev_message = $response->get_error_message();
			$success     = false;
		} else {
			$body = $response['body'];
			if (preg_match('/OK:.*[\n]?/i', $body, $matches)) {
				$success = true;
			} else if (preg_match('/ERROR:\d{3}.*[\n]?/i', $body, $matches)) {
				$success      = false;
				$user_message = __('SMS gateway response an error', 'orion-login');
			} else {
				$success      = false;
				$user_message = __('Unknown error', 'orion-login');
			}
		}

		return array(
			'success'     => $success,
			'userMessage' => $user_message,
			'devMessage'  => $dev_message,
			'resParam'    => $res_param,
		);
	}
}
