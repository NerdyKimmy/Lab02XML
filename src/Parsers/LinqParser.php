<?php
require_once 'ParserInterface.php';
require_once __DIR__ . '/../Models/Person.php';

class LinqParser implements ParserInterface {
    public function parse($filePath) {
        $xml = simplexml_load_file($filePath);
        $people = [];

        foreach ($xml->Person as $personNode) {
            $person = new Person(
                (string)$personNode->NameSurnameFather->FirstName,
                (string)$personNode->NameSurnameFather->LastName,
                (string)$personNode->NameSurnameFather->Father,
                (string)$personNode->OtherInfo->Faculty,
                (string)$personNode->OtherInfo->Chair,
                (string)$personNode->OtherInfo->Role,
                (string)$personNode->OtherInfo->ScientificInterests,
                (string)$personNode->OtherInfo->TimeTenure
            );
            $people[] = $person;
        }

        return $people;
    }
}
?>
