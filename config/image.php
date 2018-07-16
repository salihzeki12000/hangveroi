<?php
return array(
    'library' => 'gd',
    'upload_path' => public_path() . '/assets/uploads/',
    'quality' => 80,
    'rules' => array(
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp|max:10240', //~6MB
    ),
 
    'dimensions' => array(
        'thumb' => array(250, 250, true, 80),
        'medium' => array(700, 525, false, 80),
        'large' => array(910, 600, false, 80),
    ),
);