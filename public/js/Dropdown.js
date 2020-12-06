function toggleLoggedInUserDropdown() {
    $('#loggedInDropdown').toggle('show');
};
    
// Close the dropdowns if the user clicks outside of it
window.onclick = function(event) {
    var dropdownBtn = $('.dropbtn')[0];
    if (!$(event.target).hasClass('dropbtn')) {
        var dropdowns = $('.dropdown-menu');
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if ($(openDropdown).is(':visible')) {
                $(openDropdown).hide();
            }
        }   
    }
}

