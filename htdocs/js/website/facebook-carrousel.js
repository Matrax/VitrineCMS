window.addEventListener("load", function()
{
    var carrousel = document.getElementsByClassName("facebook-carrousel")[0];
    var pagination = carrousel.getElementsByClassName("facebook-carrousel-pagination")[0];
    var contents = carrousel.getElementsByClassName("facebook-carrousel-content");
    var pages = pagination.getElementsByClassName("facebook-carrousel-page");

    if(contents[0] != null) contents[0].style.display = "flex";

    for(var i = 0; i < pages.length; i++)
    {
        pages[i].addEventListener("click", function()
        {
            var page = parseInt(this.attributes["page"].value);
            for(var j = 0; j < contents.length; j++)
            {
                var contentPage = parseInt(contents[j].attributes["page"].value);
                if(contentPage == page)
                {
                    contents[j].style.display = "flex";
                } else {
                    contents[j].style.display = "none";
                }
            }
        });
    }
});