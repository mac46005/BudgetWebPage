<?php

require '../dbAccess/baseDBAccessModels/MySqliClasses.php';
class CRUD_ResultContentPopulator {
    private ?CRUD_Result $crudResult = NULL;


    function DisplaySessionMessage() : void{
        if(isset($_SESSION['crudResult'])){
            $crudResult = $_SESSION['crudResult'];
            $crudBackground = ($crudResult->isComplete == TRUE)? "success" : "failed";
            
            echo self::CRUDMessageBox($crudResult,$crudBackground);


        }


    }

    function SetCRUD_Result(CRUD_Result $crudResult) : void{
        $this->crudResult = $crudResult;
    }
    function DisplayCRUDDataRow(){

    }

    private function CRUDMessageBox(CRUD_Result $crudResult = NULL,$classItem = "") : string{
        $messageBox = "";
        if($crudResult != NULL){
            $messageBox = <<<MESSAGE
            <section class="crud-result $classItem">
                <h2>$crudResult->title</h2>
                <p>$crudResult->message</p>
                <hr/>
                <h2>Object Info</h2>
                <p>$crudResult->object</p>
                <button id="closeCrudResult">Continue</button>
            </section>
            MESSAGE;
        }

        return $messageBox;
    }
}


?>