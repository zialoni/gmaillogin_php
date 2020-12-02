<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta name="google-signin-client_id" content="CLIENT_ID">
     <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
</head>
<body>
    <?php
          if(isset($_SESSION['USER_ID'])){
            ?>
              <a href="javascript:void(0)" onClick="logout()">Logout</a>
            <?php
          }else {
            ?>
            <div class="g-signin2" data-onsuccess="gmailLogIn">Login with Google</div>
            <?php
          }

    ?>
  
  
    <script>
       
        function logout() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut();

            jQuery.ajax({
                  url:'logout.php',
                  success:function(result){
                      window.location.href="index.php";
                  }           
            });
        }
        function onLoad(){
            gapi.load('auth2',function(){
                gapi.auth2.init();
            });
        }
        function gmailLogIn(userInfo){
            var userProfile=userInfo.getBasicProfile();
           

            jQuery.ajax({
                  url:'login_check.php',
                  type:'post',
                  data:'user_id='+userProfile.getId()+'&name='+userProfile.getName()+'&image='+userProfile.getImageUrl()+'&email='+userProfile.getEmail(),
                  success:function(result){
                      window.location.href="index.php";
                  }           
            });
        }
    </script>
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
</body>
</html>