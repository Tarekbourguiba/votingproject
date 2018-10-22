<?php
require_once BASE_DIR.'/models/utilisateurModel.php';

dispatch_get('/questions','listquestion');

dispatch_post('/utilisateur/add', 'addutilisateur');
dispatch_post('/utilisateur/edit', 'editutilisateur');
dispatch_post('/utilisateur/save', 'saveutilisateur');
dispatch_post('/utilisateur/delete', 'deleteutilisateur');