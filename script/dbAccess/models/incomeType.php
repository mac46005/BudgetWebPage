<?php
class IncomeType{
    public $id = 0;
    public $name = "";
    function __construct($id = 0,$name = "")
    {
        $this->id = $id;
        $this->name = $name;
    }

    function __toString()
    {
        $toString = <<<STRING
        IncomeType
        id: $this->id<br/>
        name: $this->name<br/>
        STRING;
        
        return $toString;
    }
}
?>