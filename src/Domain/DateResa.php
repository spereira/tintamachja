<?php

namespace TINTA\Domain;

class DateResa
{
    /**
     * dateDeb.
     *
     * @var date
     */
    private $dateDeb;

    /**
     * dateFin.
     *
     * @var date
     */
    private $dateFin;
    
    
    public function getDateDeb() {
        return $this->dateDeb;
    }

    public function setDateDeb($dateDeb) {
        $this->dateDeb = $dateDeb;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }
    
}
