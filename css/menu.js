$(document).ready(function(){
    $('#burgerContainer').click(function(e){
        console.log('Bonjour');
        $('#menu').stop(true,true).slideToggle(800);
    });
})