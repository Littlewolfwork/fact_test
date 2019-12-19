function emptyField(idField){
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
  /*  let login = document.getElementById("login").value;
    let name = document.getElementById("name").value;
    let mail = document.getElementById("mail").value;
    let password = document.getElementById("password").value;
    let password2 = document.getElementById("password2").value;
    */
    var startSubmit = 1;
   // console.log(startSubmit);
   // console.log('test');
    startSubmit = emptyField('login');
    startSubmit = emptyField('name');
    startSubmit = emptyField('mail');
    startSubmit = emptyField('password');
    startSubmit = emptyField('password2');
    if (document.getElementById("password").value != document.getElementById("password2").value){
        document.getElementById("alerts").innerHTML += "<br>Пароли не совпадают!";
        startSubmit = 0;
    }
    console.log(startSubmit);
    if (startSubmit){
        document.getElementById("user_form").submit();
    }




}