const imputPassword = document.querySelector("#passwordImput")
 
function togglePassword(){
    if (imputPassword.type=="password"){
        imputPassword.type = "text";
    } else {
        imputPassword.type = "password";
    }
}