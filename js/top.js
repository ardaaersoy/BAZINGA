$(document).ready(function () {

    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        if (document.documentElement.scrollTop > 500) {
            document.getElementById("topp").style.display = "block";
        } else {
            document.getElementById("topp").style.display = "none";
        }
    }

});