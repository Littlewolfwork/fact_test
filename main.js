function actionGroupCheck(){
    let listCheck = document.querySelectorAll(".user-checkbox");
    //console.log(listCheck)
    let checkedStatus = document.querySelector(".th-checkbox").checked;
    console.log(thChecked)
    for (let i=0;i<listCheck.length;i++){
        listCheck[i].checked = checkedStatus;
    }



}