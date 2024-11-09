<?php
require_once 'src/Context/ParserContext.php';
require_once 'src/Models/PersonFilter.php';
require_once 'src/Table/HtmlTableGenerator.php';
require_once 'src/Parsers/SaxParser.php';
require_once 'src/Parsers/DomParser.php';
require_once 'src/Parsers/LinqParser.php';

$htmlTable = '';
$uploadError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['xmlFile']) && $_FILES['xmlFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['xmlFile']['tmp_name'];
        $fileName = $_FILES['xmlFile']['name'];
        $destinationPath = 'data/' . $fileName;

        if (move_uploaded_file($fileTmpPath, $destinationPath)) {
            $filePath = $destinationPath;
        } else {
            $uploadError = 'File upload failed. Please try again.';
        }
    } else {
        $filePath = 'data/data.xml'; // Default XML file path
    }

    if (!$uploadError) {
        $parserChoice = $_POST['parserChoice'];
        $parserContext = new ParserContext(new $parserChoice());
        $people = $parserContext->parse($filePath);

        $filters = [
            'faculty' => $_POST['faculty'] ?? '',
            'firstName' => $_POST['firstName'] ?? '',
            'lastName' => $_POST['lastName'] ?? '',
            'father' => $_POST['father'] ?? '',
            'chair' => $_POST['chair'] ?? '',
            'role' => $_POST['role'] ?? '',
            'dateBefore' => $_POST['dateBefore'] ?? '',
            'dateAfter' => $_POST['dateAfter'] ?? ''
        ];

        $filteredPeople = PersonFilter::filter($people, $filters);
        $htmlTable = HtmlTableGenerator::generate($filteredPeople);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XML Parser</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script>
        function clearForm() {
            document.getElementById("parserForm").reset();  // Reset all form inputs
            document.getElementById("resultTable").innerHTML = '';  // Clear table content
        }
    </script>
</head>
<body>
<h1>XML Parser</h1>
<?php if ($uploadError): ?>
    <p style="color: red;"><?= $uploadError ?></p>
<?php endif; ?>
<form id="parserForm" method="POST" enctype="multipart/form-data">
    <label for="xmlFile">Upload XML File:</label>
    <input type="file" name="xmlFile" id="xmlFile" accept="application/xml"><br><br>

    <label for="parserChoice">Choose Parser:</label>
    <select name="parserChoice" id="parserChoice">
        <option value="SaxParser">SAX</option>
        <option value="DomParser">DOM</option>
        <option value="LinqParser">LINQ</option>
    </select><br><br>

    <label for="faculty">Faculty<br></label>
    <input type="text" name="faculty" id="faculty"><br><br>

    <label for="firstName">First Name<br></label>
    <input type="text" name="firstName" id="firstName"><br><br>

    <label for="lastName">Last Name<br></label>
    <input type="text" name="lastName" id="lastName"><br><br>

    <label for="father">Patronymic<br></label>
    <input type="text" name="father" id="father"><br><br>

    <label for="chair">Cathedra<br></label>
    <input type="text" name="chair" id="chair"><br><br>

    <label for="role">Role<br></label>
    <input type="text" name="role" id="role"><br><br>

    <label for="dateBefore">Date Before<br></label>
    <input type="date" name="dateBefore" id="dateBefore"><br><br>

    <label for="dateAfter">Date After<br></label>
    <input type="date" name="dateAfter" id="dateAfter"><br><br>

    <button type="submit">Parse</button>
    <button type="button" onclick="clearForm()">Clear</button>
</form>

<div id="resultTable"><?= $htmlTable ?? '' ?></div>

</body>
</html>
