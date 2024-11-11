<?php
require_once 'ParserInterface.php';
require_once __DIR__ . '/../Models/Person.php';

class DomParser implements ParserInterface {
    public function parse($filePath) {
        $people = [];
        $dom = new DOMDocument();
        $dom->load($filePath);

        foreach ($dom->getElementsByTagName('Person') as $personNode) {
            $firstName = $this->getElementValue($personNode, 'FirstName');
            $lastName = $this->getElementValue($personNode, 'LastName');
            $father = $this->getElementValue($personNode, 'Father');
            $faculty = $this->getElementValue($personNode, 'Faculty');
            $chair = $this->getElementValue($personNode, 'Chair');
            $role = $this->getElementValue($personNode, 'Role');
            $scientificInterests = $this->getElementValue($personNode, 'ScientificInterests');
            $timeTenure = $this->getElementValue($personNode, 'TimeTenure');

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

    private function getElementValue(DOMNode $node, $tagName, $default = '') {
        $elements = $node->getElementsByTagName($tagName);
        return $elements->length > 0 ? $elements->item(0)->nodeValue : $default;
    }
}
?>
