<?php
 function listquestion()
    {  
        global $config;
       
            $model = new questionModel($config);
        
            $rows = $model->getlist();
           
        	return render("question/default.php",'layout.html.php',array('rows'=>$rows));

    }

    function addquestion()
    {   
    	global $config;
		$cid=0;
        $model = new questionModel($config);
	     $row = $model->getquestionbyid($cid);
        return render("question/form.php",'layout.html.php',array('row'=>$row));
	}


    function editquestion()
    { 
    global $config;  
    $cid=array();
    if(isset($_POST['cid'])) {
    	$cid=$_POST['cid'];
    }else{
    redirect_to('/question');
    }
	$model = new questionModel($config);
	$row = $model->getquestionbyid($cid[0]);
        return render("question/form.php",'layout.html.php',array('row'=>$row));
    }

    function savequestion(){
    global $config,$id;
	$model = new questionModel($config);
	 if(isset($_POST['idquestion'])) {
    	$id=intval($_POST['idquestion']);
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
	redirect_to('/question');
   }


   function deletequestion(){
   	global $config;

   	if(isset($_POST['cid'])) {
    	$tabcid=$_POST['cid'];
    }
	$model = new questionModel($config);
        if(count($tabcid) > 0){
            foreach($tabcid as $cid){
                $result = $model->delete($cid);
            }
	    }
        $msg='<div class="alert alert-info">
        <strong>Info!</strong> La suppression des questions ce fait avec success.
        </div>';
        flash('msg',$msg);
        redirect_to('/question');
   }