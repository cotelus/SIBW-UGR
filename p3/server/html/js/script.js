var comments_displayed = false;
forbiddenWord = "";
index = 0;

var word_set =[
    "sibw",
    "profesor",
    "asignatura",
    "sistemas",
    "casa",
    "coche",
    "perro",
    "gato",
    "mono",
    "pepino"
];

// Muestra o no el div que tiene los comentarios y el formulario ( y desplaza el boton de comentarios)
function toggleComments() {
    var comments_button = document.getElementById('comment-button');
    var comments = document.getElementById('comment-bar');
    if(comments_displayed){
        comments.classList.remove('comment-bar-active');
        comments_displayed = false;
        comments_button.classList.remove('active-comment-button');
    } else {
        comments.classList.add('comment-bar-active');
        comments_displayed = true;
        comments_button.classList.add('active-comment-button');
    }
}


// Añade el comentario que se haya dejado en el formulario
function addComment(event){
    event.preventDefault();
    var name = document.getElementById('name');
    var message = document.getElementById('message');
    var email = document.getElementById('email');
    if(itsEmptyField(name) || itsEmptyField(email) || itsEmptyField(message)) {
        alert("Hay un error con algún campo");
        return false;
    }

    if(!itsCorrectEmail(email)){
        alert("El e-mail no es válido");
        return false;
    }

    var comments = document.getElementsByClassName('comment-section');
    var date = (new Date()).toLocaleString('es-ES',{timeZone:'Europe/Madrid'});

    comments[0].insertAdjacentHTML('beforeend', "\n" +
    "<div class=\"comment\">\n" +
    "   <h5>\n" +
    "       <a href=\"mailto:"+email.value+"\">\n"+
    "               "+name.value+"\n" +
    "       </a>\n" +
    "   </h5>\n" +
    "   <span class=\"comment-subheading\">Escrito: <strong>"+date+"</strong></span>\n" +
    "   <p class=\"comment-text\">\n" +
    "       "+message.value+"\n" +
    "   </p>\n" +
    "</div>");

    return false;
}

// Comprueba si un campo está vacio
function itsEmptyField(field){
    var value = field.value;
    var vacio = false;

    if(value.trim() == "" || value === null || value === undefined){
        vacio = true;
    }
    
    return vacio;
}

// Devuelve true si el email tiene una forma válida y false en caso contrario
function itsCorrectEmail(email){
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email.value).toLowerCase());
}

// Almacena cada tecla pulsada:
//              1.- Si la tecla pulsada no es el espacio, almacena la tecla
//              2.- Si la tecla pulsada es el espacio, comprueba el string que haya almacenado
function addStringtoForbidden(event){
    var key = String.fromCharCode(event.keyCode).toLowerCase();
    var re2 = /[a-zA-Z]/;
    var text = document.getElementById("message");
    
    if(re2.test(key)){
        forbiddenWord += key;
    }
    else{
        //console.log(forbiddenWord);
        if(key === " " || key === "."){
            checkForbiddenWord(forbiddenWord);        
            forbiddenWord = "";
        }
        if(event.keyCode === 8){
            forbiddenWord = forbiddenWord.substring(0, forbiddenWord.length - 1);
        }
        if(event.keyCode === 10){
            forbiddenWord = "";
        }
    }

    index = text.value.length;
}

// Comprueba si la palabra pertenece a las palabras prohibidas
function checkForbiddenWord(word){
    var i;
    for(i = 0; i < word_set.length; i++){
        if(word === word_set[i]  && (word.length === word_set[i].length)){
            censorWord(word, index);
        }

    }
}

// Cambia la palabra por una cadena de * de la misma longitud que la palabra prohibida
function censorWord(word){
    var text = document.getElementById("message");

    var newWord = "";
    for (var i = 0; i < word.length; i++){
        newWord += "*";
    }

    //var res = text.value.replace(word, newWord);

    var res = text.value.substring(0, index - word.length) + newWord + " ";


    text.value = res;
}




/* Esto es para el modal ( extraido de w3schools directamente ) */
var loginModal = document.getElementById('login-modal');

// Get the button that opens the modal
var loginBtn = document.getElementById("login-btn");

// Get the <span> element that closes the modal
var loginSpan = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
loginBtn.onclick = function() {
    loginModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
loginSpan.onclick = function() {
    loginModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == loginModal) {
    loginModal.style.display = "none";
  }
}

/* Muy similar para el modal de registro */
var signInModal = document.getElementById('sign-in-modal');
var signInBtn = document.getElementById("sign-in-btn");
var signInSpan = document.getElementsByClassName("close")[1];

signInBtn.onclick = function() {
    signInModal.style.display = "block";
    // Esto es para que el modal de inicio de sesión se cierre cuando te registras
    loginModal.style.display = "none";
}

signInSpan.onclick = function() {
    signInModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == signInModal) {
      signInModal.style.display = "none";
    }
}