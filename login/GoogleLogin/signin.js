
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        obj = {"firstname":profile.getGivenName(),"lastname":profile.getFamilyName(),"email":profile.getEmail()};
        dbParam = JSON.stringify(obj);

        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
            window.location='dashboard/home.php';
          }
        };
        xhttp.open("GET", "GoogleLogin/google_auth.php?info="+dbParam, true);
        xhttp.send();

      };
