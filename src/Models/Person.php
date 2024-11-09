<?php
class Person {
    public $firstName;
    public $lastName;
    public $faculty;
    public $chair;
    public $role;
    public $scientificInterests;
    public $timeTenure;

    public function __construct($firstName, $lastName, $faculty, $chair, $role, $scientificInterests, $timeTenure) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->faculty = $faculty;
        $this->chair = $chair;
        $this->role = $role;
        $this->scientificInterests = $scientificInterests;
        $this->timeTenure = $timeTenure;
    }
}
?>
