<?php
class CRUD_ResultContentPopulator {
    private ?CRUD_Result $crudResult = NULL;


    function DisplaySessionMessage() : void{
        if(isset($_SESSION['crudResult'])){
            $crudResult = $_SESSION['crudResult'];
            $crudBackground = ($crudResult->isComplete == TRUE)? "success" : "failed";
            
            echo self::CRUDMessageBox($crudResult,$crudBackground);

        }else{
            session_abort();
        }


    }
    function DisplayCRUDDataRow(CRUD_Result $crudResult,$editLinkName,$deleteLinkName){
        if($crudResult->isComplete == TRUE){
            while($row = $crudResult->object->fetch_row()){
                $rowString = "<tr>";

                for ($i=0; $i < count($row); $i++) { 
                    $rowString .= "<td>$row[$i]</td>";
                }
                $rowString .= "<td><a class='btn btn-edt' href='$editLinkName?dataMode=update&id=$row[0]'>Update</a></td>";
                $rowString .= "<td><a class='btn btn-dlt' href='$deleteLinkName?dataMode=delete&id=$row[0]'>Delete</a></td>";

                echo $rowString;

            }
        }else{
            echo self::CRUDMessageBox($crudResult,"failed");
        }
        
    }

    public function DisplayUpdateErrorMessage(IReadOne $dbCrud,$id){
        $object = NULL;
        $crudResult = NULL;
        if($crudResult = $dbCrud->ReadOne($id)){
            if($crudResult->isComplete == FALSE){
                $crudBackground = "failed";
                echo self::CRUDMessageBox($crudResult,$crudBackground);
            }else{
                $object = $crudResult::$object;
            }
        }
        return $object;
    }
    private function CRUDMessageBox(CRUD_Result $crudResult = NULL,$classItem = "") : string{
        $messageBox = "";
        if($crudResult != NULL){
            $messageBox = <<<MESSAGE
            <section class="crud-result $classItem">
                <h2>$crudResult->title</h2>
                <h3>Function: $crudResult->dataMode</h3>
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