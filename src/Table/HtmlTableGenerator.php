<?php
class HtmlTableGenerator {
    public static function generate(array $people) {
        if (empty($people)) {
            return "<p>No matching records found.</p>";
        }

        $html = "<table><tr><th>First Name</th><th>Last Name</th><th>Faculty</th><th>Chair</th><th>Role</th><th>Scientific Interests</th><th>Time Tenure</th></tr>";
        foreach ($people as $person) {
            $html .= "<tr>
                        <td>{$person->firstName}</td>
                        <td>{$person->lastName}</td>
                        <td>{$person->faculty}</td>
                        <td>{$person->chair}</td>
                        <td>{$person->role}</td>
                        <td>{$person->scientificInterests}</td>
                        <td>{$person->timeTenure}</td>
                    </tr>";
        }
        $html .= "</table>";
        return $html;
    }
}
?>
