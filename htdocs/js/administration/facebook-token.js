function generateTokenButtonEvent()
{
    var tokenButton = document.getElementsByClassName("element-facebook-token")[0];
    var id = tokenButton.attributes["id"].value;

    tokenButton.addEventListener("click", function()
    {
        FB.login(function(response) 
        {
            if (response.authResponse) 
            {
                console.log("Connection à Facebook OK !");
            } else {
                console.log("Pas de connexion à Facebook !");
            }
        });
    
        FB.getLoginStatus(function(response) 
        {
            if (response.status === 'connected') 
            {
                var accessToken = response.authResponse.accessToken;
                var url = document.getElementById("json").attributes["url"].value;
                window.location.href = "scripts/generate_facebook_token.php?url=" + url + "&id=" + id + "&token=" + accessToken;
            } 
        });
    });
}