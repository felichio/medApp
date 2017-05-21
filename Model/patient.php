<?php

    class Patient {
        private $id;
        private $firstname;
        private $lastname;
        private $amka;
        private $dateOfBirth;

        public function __construct($id, $firstname,
            $lastname, $amka, $dateOfBirth) {

            $this->setId($id);
            $this->setFirstname($firstname);
            $this->setLastname($lastname);
            $this->setAmka($username);
            $this->setDateOfBirth($dateOfBirth);
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setFirstname($firstname) {
            $this->firstname = $firstname;
        }

        public function setLastname($lastname) {
            $this->lastname = $lastname;
        }

        public function setAmka($amka) {
            $this->amka = $amka;
        }

        public function setDateOfBirth($dateOfBirth) {
            $this->dateOfBirth = $dateOfBirth;
        }

        public function getId() {
            return $this->id;
        }

        public function getFirstname() {
            return $this->firstname;
        }

        public function getLastname() {
            return $this->lastname;
        }

        public function getDateOfBirth() {
            return $this->dateOfBirth;
        }

        public function getAmka() {
            return $this->amka;
        }

        public function __toString() {
            return "Firstname: " . $this->getFirstname() . " | Lastname: " . $this->getLastname() . " ID: " . $this->id . " | DOB: " . $this->getDateOfBirth();
        }

    }



 ?>
