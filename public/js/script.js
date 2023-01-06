const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');

function isEmail (email){
    return /\S+@\S+\.\S+/.test(email);
}

function isPasswordSecure (password){
    const upperCaseLetters = /[A-Z]/g;
    const numbers = /[0-9]/g;
    const lowerCaseLetters = /[a-z]/g;

    if (!password.match(upperCaseLetters))  return false;
    if (!password.match(lowerCaseLetters))  return false;
    if (!password.match(numbers))  return false;
    return password.length >= 8;
}

function markValidation(element, condition){
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail() {
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value))
        }
        , 1000);
}

function validatePassword(){
    setTimeout(function (){
        const condition = isPasswordSecure(
            passwordInput.value
        );
        markValidation(passwordInput,condition);
    }
    ,1000);
}

emailInput.addEventListener('keyup', validateEmail);
passwordInput.addEventListener('keyup', validatePassword);