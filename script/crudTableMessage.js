var elCrudTableMessage = document.querySelector('.crud-table-message');

var elCloseCrudTableMessage = document.getElementById("closeCrudTableMessage");

function CloseCrudTableMessage(){
    if(elCloseCrudTableMessage){
        elCloseCrudTableMessage.addEventListener("click", () => {
        elCrudTableMessage.classList.add("hide");
    });
    }
    
}

CloseCrudTableMessage();