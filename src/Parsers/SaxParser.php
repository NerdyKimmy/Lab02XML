<?php

require_once 'ParserInterface.php';
require_once __DIR__ . '/../Models/Person.php';

class SaxParser
{
    private array $people = [];
    private ?string $currentElement = null;
    private array $currentData = [
        'firstName' => '',
        'lastName' => '',
        'faculty' => '',
        'chair' => '',
        'role' => '',
        'scientificInterests' => '',
        'timeTenure' => ''
    ];

    public function parse(string $filePath): array
    {
        $xmlParser = xml_parser_create();

        xml_set_element_handler($xmlParser, [$this, "startElement"], [$this, "endElement"]);
        xml_set_character_data_handler($xmlParser, [$this, "characterData"]);

        if (!($file = fopen($filePath, "r"))) {
            throw new \Exception("Cannot open XML data file.");
        }

        while ($data = fread($file, 4096)) {
            if (!xml_parse($xmlParser, $data, feof($file))) {
                throw new \Exception(sprintf(
                    "XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($xmlParser)),
                    xml_get_current_line_number($xmlParser)
                ));
            }
        }

        fclose($file);
        xml_parser_free($xmlParser);

        return $this->people;
    }

    private function startElement($parser, $name, $attrs)
    {
        $this->currentElement = $name;
    }

    private function endElement($parser, $name)
    {
        if ($name == 'Person') {
            // Створюємо об'єкт Person зібраними даними
            $person = new Person(
                $this->currentData['firstName'],
                $this->currentData['lastName'],
                $this->currentData['faculty'],
                $this->currentData['chair'],
                $this->currentData['role'],
                $this->currentData['scientificInterests'],
                $this->currentData['timeTenure']
            );

            // Додаємо об'єкт до масиву людей
            $this->people[] = $person;

            // Очищаємо дані для наступного об'єкта Person
            $this->currentData = [
                'firstName' => '',
                'lastName' => '',
                'faculty' => '',
                'chair' => '',
                'role' => '',
                'scientificInterests' => '',
                'timeTenure' => ''
            ];
        }

        $this->currentElement = null;
    }

    private function characterData($parser, $data)
    {
        // Обрізаємо пробіли та перевіряємо, чи є текст
        $data = trim($data);
        if (empty($data)) {
            return;
        }

        // Залежно від поточного елемента записуємо дані в відповідне поле
        switch ($this->currentElement) {
            case 'FirstName':
                $this->currentData['firstName'] .= $data;
                break;
            case 'LastName':
                $this->currentData['lastName'] .= $data;
                break;
            case 'Faculty':
                $this->currentData['faculty'] .= $data;
                break;
            case 'Chair':
                $this->currentData['chair'] .= $data;
                break;
            case 'Role':
                $this->currentData['role'] .= $data;
                break;
            case 'ScientificInterests':
                $this->currentData['scientificInterests'] .= $data;
                break;
            case 'TimeTenure':
                $this->currentData['timeTenure'] .= $data;
                break;
        }
    }
}
