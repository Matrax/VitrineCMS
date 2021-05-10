window.addEventListener("load", function()
{
    var buttons = document.getElementsByClassName("navbar-button");
    for(var i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener("click", function() { window.location.href = "index.php?area=" + this.attributes["url"].value; }); 
    }
});