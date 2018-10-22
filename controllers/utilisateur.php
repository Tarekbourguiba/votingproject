<?php
function connextionutilisateur()
    {   
        global $config;

        $request=$_POST;


        if(!empty($_POST['email']) && isset($_POST['email']) && isset($_POST['pwd']) && !empty($_POST['pwd'])){



             $model = new utilisateurModel($config);
             $result = $model->getstatusutilisateur($request);

            
             if($result == true && $_SESSION["sessionid"]!=null){
                redirect_to('/dashbord');
             }else{
                redirect_to('/');
             }


        }else{
        return render("utilisateur/seconnecterform.php",'layout.html.php');
        }
    }
    
