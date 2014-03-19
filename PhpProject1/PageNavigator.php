<?php
class PageNavigator {
    private $pagename;
    private $totalpage;
    private $recordsperpage;
    private $maxpagesshown;
    private $currentstartpage;
    private $currentendpage;
    private $currentpage;
    private $spannextinactive;
    private $spanpreviousinactive;
    private $firstinactivespan;
    private $lastinactivespan;
    private $firstparamname = "offset";
    private $params;
    private $inactivespanname = "inactive";
    private $pagedisplaydivname = "totalpagesdisplay";
    private $divwrappername = "navigator";
    private $strfirst = "|&lt;";
    private $strnext = "Next";
    private $strprevious = "Prev";
    private $strlast = "&gt;|";
    private $errorstring;
    public function __constructor(){
        
    }
}
?>
