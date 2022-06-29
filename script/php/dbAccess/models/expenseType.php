<?php
class ExpenseType{
    public $id = 0;
    public $name = "";
    public $dateCreated = "";
    public $dateModified = "";

    function __toString()
    {
        $toString = <<<STRING
        id: $this->id<br/>
        name: $this->name<br/>
        dateCreated: $this->dateCreated<br/>
        dateModified: $this->dateModified<br/>
        STRING;

        return $toString;
    }
}
?>