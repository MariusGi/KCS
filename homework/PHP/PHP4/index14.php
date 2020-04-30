<?php

Class Year
{
    public $starYear;
    private $copyright = '&copy;';
    private $endYear;

    public function getCopyYears()
    {
        $this->endYear = date('Y');
        echo "{$this->copyright} {$this->startYear}-{$this->endYear}";
    }
}

$years = new Year();
$years->startYear = 2000;
$years->getCopyYears();