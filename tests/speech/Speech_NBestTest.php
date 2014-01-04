<?php
require_once __DIR__ . '/../../lib/Speech/NBest.php'; 

use Att\Api\Speech\NBest;

class Speech_NBestTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        {
            "Hypothesis": "bookstores in glendale california",
            "LanguageId": "en-us",
            "Confidence": 0.9,
            "Grade": "accept",
            "ResultText": "bookstores in Glendale, CA",
            "Words": ["bookstores", "in", "glendale","california"],
            "WordScores": [0.92, 0.73, 0.81, 0.96]
        }
        ';

        $arr = json_decode($str, true);

        $r = NBest::fromArray($arr);

        $this->assertEquals($r->getHypothesis(), 'bookstores in glendale california');
        $this->assertEquals($r->getLanguageId(), 'en-us');
        $this->assertEquals($r->getConfidence(), 0.9);
        $this->assertEquals($r->getGrade(), "accept");
        $this->assertEquals($r->getResultText(), 'bookstores in Glendale, CA');
        $this->assertEquals($r->getWords()[0], 'bookstores');
        $this->assertEquals($r->getWordScores()[0], 0.92);
    }

}
