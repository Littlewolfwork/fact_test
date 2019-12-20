function isNotEmptyField(idField){
    if (document.getElementById(idField).value==""){
        document.getElementById("alerts").innerText = "Заполните пустые поля!";
        document.getElementById(idField).style.border = "2px red solid";
        return 0;
    }
    else{
        document.getElementById(idField).style.border = "";
        return 1
    }
}


function checkField(){
    var startSubmit = 1;
    startSubmit = isNotEmptyField('login');
    startSubmit = isNotEmptyField('name');
    startSubmit = isNotEmptyField('mail');
    startSubmit = isNotEmptyField('password');
    startSubmit = isNotEmptyField('password2');
    if (document.getElementById("password").value != document.getElementById("password2").value){
        document.getElementById("alerts").innerHTML += "<br>Пароли не совпадают!";
        startSubmit = 0;
    }
    console.log(startSubmit);
    if (startSubmit){
        document.getElementById("user_form").submit();
    }




}