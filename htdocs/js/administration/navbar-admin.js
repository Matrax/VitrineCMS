window.addEventListener("load", function()
{
    var url = document.getElementById("json").attributes["url"].value;
    var buttonHome = document.getElementById("button-home");
    var buttonDisconnect = document.getElementById("button-disconnect");
    var buttonCreate = document.getElementById("button-create");
    var buttonPassword = document.getElementById("button-password");
    var buttonDelete = document.getElementById("button-delete");
    var inputCreate = document.getElementsByClassName("navbar-create-input")[0];
    var buttons = document.getElementsByClassName("navbar-button-administration");

    buttonCreate.addEventListener("click", function() { window.location.href = "scripts/create_page.php?area=" + inputCreate.value; });
    buttonDisconnect.addEventListener("click", function() { window.location.href = "scripts/disconnect.php"; });
    buttonPassword.addEventListener("click", function() { window.location.href = "scripts/password_changer.php"; });
    buttonHome.addEventListener("click", function() { window.location.href = "index.php"; });

    for(var i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener("click", function() { window.location.href = "index.php?area=" + this.textContent + "&role=admin"; });
    }

    if(buttonDelete != null)
    {
        buttonDelete.addEventListener("click", function() { window.location.href = "scripts/delete_page.php?url=" + url; });
    }
});