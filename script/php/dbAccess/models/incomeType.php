<?php
class IncomeType{
    public $id = 0;
    public $name = "";
    public $dateCreated = "";
    public $dateModified = "";
    function __construct($id = 0,$name = "", $dateCreated = "", $dateModified = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->dateCreated = $dateCreated;
        $this->dateModified = $dateModified;
    }

    function __toString()
    {
        $toString = <<<STRING
        IncomeType<br/>
        id: $this->id<br/>
        name: $this->name<br/>
        STRING;
        
        return $toString;
    }
}
?>