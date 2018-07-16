<?php

function get_video_youtube($link)
{
	$ytarray=explode("/", $link);
	$ytendstring=end($ytarray);
	$ytendarray=explode("?v=", $ytendstring);
	$ytendstring=end($ytendarray);
	$ytendarray=explode("&", $ytendstring);
	$ytcode=$ytendarray[0];
	$video_em = 'http://www.youtube.com/embed/'.$ytcode;
	return $video_em;
}