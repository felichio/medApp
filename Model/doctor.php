<?php

    class Doctor {
        private $id;
        private $email;
        private $username;
        private $password;
        private $firstname;
        private $lastname;
        private $amka;

        public function __construct($id, $username, $firstname,
            $lastname, $email, $password, $amka) {

            $this->setId($id);
            $this->setEmail($email);
            $this->setUsername($username);
            $this->setPassword($password);
            $this->setFirstname($firstname);
            $this->setLastname($lastname);
            $this->setAmka($amka);
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function setPassword($password) {
            $this->password = $password;
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

        public function getId() {
            return $this->id;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getFirstname() {
            return $this->firstname;
        }

        public function getLastname() {
            return $this->lastname;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getAmka() {
            return $this->amka;
        }

        public function __toString() {
            return "Username: " . $this->getUsername() . " | Password: " . $this->getPassword()
             . " | Email: " . $this->getEmail() . " | Firstname: " . $this->getFirstname() . " | Lastname: " . $this->getLastname() .
             " | Amka: " . $this->getAmka();
        }

        function compare($other) {
            if ($other instanceof Doctor) {
                $attributes = [];
                if ($this->getUsername() !== $other->getUsername()) {
                    $attributes["username"] = "getUsername";
                }
                if ($this->getFirstname() !== $other->getFirstname()) {
                    $attributes["firstname"] = "getFirstname";
                }
                if ($this->getLastname() !== $other->getLastname()) {
                    $attributes["lastname"] = "getLastname";
                }
                if ($this->getEmail() !== $other->getEmail()) {
                    $attributes["email"] = "getEmail";
                }
                if ($this->getAmka() !== $other->getAmka()) {
                    $attributes["amka"] = "getAmka";
                }

                return $attributes;
            }
        }

    }





 ?>
