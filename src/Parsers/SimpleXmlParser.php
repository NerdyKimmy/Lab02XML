<?php
require_once 'ParserInterface.php';
require_once __DIR__ . '/../Models/Person.php';

class SimpleXmlParser implements ParserInterface {
    public function parse($filePath) {
        $xml = simplexml_load_file($filePath);
        $people = [];

        foreach ($xml->Person as $personNode) {
            $firstName = $this->getElementValue($personNode->NameSurnameFather, 'FirstName');
            $lastName = $this->getElementValue($personNode->NameSurnameFather, 'LastName');
            $father = $this->getElementValue($personNode->NameSurnameFather, 'Father');
            $faculty = $this->getElementValue($personNode->OtherInfo, 'Faculty');
            $chair = $this->getElementValue($personNode->OtherInfo, 'Chair');
            $role = $this->getElementValue($personNode->OtherInfo, 'Role');
            $scientificInterests = $this->getElementValue($personNode->OtherInfo, 'ScientificInterests');
            $timeTenure = $this->getElementValue($personNode->OtherInfo, 'TimeTenure');

            $person = new Person(
                $firstName,
                $lastName,
                $father,
                $faculty,
                $chair,
                $role,
                $scientificInterests,
                $timeTenure
            );
            $people[] = $person;
        }

        return $people;
    }

    private function getElementValue($node, $elementName, $default = '') {
        return isset($node->$elementName) ? (string)$node->$elementName : $default;
    }
}
?>
