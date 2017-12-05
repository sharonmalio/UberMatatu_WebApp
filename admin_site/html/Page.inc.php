<?php


class Page{

    private $content_file;

    function __construct($content_include_file_name){

        $this->content_file=$content_include_file_name;

    }

    public function show($compact_variables=[]){
        $content = getcwd().'\html\content\\'.$this->content_file;
        extract($compact_variables);
        require('layout/master.php');
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->content_file = null;
    }

}

?>