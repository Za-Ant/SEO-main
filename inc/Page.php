<?php
class Page{
    public $url;

    function get_url(){
        $this->url = $_SERVER['SCRIPT_NAME'];
        return $this->url;
    }
    function get_file_name(){
        return basename($_SERVER['SCRIPT_NAME'],".php");
    }
}
$Page = new Page();

?>