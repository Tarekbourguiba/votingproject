<?php
require_once BASE_DIR.'/models/utilisateurModel.php';
dispatch_get('/','connextionutilisateur');

dispatch_post('/utilisateur/register', 'registerutilisateur');
dispatch_post('/utilisateur/seconnecter', 'connextionutilisateur');