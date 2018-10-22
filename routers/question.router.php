<?php
require_once BASE_DIR.'/models/questionModel.php';

dispatch_get('/questions','listquestion');

dispatch_get('/question/add', 'addquestion');
dispatch_post('/question/edit', 'editquestion');
dispatch_post('/question/save', 'savequestion');
dispatch_post('/question/delete', 'deletequestion');