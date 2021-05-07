$( document ).ready(function(){
let dropdown=document.getElementById("dropdown");
    let account= document.getElementById('account');
    if (account) {
        account.addEventListener('click', (event) => {
            dropdown.classList.toggle("show");

        });
    }

});
