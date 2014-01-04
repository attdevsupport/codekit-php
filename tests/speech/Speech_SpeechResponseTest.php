<?php

require_once __DIR__ . '/../../lib/Speech/SpeechResponse.php'; 

use Att\Api\Speech\SpeechResponse;

class Speech_SpeechResponseTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        {
            "Recognition": {
                "Status": "Ok",
                "ResponseId": "3125ae74122628f44d265c231f8fc926",
                "NBest": [
                    {
                        "Hypothesis": "bookstores in glendale california",
                        "LanguageId": "en-us",
                        "Confidence": 0.9,
                        "Grade": "accept",
                        "ResultText": "bookstores in Glendale, CA",
                        "Words": ["bookstores", "in", "glendale","california"],
                        "WordScores": [0.92, 0.73, 0.81, 0.96]
                    }
                ]
            }
        } 
        ';

        $arr = json_decode($str, true);

        $r = SpeechResponse::fromArray($arr);
        $this->assertEquals($r->getResponseId(), '3125ae74122628f44d265c231f8fc926');
        $this->assertEquals($r->getStatus(), 'Ok');

        $nb = $r->getNBest();
        $this->assertEquals($nb->getHypothesis(), 'bookstores in glendale california');
        $this->assertEquals($nb->getLanguageId(), 'en-us');
        $this->assertEquals($nb->getConfidence(), 0.9);
        $this->assertEquals($nb->getGrade(), "accept");
        $this->assertEquals($nb->getResultText(), 'bookstores in Glendale, CA');
        $this->assertEquals($nb->getWords()[0], 'bookstores');
        $this->assertEquals($nb->getWordScores()[0], 0.92);
    }

}
