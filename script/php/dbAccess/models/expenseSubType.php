<?php
class ExpenseSubType{
    public $id = 0;
    public $name = "";
    public $expenseType_Id = 0;
    public $dateCreated = "";
    public $dateModified = "";

    function __construct($id = 0, $name = "",$expenseType_id = 0, $dateCreated = "", $dateModified = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->expenseType_Id = $expenseType_id;
        $this->dateCreated = $dateCreated;
        $this->dateModified = $dateModified;
    }

    function __toString()
    {
        $toString = <<<STRING
        id: $this->id<br/>
        name: $this->name<br/>
        expenseType_id: $this->expenseType_Id<br/>
        dateCreated: $this->dateCreated<br/>
        dateModified: $this->dateModified<br/>
        STRING;
        return $toString;
    }
}
?>