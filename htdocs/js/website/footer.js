window.addEventListener("load", function()
{
    var adminButtons = document.getElementsByClassName("go-admin");
    var homeButtons = document.getElementsByClassName("go-home");
    var homeButtons = document.getElementsByClassName("go-cgu");

    for(var i = 0; i < adminButtons.length; i++)
    {
        adminButtons[i].addEventListener("click", function() { window.location.href = "scripts/connect.php"; });
    }
    
    for(var i = 0; i < homeButtons.length; i++)
    {
        homeButtons[i].addEventListener("click", function() { window.location.href = "index.php"; });
    }

    for(var i = 0; i < homeButtons.length; i++)
    {
        homeButtons[i].addEventListener("click", function() { window.location.href = "index.php?area=mentions"; });
    }
});