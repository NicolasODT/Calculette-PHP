<?php

class Calculatrice {

    public function addition(float $a, float $b) {
      return $a + $b;
    }
  
    public function soustraction(float $a, float $b) {
      return $a - $b;
    }
  
    public function multiplication(float $a, float $b) {
      return $a * $b;
    }
  
    public function division(float $a, float $b) {
      return $a / $b;
    }
  
    public function pourcentage(float $a, float $b) {
      return ($a * $b) / 100;
    }
  }