window.addEventListener("load", function()
{
    deleteElementEvent();
    deleteSubElementEvent();
    createElementEvent();
    swapElementEvent();
});

function deleteElementEvent()
{
    var buttons = document.getElementsByClassName("element-delete-button");
    var url = document.getElementById("json").attributes["url"].value;
    for(var i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener("click", function()
        {
            var id = this.attributes["id"].value;
            window.location.href = "scripts/delete_element.php?url=" + url + "&id=" + id;
        });
    }
}

function deleteSubElementEvent()
{
    var buttons = document.getElementsByClassName("subelement-delete-button");
    var url = document.getElementById("json").attributes["url"].value;
    for(var i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener("click", function()
        {
            var id = this.attributes["id"].value;
            var containerid = this.attributes["container-id"].value;
            window.location.href = "scripts/delete_subelement.php?url=" + url + "&id=" + id + "&container-id=" + containerid;
        });
    }
}

function createElementEvent()
{
    var buttons = document.getElementsByClassName("subelement-create-button");
    var url = document.getElementById("json").attributes["url"].value;
    for(var i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener("click", function()
        {
            var target = this.attributes["target"].value;
            var containerid = this.attributes["container-id"].value;
            switch (target) {
                case "navbar-button":
                    window.location.href = "scripts/create_navbar_button.php?url=" + url + "&container-id=" + containerid;
                    break;
                case "navbar-item":
                    window.location.href = "scripts/create_navbar_item.php?url=" + url + "&container-id=" + containerid;
                    break;
                case "headband":
                    window.location.href = "scripts/create_headband.php?url=" + url + "&container-id=" + containerid;
                    break;
                case "footer":
                    window.location.href = "scripts/create_image_footer.php?url=" + url + "&container-id=" + containerid;
                    break;
                case "gallery":
                    window.location.href = "scripts/create_gallery_image.php?url=" + url + "&container-id=" + containerid;
                    break;
                case "googlemap":
                    window.location.href = "scripts/create_map_marker.php?url=" + url + "&container-id=" + containerid;
                    break;
                case "openstreetmap":
                    window.location.href = "scripts/create_map_marker.php?url=" + url + "&container-id=" + containerid;
                    break;
                case "mailsender":
                    window.location.href = "scripts/create_mailsender_contact.php?url=" + url + "&container-id=" + containerid;
                    break;
            }
        });
    }
}

function swapElementEvent()
{
    var buttons = document.getElementsByClassName("element-swap-button");
    var url = document.getElementById("json").attributes["url"].value;
    for(var i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener("click", function()
        {
            var id = this.attributes["id"].value;
            var action = this.attributes["action"].value;
            window.location.href = "scripts/swap_element.php?url=" + url + "&id=" + id + "&action=" + action;
        });
    }
}
