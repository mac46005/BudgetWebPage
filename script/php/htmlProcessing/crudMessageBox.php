<?php



class CRUD_ResultContentPopulator {
    private ?CRUD_Result $crudResult = NULL;

    /**
     * Displays the current session CRUD_Result object given by the controller.
     */
    function DisplaySessionMessage() : void{
        $sessionId = 'crudResult';
        if(isset($_SESSION[$sessionId])){
            $crudResult = $_SESSION[$sessionId];
            $crudBackground = ($crudResult->isComplete == TRUE)? "success" : "failed";
            
            echo $this->CRUDMessageBox($crudResult,$crudBackground);
            session_destroy();

        }else{
            session_abort();
        }


    }

    function DisplayTableData_OrErrorMessage(CRUD_Result $crudResult,$editLinkName,$deleteLinkName){
        if($crudResult->isComplete == TRUE){
            while($row = $crudResult->dataObject->fetch_row()){
                $rowString = "<tr>";

                for ($i=0; $i < count($row); $i++) { 
                    $rowString .= "<td>$row[$i]</td>";
                }
                $rowString .= "<td><a class='btn btn-edt' href='$editLinkName?dataMode=update&id=$row[0]'>Update</a></td>";
                $rowString .= "<td><a class='btn btn-dlt' href='$deleteLinkName?dataMode=delete&id=$row[0]'>Delete</a></td>";

                echo $rowString;

            }
        }else{
            echo $this->CRUDMessageBox($crudResult,"failed");
        }
        
    }

    public function DisplayUpdateErrorMessage(IReadOne $dbCrud,$id){
        $dataObject = NULL;
        $crudResult = NULL;
        if($crudResult = $dbCrud->ReadOne($id)){
            if($crudResult->isComplete == FALSE){
                $crudBackground = "failed";
                echo $this->CRUDMessageBox($crudResult,$crudBackground);
            }else{
                $dataObject = $crudResult->dataObject;
            }
        }
        return $dataObject;
    }
    public function CRUDMessageBox(CRUD_Result $crudResult = NULL,$classItem = "") : string{
        $messageBox = "";
        if($crudResult != NULL){
            $messageBox = <<<MESSAGE
            <section class="crud-result $classItem">
                <h2>$crudResult->title</h2>
                <h3>Function: $crudResult->dataMode</h3>
                <p>$crudResult->message</p>
                <hr/>
                <h2>Object Info</h2>
                <p>$crudResult->dataObject</p>
                <button id="closeCrudResult">Continue</button>
            </section>
            MESSAGE;
        }

        return $messageBox;
    }
}


?>