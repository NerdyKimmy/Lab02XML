<?php
class Person {
    private string $firstName;
    private string $lastName;
    private string $father;
    private string $faculty;
    private string $chair;
    private string $role;
    private string $scientificInterests;
    private string $timeTenure;


    public function __construct($firstName = '', $lastName = '', $father = '', $faculty = '', $chair = '', $role = '', $scientificInterests = '', $timeTenure = '') {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->father = $father;
        $this->faculty = $faculty;
        $this->chair = $chair;
        $this->role = $role;
        $this->scientificInterests = $scientificInterests;
        $this->timeTenure = $timeTenure;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getFather(): string {
        return $this->father;
    }

    public function getFaculty(): string {
        return $this->faculty;
    }

    public function getChair(): string {
        return $this->chair;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getScientificInterests(): string {
        return $this->scientificInterests;
    }

    public function getTimeTenure(): string {
        return $this->timeTenure;
    }

    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }

    public function setFather(string $father): void {
        $this->father = $father;
    }

    public function setFaculty(string $faculty): void {
        $this->faculty = $faculty;
    }

    public function setChair(string $chair): void {
        $this->chair = $chair;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    public function setScientificInterests(string $scientificInterests): void {
        $this->scientificInterests = $scientificInterests;
    }

    public function setTimeTenure(string $timeTenure): void {
        $this->timeTenure = $timeTenure;
    }
}
?>
