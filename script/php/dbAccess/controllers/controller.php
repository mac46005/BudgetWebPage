<?php

interface IDataPageController{
    function RunController();
}
class BaseDataPageController implements IDataPageController{
    private $crudResult = NULL;
    private $addEditLink = "";
    private $dataManagerLink = "";
    function __construct()
    {
        
    }
    public function RunController(){

    }
}
?>