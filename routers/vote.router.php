<?php
require_once BASE_DIR.'/models/voteModel.php';

dispatch_get('/votes','listvote');

dispatch_post('/vote/add', 'addvote');
dispatch_post('/vote/edit', 'editvote');
dispatch_post('/vote/save', 'savevote');
dispatch_post('/vote/delete', 'deletevote');