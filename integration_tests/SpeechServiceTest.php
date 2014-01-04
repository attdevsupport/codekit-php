<?php

require_once __DIR__ . '/../lib/OAuth/OAuthTokenService.php'; 
require_once __DIR__ . '/../lib/Speech/SpeechService.php'; 

use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Restful\RestfulEnvironment;
use Att\Api\Speech\SpeechService;

class SpeechServiceTest extends PHPUnit_Framework_TestCase 
{
    public function testRequest() 
    {
        require __DIR__ . '/cfgs/speech_config.php';

        if (isset($proxyHost) && isset($proxyPort))
            RestfulEnvironment::setProxy($proxyHost, $proxyPort);
        if (isset($allowAllCerts))
            RestfulEnvironment::setAcceptAllCerts($allowAllCerts);

        $osrvc = new OAuthTokenService($FQDN, $api_key, $secret_key);
        $token = $osrvc->getToken('Speech,TTS,STTC');

        $srvc = new SpeechService($FQDN, $token);
        $fname = __DIR__ . '/files/BostonCeltics.wav'; 
        $response = $srvc->speechToText($fname, 'Generic');
        $this->assertTrue($response != null);

        $response = $srvc->textToSpeech('text/plain', 'testing ok');
        $this->assertTrue($response != null);

        $response = $srvc->speechToTextCustom('GenericHints', $fname);
        $this->assertTrue($response != null);
    }
}

?>
