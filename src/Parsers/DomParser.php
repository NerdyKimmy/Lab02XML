<?php
require_once 'ParserInterface.php';
require_once __DIR__ . '/../Models/Person.php';

class DomParser implements ParserInterface {
    public function parse($filePath) {
        $people = [];
        $dom = new DOMDocument();
        $dom->load($filePath);
        foreach ($dom->getElementsByTagName('Person') as $personNode) {
            $person = new Person(
                $personNode->getElementsByTagName('FirstName')->item(0)->nodeValue,
                $personNode->getElementsByTagName('LastName')->item(0)->nodeValue,
                $personNode->getElementsByTagName('Faculty')->item(0)->nodeValue,
                $personNode->getElementsByTagName('Chair')->item(0)->nodeValue,
                $personNode->getElementsByTagName('Role')->item(0)->nodeValue,
                $personNode->getElementsByTagName('ScientificInterests')->item(0)->nodeValue,
                $personNode->getElementsByTagName('TimeTenure')->item(0)->nodeValue
            );
            $people[] = $person;
        }
        return $people;
    }
}
?>
