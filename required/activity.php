<?php

global $facebook;
echo $facebook->getUser();
$appId=APP_ID;
  echo <<< POST_ACTIVITY
  <div id="fb-root"></div>
  <script type="text/javascript">
window.fbAsyncInit = function() {
      FB.init({
        appId      : {$appId}, // App ID
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
      });
    };
       (function(d){
       var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement('script'); js.id = id; js.async = true;
       js.src = "//connect.facebook.net/en_US/all.js";
       ref.parentNode.insertBefore(js, ref);
       }(document)); 

       function postActivity()
       {

       FB.api(
       '/me/festember:play?access_token={$facebook->getAccessToken()}',
       'post',
       { website: 'http://delta.nitt.edu/festember/games_12/doodle_jump' },
        function(response) {
       if (!response || response.error) {
       alert('Error occured');
       } else {
       alert('Post was successful! Action ID: ' + response.id);
           }
       });
       }
     </script>
        <input type="button" value="Cook" onclick="postActivity()" />

POST_ACTIVITY;
?>  
