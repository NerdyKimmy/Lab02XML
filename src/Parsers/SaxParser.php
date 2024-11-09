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
                    // Переходим к новым элементам
                    $currentElement = $reader->localName;
                    if ($currentElement == 'Person') {
                        // Создаем новый объект Person
                        $person = new Person();
                    }
                    break;

                case (XMLReader::TEXT):
                    // Заполняем данные в Person
                    if ($person) {
                        switch ($currentElement) {
                            case 'FirstName':
                                $person->firstName = $reader->value;
                                break;
                            case 'LastName':
                                $person->lastName = $reader->value;
                                break;
                            case 'Faculty':
                                $person->faculty = $reader->value;
                                break;
                            case 'Chair':
                                $person->chair = $reader->value;
                                break;
                            case 'Role':
                                $person->role = $reader->value;
                                break;
                            case 'ScientificInterests':
                                $person->scientificInterests = $reader->value;
                                break;
                            case 'TimeTenure':
                                $person->timeTenure = $reader->value;
                                break;
                        }
                    }
                    break;

                case (XMLReader::END_ELEMENT):
                    // Когда заканчивается элемент Person, добавляем его в массив
                    if ($reader->localName == 'Person' && $person) {
                        $people[] = $person;
                        $person = null; // Сбрасываем текущего человека для следующего
                    }
                    break;
            }
        }

        $reader->close();
        return $people;
    }
}
?>
