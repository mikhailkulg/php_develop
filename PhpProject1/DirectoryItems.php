<?php
class DirectoryItems {
    //var $filearray = array();
    private $filearray = array();
    private $directory;
    private $replacechar;
    //function DirectoryItems ($directory){
    function __construct ($directory, $replacechar = "_"){
        $this->directory = $directory;
        $this->replacechar = $replacechar;
        $d = "";
        if(is_dir($directory)){
            $d = opendir($directory) or die("text1");
            while (false != ($f = readdir($d))){
                if(is_file("$directory/$f")){
                    $title = $this->createTitle($f);
                    $this->filearray[$f] = $title;
                }
            }
            closedir($d);
        } else {
            die("text2");
        }
    }
    function indexOrder(){
        sort($this->filearray);
    }
    function getCount(){
        return count($this->filearray);
    }
    function checkAllImage(){
        $bln = true;
        $extension = "";
        $types = array("jpg", "jpeg", "gif", "png");
        foreach ($this->filearray as $key => $value){
            $extension = substr($key, (strpos($key,".")) + 1);
            $extension = strtolower($extension);
            if(!in_array($extension, $types)){
                $bln = false;
                break;
            }
        }
        return $bln;
    }
    function getFileArray(){
        return $this->filearray;
    }
    private function createTitle($title){
        $title = substr($title, 0, strrpos($title, "."));
        $title = str_replace($this->replacechar, " ", $title);
        return $title;
    }
    function checkAllSpecificType($extension) {
        $extension = strtolower($extension);
        $bln = true;
        $ext = "";
        foreach ($this->filearray as $key => $value){
            $ext = substr($key, (strpos($key, ".") + 1));
            $ext = strtolower($ext);
            if ($extension != $ext){
                $bln = false;
                break;
            }
        }
        return $bln;
    }
    function filter($extension){
        $extension = strtolower($extension);
        foreach ($this->filearray as $key => $value){
            $ext = substr($key, (strpos($key, ".") + 1));
            $ext = strtolower($ext);
            if($ext != $extension){
                unset($this->filearray[$key]);
            }
        }
    }
    function removeFilter(){
        unset($this->filearray);
        $d = "";
        $d = opendir($this->directory) or die("text5");
        while (false != ($f = readdir($d))){
            if(is_file("$this->directory/$f")){
                 $title = $this->createTitle($f);
                 $this->filearray[$f] = $title;
            }
        }
        closedir($d);
    }
    function imageOnly(){
        $extension = "";
        $types = array("jpg", "jpeg", "gif", "png");
        foreach ($this->filearray as $key => $value){
            $extension = substr($key, (strpos($key, ".") + 1));
            $extension = strtolower($extension);
            if(!in_array($extension, $types)){
                unset($this->filearray[$key]);
            }
        }
    }
}
?>
