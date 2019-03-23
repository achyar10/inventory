<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Pagionation
| -------------------------------------------------------------------------
|
*/

$config['full_tag_open'] = "<ul class='pagination'>";
$config['full_tag_close'] ="</ul>";

$config['num_tag_open'] = "<li class='page-item'>";
$config['num_tag_close'] = "</li>";

$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";

$config['next_tag_open'] = "<li class='page-item'>";
$config['next_tag_close'] = "</li>";
$config['next_link'] = "Next &rarr;";

$config['prev_tag_open'] = "<li class='page-item'>";
$config['prev_tag_close'] = "</li>";
$config['prev_link'] = "&larr; Previous";

$config['first_tag_open'] = "<li class='page-item'>";
$config['first_tag_close'] = "</li>";

$config['last_tag_open'] = "<li class='page-item'>";
$config['last_tag_close'] = "</li>";
$config['first_link'] = "First";
$config['last_link'] = "Last";


/* End of file pagination.php */
/* Location: ./application/config/pagination.php */
