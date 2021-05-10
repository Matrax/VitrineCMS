function saveInputs(json, elements)
{
    for(var i = 0; i < elements.length; i++)
    {
        if(isAdmin(elements[i].attributes))
        {
            var id = elements[i].attributes["id"].value;
            var target = elements[i].attributes["target"].value;
            var containerID = elements[i].attributes["container-id"];
            if(containerID == null)
            {
                json[id][target] = elements[i].value;
            } else {
                json[containerID.value]["elements"][id][target] = elements[i].value;
            }
        }
    }
}

function isAdmin(attributes)
{
    return attributes["role"] != null && attributes["role"].value == "admin";
}

function save()
{
    var json = JSON.parse(document.getElementById("json").innerHTML);
    saveInputs(json, document.getElementsByTagName("input"));
    saveInputs(json, document.getElementsByTagName("textarea"));
    saveInputs(json, document.getElementsByTagName("button"));
    return JSON.stringify(json, null, 5);
}

function send()
{
    var request = new XMLHttpRequest();
    request.open("POST", "scripts/save.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function()
    {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) 
        {
            window.location.reload();
        }
    };
    request.send("json=" + save() + "&url=" + document.getElementById("json").attributes["url"].textContent);
}

window.addEventListener("load", function()
{
    var submit = document.getElementById("button-save");
    submit.addEventListener("click", send);
});