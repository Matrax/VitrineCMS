var selectedButton = null; //Le bouton sélectionné

function openModal(modal, button)
{
    modal.style.display = "block";
    selectedButton = button;
}

function urlModalEvent()
{
    var url = document.getElementById("json").attributes["url"].value;
    var urlModal = document.getElementById("modal-url-admin");
    var urls = urlModal.getElementsByClassName("modal-url-content")[0].getElementsByClassName("modal-url");
    for(var i = 0; i < urls.length; i++)
    {
        urls[i].addEventListener("click", function()
        {
            selectedButton.value = this.getAttribute("value");
            selectedButton.innerHTML = this.getAttribute("value");
            urlModal.style.display = "none";
        });
    }
}

function imageModalEvent()
{
    var url = document.getElementById("json").attributes["url"].value;
    var imageModal = document.getElementById("modal-image-admin");
    var images = imageModal.getElementsByClassName("modal-image-content")[0].getElementsByClassName("modal-image");

    for(var i = 0; i < images.length; i++)
    {
        images[i].addEventListener("click", function()
        {
            selectedButton.value = this.getAttribute("src");
            selectedButton.innerHTML = this.getAttribute("src");
            imageModal.style.display = "none";
        });
    }
}

function containerModalEvent()
{
    var url = document.getElementById("json").attributes["url"].value;
    var containerModal = document.getElementById("modal-container-admin");
    var containers = containerModal.getElementsByClassName("modal-container-content")[0].getElementsByClassName("modal-container");
    for(var i = 0; i < containers.length; i++)
    {
        containers[i].addEventListener("click", function()
        {
            var id = selectedButton.attributes["target-id"].value;
            var type = this.attributes["value"].value;
            window.location.href = "scripts/create_element.php?url=" + url + "&type=" + type + "&id=" + id;
            containerModal.style.display = "none";
        });
    }
}

function addImageEvent()
{
    var button = document.getElementsByClassName("modal-add-button")[0];
    button.addEventListener("change", function()
    {
        var image = button.files[0];
        var request  = new XMLHttpRequest();
        var data = new FormData();
        data.append("image", image);
        request.addEventListener('load', function()
        {
            window.location.reload();
        });
        request.open("POST", "scripts/add_image.php", true);
        request.send(data);
    });
}

function openModalEvent()
{
    var buttons = document.getElementsByTagName("button");
    var urlModal = document.getElementById("modal-url-admin");
    var imageModal = document.getElementById("modal-image-admin");
    var containerModal = document.getElementById("modal-container-admin");
    for(var i = 0; i < buttons.length; i++)
    {
        var attributes = buttons[i].attributes;
        switch(attributes["target"].value)
        {
            case "image":
                buttons[i].addEventListener("click", function() { openModal(imageModal, this); });
                break;
            case "url":
                buttons[i].addEventListener("click", function() { openModal(urlModal, this); });
                break;
            case "container":
                buttons[i].addEventListener("click", function() { openModal(containerModal, this); });
                break;
        }
    }
}

function exitModalEvent()
{
    var buttons = document.getElementsByClassName("modal-close-button");
    var urlModal = document.getElementById("modal-url-admin");
    var imageModal = document.getElementById("modal-image-admin");
    var containerModal = document.getElementById("modal-container-admin");
    for(var i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener("click", function()
        {
            urlModal.style.display = "none";
            imageModal.style.display = "none";
            containerModal.style.display = "none";
        });
    }
    window.addEventListener("click", function(event)
    {
        switch(event.target)
        {
            case imageModal:
                imageModal.style.display = "none";
                selectedButton = null;
                break;
            case urlModal:
                urlModal.style.display = "none";
                selectedButton = null;
                break;
            case containerModal:
                containerModal.style.display = "none";
                selectedButton = null;
                break;
        }
    });
}

window.addEventListener("load", function()
{
    openModalEvent();
    exitModalEvent();
    addImageEvent();
    containerModalEvent();
    imageModalEvent();
    urlModalEvent();
});