<?php
require_once 'ParserInterface.php';
require_once __DIR__ . '/../Models/Person.php';

class SaxParser implements ParserInterface {
    public function parse($filePath) {
        $people = [];
        $reader = new XMLReader();
        $reader->open($filePath);

        $person = null;
        $currentElement = '';

        while ($reader->read()) {
            switch ($reader->nodeType) {
                case (XMLReader::ELEMENT):
                    $currentElement = $reader->localName;
                    if ($currentElement == 'Person') {
                        $person = new Person();
                    }
                    break;

                case (XMLReader::TEXT):
                    if ($person) {
                        switch ($currentElement) {
                            case 'FirstName':
                                $person->setFirstName($reader->value);
                                break;
                            case 'LastName':
                                $person->setLastName($reader->value);
                                break;
                            case 'Father':
                                $person->setFather($reader->value);
                                break;
                            case 'Faculty':
                                $person->setFaculty($reader->value);
                                break;
                            case 'Chair':
                                $person->setChair($reader->value);
                                break;
                            case 'Role':
                                $person->setRole($reader->value);
                                break;
                            case 'ScientificInterests':
                                $person->setScientificInterests($reader->value);
                                break;
                            case 'TimeTenure':
                                $person->setTimeTenure($reader->value);
                                break;
                        }
                    }
                    break;

                case (XMLReader::END_ELEMENT):
                    if ($reader->localName == 'Person' && $person) {
                        $people[] = $person;
                        $person = null;
                    }
                    break;
            }
        }

        $reader->close();
        return $people;
    }
}
?>
