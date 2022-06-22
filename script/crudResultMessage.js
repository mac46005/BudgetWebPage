var elCrudMessageBox = document.querySelector(".crud-result");

var elCrudCloseBtn = document.getElementById("closeCrudResult");

function closeCrudMessageBox(){
    
    elCrudCloseBtn.addEventListener("click", () => {
        elCrudMessageBox.classList.add("hide");
    });
}

closeCrudMessageBox();