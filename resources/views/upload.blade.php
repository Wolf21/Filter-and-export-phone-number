<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Filter Phone</title>
</head>
<body>
<h2>Anh Cường đẹp trai ơiiiiiiiiii</h2>
{{ Form::open(['url' => route('upload'), 'method' => 'post', 'name'=>'upload', 'files' => true]) }}
    <input type="file" name="file" id="file">
<button type="submit" name="submit">Convert</button>
{{ Form::close() }}

</body>
</html>


<script>
    // initialize Account Kit with CSRF protection
    AccountKit_OnInteractive = function(){
        AccountKit.init(
            {
                appId:"{{FACEBOOK_APP_ID}}",
                state:"{{csrf}}",
                version:"{{ACCOUNT_KIT_API_VERSION}}",
                fbAppEventsEnabled:true,
                redirect:"{{REDIRECT_URL}}"
            }
        );
    };

    // login callback
    function loginCallback(response) {
        if (response.status === "PARTIALLY_AUTHENTICATED") {
            var code = response.code;
            var csrf = response.state;
            // Send code to server to exchange for access token
        }
        else if (response.status === "NOT_AUTHENTICATED") {
            // handle authentication failure
        }
        else if (response.status === "BAD_PARAMS") {
            // handle bad parameters
        }
    }

    // phone form submission handler
    function smsLogin() {
        var countryCode = document.getElementById("country_code").value;
        var phoneNumber = document.getElementById("phone_number").value;
        AccountKit.login(
            'PHONE',
            {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
            loginCallback
        );
    }


    // email form submission handler
    function emailLogin() {
        var emailAddress = document.getElementById("email").value;
        AccountKit.login(
            'EMAIL',
            {emailAddress: emailAddress},
            loginCallback
        );
    }
</script>


