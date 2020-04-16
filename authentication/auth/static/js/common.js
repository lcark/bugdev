$(document).ready(function () {
    $('#login').submit(function (e) { 
        e.preventDefault();
        let type = $("#type").val();
        let user = $("#user").val();
        let passwd = $("#passwd").val();
        let data = "";
        switch(type){
            case "xml":
                data = `<?xml version="1.0"?><login><user>${user}</user><passwd>${passwd}</passwd></login>`;
                $.ajax({
                    type: "POST",
                    url: "/login.php",
                    data: data,
                    dataType: "json",
                    contentType: "application/xml; charset=utf-8",
                    success: function (data) {
                        if(data.message == 'ok'){
                            document.location = "/profile";
                        }else{
                            alert('账号或密码错误');
                        }
                    }
                });
                break;
            case "json":
                data = {'user': user, 'passwd': passwd};
                $.ajax({
                    type: "POST",
                    url: "/login.php",
                    data: JSON.stringify(data),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function (data) {
                        if(data.message == 'ok'){
                            document.location = "/profile";
                        }else{
                            alert('账号或密码错误');
                        }
                    }
                });
                break;
            default:
                $.ajax({
                    type: "POST",
                    url: "/login.php",
                    data: $( "#login" ).serialize(),
                    dataType: "json",
                    success: function (data) {
                        if(data.message == 'ok'){
                            document.location = "/profile";
                        }else{
                            alert('账号或密码错误');
                        }
                    }
                });
                break;
        }
    }
)
});
    