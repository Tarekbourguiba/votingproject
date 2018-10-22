<?php
 function listvote()
    {  
        global $config,$userinfo;
   
            $model = new voteModel($config);
        
            $rows = $model->getlist();
           
        	
            return render("vote/default.php",'layout.html.php',array('rows'=>$rows));
    }

    function addvote()
    {   
    	global $config;
		$cid=0;
        $model = new voteModel($config);
	     $row = $model->getvotebyid($cid);
        return render("vote/form.php",'layout.html.php',array('row'=>$row));
	}


    function editvote()
    { 
    global $config;  
    $cid=array();
    if(isset($_POST['cid'])) {
    	$cid=$_POST['cid'];
    }else{
    redirect_to('/vote');
    }
	$model = new voteModel($config);
	$row = $model->getvotebyid($cid[0]);
        return render("vote/form.php",'layout.html.php',array('row'=>$row));
    }

    function savevote(){
    global $config,$id;
	$model = new voteModel($config);
	 if(isset($_POST['idvote'])) {
    	$id=intval($_POST['idvote']);
    }
    $request=$_POST;
	if($id !=0){
                    $result = $model->update($request);
                    $msg='<div class="alert alert-success">
                    <strong>Success!</strong> Votre modification enregisté avec success.
                    </div>';
	}else{
                    $result = $model->store($request);
                    $msg='<div class="alert alert-success">
                    <strong>Success!</strong> Une nouvelle enregistrement.
                    </div>';
	}
        flash('msg',$msg);
	redirect_to('/vote');
   }


   function deletevote(){
   	global $config;

   	if(isset($_POST['cid'])) {
    	$tabcid=$_POST['cid'];
    }
	$model = new voteModel($config);
        if(count($tabcid) > 0){
            foreach($tabcid as $cid){
                $result = $model->delete($cid);
            }
	    }
        $msg='<div class="alert alert-info">
        <strong>Info!</strong> La suppression des votes ce fait avec success.
        </div>';
        flash('msg',$msg);
        redirect_to('/vote');
   }