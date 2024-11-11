<?php
class HtmlTableGenerator {
    public static function generate(array $people) {
        if (empty($people)) {
            return "<p>No matching records found.</p>";
        }

        $html = "<table><tr><th>First Name</th><th>Last Name</th><th>Patronymic</th><th>Faculty</th><th>Cathedra</th><th>Role</th><th>Scientific Interests</th><th>Time Tenure</th></tr>";
        foreach ($people as $person) {
            $html .= "<tr>
                        <td>{$person->getFirstName()}</td>
                        <td>{$person->getLastName()}</td>
                        <td>{$person->getFather()}</td>
                        <td>{$person->getFaculty()}</td>
                        <td>{$person->getChair()}</td>
                        <td>{$person->getRole()}</td>
                        <td>{$person->getScientificInterests()}</td>
                        <td>{$person->getTimeTenure()}</td>
                    </tr>";
        }
        $html .= "</table>";
        return $html;
    }
}
?>
