<?php

    class Drug {
        private $code;
        private $name;
        private $dateOfIssue;


        public function __construct($code, $name, $dateOfIssue) {
            $this->setCode($code);
            $this->setName($name);
            $this->setDateOfIssue($dateOfIssue);
        }

        public function setCode($code) {
            $this->code = $code;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setDateOfIssue($dateOfIssue) {
            $this->dateOfIssue = $dateOfIssue;
        }

        public function getCode() {
            return $this->code;
        }

        public function getName() {
            return $this->name;
        }

        public function getDateOfIssue() {
            return $this->dateOfIssue;
        }


        public function __toString() {
            return "Code: " . $this->getCode() . " | Name: " . $this->getName() . " DOI : " . $this->getDateOfIssue();
        }

    }



?>
