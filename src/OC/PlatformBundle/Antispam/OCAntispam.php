<?php
// src/OC/PlatformBundle/Antispam/OCAntispam.php

namespace OC\PlatformBundle\Antispam;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OCAntispam extends Bundle
{
  private $mailer;
  private $locale;
  private $minLength;

  public function __construct(\Swift_Mailer $mailer, $locale, $minLength)
  {
    $this->mailer    = $mailer;
    $this->locale    = $locale;
    $this->minLength = (int) $minLength;
  }
  
  public function locale() { return $this->locale; }
  public function minLenght() { return $this->minLength; }

  /**
   * Vérifie si le texte est un spam ou non
   *
   * @param string $text
   * @return bool
   */
  public function isSpam($text)
  {
    return strlen($text) < $this->minLength;
  }
}