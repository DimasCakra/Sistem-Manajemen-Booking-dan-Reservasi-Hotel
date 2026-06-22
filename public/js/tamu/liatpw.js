const checkbox = document.getElementById('showPassword');
const password = document.getElementById('password');

checkbox.addEventListener('change', function(){
    if(this.checked){
        password.type = "text";
    }else{
        password.type = "password";
    }

});
