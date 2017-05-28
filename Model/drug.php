<?php

    class Drug {
        private $code;
        private $name;
        private $dosage;


        public function __construct($code, $name, $dosage) {
            $this->setCode($code);
            $this->setName($name);
            $this->setDosage($dosage);
        }

        public function setCode($code) {
            $this->code = $code;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setDosage($dosage) {
            $this->dosage = $dosage;
        }

        public function getCode() {
            return $this->code;
        }

        public function getName() {
            return $this->name;
        }

        public function getDosage() {
            return $this->dosage;
        }


        public function __toString() {
            return "Code: " . $this->getCode() . " | Name: " . $this->getName() . " Dosage : " . $this->getDosage();
        }

    }



?>
