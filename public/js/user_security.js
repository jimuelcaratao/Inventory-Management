document.getElementById('editFirstname').onclick = function(e) {
    document.getElementById('inputFirstname').removeAttribute('readonly');
    document.getElementById("inputFirstname").focus();
};
document.getElementById('editLastname').onclick = function(e) {
    document.getElementById('inputLastname').removeAttribute('readonly');
    document.getElementById("inputLastname").focus();
};
document.getElementById('editMiddlename').onclick = function(e) {
    document.getElementById('inputMiddlename').removeAttribute('readonly');
    document.getElementById("inputMiddlename").focus();
};

// alert to fade
$("#element").fadeTo(2000, 500).slideUp(500, function(){
    $("#element").slideUp(500);
});