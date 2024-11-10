<?php
class Person {
    public string $firstName;
    public string $lastName;
    public string $faculty;
    public string $chair;
    public string $role;
    public string $scientificInterests;
    public string $timeTenure;
    public string $father;

    public function __construct($firstName = '', $lastName = '', $father = '', $faculty= '', $chair= '', $role= '', $scientificInterests= '', $timeTenure= '') {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->father = $father;
        $this->faculty = $faculty;
        $this->chair = $chair;
        $this->role = $role;
        $this->scientificInterests = $scientificInterests;
        $this->timeTenure = $timeTenure;
    }
}
?>
