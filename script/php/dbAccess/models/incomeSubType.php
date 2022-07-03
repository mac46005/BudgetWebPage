<?php
class IncomeSubType{
    public $id = 0;
    public $name = "";
    public $amount = 0;
    public $incomeType_Id = 0;
    public $dateCreated = "";
    public $dateModified = "";

    function __construct($id = 0, $name = "", $amount = 0, $incomeType_Id = 0,$dateCreated = "",$dateModified = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
        $this->incomeType_Id = $incomeType_Id;
        $this->dateCreated = $dateCreated;
        $this->dateModified = $dateModified;
    }
    public function __toString()
    {
        return <<<TOSTRING
        IncomeSubType
        id: $this->id
        name: $this->name
        amount: $this->amount
        incomeType_Id: $this->incomeType_Id
        dateCreated: $this->dateCreated
        dateModified: $this->dateModified
        TOSTRING;
    }
}
?>