<?php

    class Admin {
        private $id;
        private $email;
        private $username;
        private $password;

        public function __construct($id, $email, $username, $password) {
            $this->setId($id);
            $this->setEmail($email);
            $this->setUsername($username);
            $this->setPassword($password);
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

        public function getId() {
            return $this->id;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getPassword() {
            return $this->password;
        }

        public function __toString() {
            return "Username: " . $this->getUsername() . " | Password: " . $this->getPassword() . " | Email: " . $this->getEmail();
        }

    }





 ?>
