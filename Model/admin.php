<?php

    class Admin {
        private $id;
        private $email;
        private $username;
        private $password;
        private $firstname;
        private $lastname;

        public function __construct($id, $username, $firstname,
            $lastname, $email, $password) {

            $this->setId($id);
            $this->setEmail($email);
            $this->setUsername($username);
            $this->setPassword($password);
            $this->setFirstname($firstname);
            $this->setLastname($lastname);
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
            $this->password = sha1($password);
        }

        public function setFirstname($firstname) {
            $this->firstname = $firstname;
        }

        public function setLastname($lastname) {
            $this->lastname = $lastname;
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

        public function __toString() {
            return "Username: " . $this->getUsername() . " | Password: " . $this->getPassword()
             . " | Email: " . $this->getEmail() . " | Firstname: " . $this->getFirstname() . " | Lastname: " . $this->getLastname();
        }

    }





 ?>
