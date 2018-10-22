<?php
use vendors\core\Model;

class utilisateurModel extends Model
{
   	
   	public function getstatusutilisateur($request){
   		$sql = "SELECT count(u.idutilisateur) as total FROM utilisateur as u WHERE u.email=:email AND u.pwd=:pwd";

   		$pwdencode=md5($request['pwd']);

	try {
		$db = $this->getReadConnection();
		$rsql = $db->prepare($sql);
		$rsql->bindValue(":email", $request['email']);
		$rsql->bindValue(":pwd", $pwdencode);
		$rsql->execute();

		$result = $rsql->fetchObject();

		$db = null;


		if($result->total > 0){
            $_SESSION["email"]=$request['email'];
            $_SESSION["sessionid"]=session_id();
			$result=true;
		}else{
			$result=false;
		}
		return $result;
   	}catch(PDOException $e) {
        	echo '<div class="alert alert-danger"><strong>Erreur!</strong>'.$e->getMessage().'</div>';
    	}    
   	}

   
}