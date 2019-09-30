<?php
namespace App\Entity;

class Aloitelaatikko {
    private $aihe;
    private $kuvaus;
    private $kirjauspvm;
    private $etunimi;
    private $sukunimi;
    private $email;


    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getSukunimi()
    {
        return $this->sukunimi;
    }

    public function setSukunimi($sukunimi)
    {
        $this->sukunimi = $sukunimi;

        return $this;
    }

    public function getEtunimi()
    {
        return $this->etunimi;
    }

    public function setEtunimi($etunimi)
    {
        $this->etunimi = $etunimi;

        return $this;
    }

    public function getKirjauspvm()
    {
        return $this->kirjauspvm;
    }

    public function setKirjauspvm($kirjauspvm)
    {
        $this->kirjauspvm = $kirjauspvm;

        return $this;
    }

    public function getKuvaus()
    {
        return $this->kuvaus;
    }

    public function setKuvaus($kuvaus)
    {
        $this->kuvaus = $kuvaus;

        return $this;
    }

    public function getAihe()
    {
        return $this->aihe;
    }

    public function setAihe($aihe)
    {
        $this->aihe = $aihe;

        return $this;
    }
}
    

?>