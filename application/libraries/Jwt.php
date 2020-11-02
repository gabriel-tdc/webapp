<?php
// https://blog.codeexpertslearning.com.br/criando-primeiro-token-jwt-4eab1b811400
defined('BASEPATH') OR exit('No direct script access allowed');

class Jwt{

	public function generate($user, $isAdmin = null) {
		//Header Token
			$header = [
				'alg' => 'HS256',
				'typ' => 'JWT',
			];

		//Payload - Content
			$exp = strtotime('+'.TOKEN_DURATION.' days', (new DateTime("now"))->getTimestamp());
			
			$payload = [
				'exp' => $exp,
				'id' => $user->id,
			];
			if($isAdmin){
				$payload['admin'] = true;
			}

		//JSON
			$header = json_encode($header);
			$payload = json_encode($payload);

		//Base 64
			$header = base64_encode($header);
			$payload = base64_encode($payload);

		//Sign
			$sign = hash_hmac('sha256', $header . "." . $payload, KEY_JWT, true);
			$sign = base64_encode($sign);

		//Token
			$token = $header . '.' . $payload . '.' . $sign;

		return $token;
	}

	public function check($token) {
		$aux = explode(" ", $token);
		if(count($aux) !== 2){
			return TOKEN_INVALIDO;
		}
		$jwt = explode(".", $aux[1]);

		if(count($jwt) !== 3){
			return TOKEN_INVALIDO;
		}

		$header = $jwt[0];
		$payload = $jwt[1];
		$sign = str_replace('\\', '', $jwt[2]);

		$signCheck = hash_hmac('sha256', $header . "." . $payload, KEY_JWT, true);
		$signCheck = base64_encode($signCheck);
		
		if($sign === $signCheck){
			$payload = json_decode(base64_decode($payload));
	
			$currentDate = (new DateTime('now'))->getTimestamp();
			return ($currentDate < $payload->exp) ? TOKEN_VALIDO : TOKEN_EXPIRADO;
		}else{
			return TOKEN_INVALIDO;
		}
	}

	public function getPayload($token) {
		$aux = explode(" ", $token);
		if(count($aux) != 2){
			return TOKEN_INVALIDO;
		}
		$jwt = explode(".", $aux[1]);

		$payload = json_decode(base64_decode($jwt[1]));

		return $payload;
	}
}
