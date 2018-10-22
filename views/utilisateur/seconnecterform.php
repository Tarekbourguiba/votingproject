<div class="page-title">
    <h1 class="title">Page de connexion</h1>
</div>
      <div class="content">       
        <form id="form" name="form" method="post" action="<?php echo url_for('utilisateur','seconnecter'); ?>" >
            <div class="form-content">
                <div class="group-content ">
                <label>
                    Email : 
                </label>
                    <input type="email" name="email"  value="">
                
                </div>
                <div class="group-content">
                <label>
                    Mot de passe :
                    <input type="password" name="pwd"  value="">
                </label>
                </div>

                <input type="submit" name="btn-submit" class="btn" value="Se sonnecter">
            </div>
        </form>
    </div>
                                    