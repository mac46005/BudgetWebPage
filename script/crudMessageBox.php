<?php


class CrudResultContentPopulator {


    function ShowSessionMessage(): void{
        $crudResult = (isset($_GET['crudResult']))? $_GET['crudResult'] : NULL;
        if($crudResult != NULL){
            $message = <<<MESSAGE
            <section>
                <h2>$crudResult->title</h2>
                <p>$crudResult->object</p>
                <hr/>
                <h2>Extra Information</h2>
                <p>$crudResult->object</p>
            </section>
            MESSAGE;
            
            echo $message;

            session_abort();
        }
        
    }

    function ShowTable($crudResult,$addeditLink,$deleteLink): void{
        while($row = $crudResult->object->fetch_row()){
            $rowResult = "<tr>";
            for ($i=0; $i < count($row); $i++) { 
                $rowResult .= "<td>$row[i]</td>";
            }
            $rowResult .= "<td><a href='$addeditLink?dataMode=update&id=$row[0]'>Edit</a></td>";
            $rowResult .= "<td><a href='$deleteLink?dataMode=$crudResult->crudType&id=$row[0]'>Delete</a></td>";
            $rowResult .= "</tr>";
            echo $rowResult;
        }
    }
}


?>