<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  ApPHP TreeMenu version 1.0.1 (13.03.2010)                                  #
##  Developed by:  ApPHP <info@apphp.com>                                      #
##  License:       GNU GPL v.2                                                 #
##  Site:          http://www.apphp.com/php-treemenu/                          #
##  Copyright:     ApPHP TreeMenu (c) 2010. All rights reserved.               #
##                                                                             #
################################################################################
/**
 *	class TreeMenu
    represents a tree menu
    last date modified: 13.03.2010
 *
 */
 class TreeMenu
 {
        // PUBLIC
        // -------
        // constructor
        // AddNode
        // AddNodeAction
        // Display
        // DisplayNode
        // GetNumChildren
        // GetId
        // GetCaption
        // SetCaption
        // SetStyle
        // SetPath
        // SetSubmissionType
        // Debug
        // GetDebug

        // PRIVATE
        // --------
        // LoadFiles
        // GetFormattedMicrotime
        // ShowDebugInformation

    //--- PRIVATE DATA MEMBERS --------------------------------------------------
    private $nodes;
    private $numChildren=0;
    private $caption;
    private $id;
    private $isDebug=false;
    private $submissionType="post";
    private $style;
    private $path="../../includes/phptree/";

    //--- CONSTANTS --------------------------------------------------
    const version="1.0.1";


    /**
	 *	Creates a tree menu
            @param $id - menu's id
            @param $style - style's name (corresponds to subfolder of the same name within 'styles' folder)
	*
	*/
    public function __construct($id=1,$style="default")
    {
       if(!is_numeric($id)||!is_integer($id))
          $id=1;
       $this->style=$style;
       $this->nodes=array();
       $this->id=$id;
    }

    /**
	*	Adds a new child node to this menu (calculates new node's id and calls private function AddNodeAction)
	      @param $caption - text on the node
	      @param $file - file associated with this node
	*
	*/
    public function AddNode($caption,$file="")
    {
         $id=$this->GetId()."_".++$this->numChildren;
         return $this->AddNodeAction($caption,$file,$id);
    }

    /**
	*	Adds a new child node to this menu
	      @param $caption - text on the node
	      @param $file - file associated with this node
	      @param $id - node's id
	*
	*/
    public function AddNodeAction($caption,$file="",$id)
    {
       if(preg_match("/^[0-9|_]+$/",$id)==0)
          return;

       $this->nodes[$id]=new Node($caption,$id,$file,$this);
       return $this->nodes[$id];
    }

    /**
	*	Loads CSS and JS files
	*
	*/
	private function LoadFiles()
	{
	   if(!file_exists($this->path."styles/".$this->style."/style.css"))
          $this->style="default";
       echo  "<link href='".$this->path."styles/".$this->style."/style.css' rel='stylesheet' type='text/css' />\n";
       if(file_exists($this->path."styles/common.css"))
          echo  "<link href='".$this->path."styles/common.css' rel='stylesheet' type='text/css' />\n";
       if(file_exists($this->path."js/script.js"))
          echo  "<script type='text/javascript' src='".$this->path."js/script.js'></script>";
    }

    /**
	*	Displays this menu
	*
	*/
    public function Display()
    {
       if($this->isDebug)
          $startTime = $this->GetFormattedMicrotime();
       // displaying menu's caption
       if($this->caption!="")
          echo "<span id='caption'>".$this->caption."</span><br /><br />";
       // loading JS and CSS files
       $this->LoadFiles();

       // displaying a table with one row and two columns
       echo "<table class='maintable'>";

       // TreeMenu is placed into the left column
       echo "<tr><td class='treecolumn'>";
       echo "<div id='nodes'>";
       echo "\n<form name='frmnodes' id='frmnodes' action='".$_SERVER["SCRIPT_NAME"]."' method='".$this->submissionType."'>\n";
       echo "<input type='hidden' id='nodeid' name='nodeid'/>\n";
       echo "\n<ul class='tree'>\n";
       for($i=1;$i<=$this->numChildren;$i++)
       {
          $this->DisplayNode($this->id."_".$i,$i==$this->numChildren);
       }
       echo "\n</ul>\n</form></div>\n</td>";

       // content is diplayed inside the second column
       echo "<td class='contentscolumn'>";
       echo "<div id='container'>\n</div>";
       if(isset($_REQUEST["nodeid"]) && isset($this->nodes[$_REQUEST["nodeid"]]))
           $this->nodes[$_REQUEST["nodeid"]]->ShowContent();;
       echo "</td></tr></table></div>";

       if($this->isDebug)
          $this->ShowDebugInformation($startTime);

       echo "\n<!-- END This script was generated by treemenu.class.php v.".TreeMenu::version."(http://www.apphp.com/php-treemenu/index.php) END -->\n";
    }

    /**
	*	Displays a node
	      @param $id - node's id
	      @param $last - whether the node is the last one on this level
	*
	*/
    public function DisplayNode($id,$last)
    {
        $node=$this->nodes[$id];

        // defining if this node is selected
        if(isset($_REQUEST["nodeid"]) && $_REQUEST["nodeid"]==$node->GetId())
           $class="selected";
        else $class="regular";

        // if this node has subnodes
        if($node->getNumChildren()>0)
        {
        	// if this node is expanded
        	if((isset($_REQUEST["node".$node->GetId()])
        	   && $_REQUEST["node".$node->GetId()]=='e')
        	   || $class=="selected")
        	{
                $liclass="expanded";
                $symbol="minus";
                $value="e";
            }
            // if this node is collapsed
            else
            {
                $liclass="collapsed";
                $symbol="plus";
                $value="c";
            }
        	echo "\n<li class='".$liclass."' id='".$node->GetId()."'>";
        	// displaying plus or minus sign to the left of the text
        	if($last)
        	   echo "<img src='styles/".$this->style."/images/".$symbol."-last.jpg' class='image-last' onclick='Switch(this,\"".$this->style."\")'></img>";
        	else
        	   echo "<img src='styles/".$this->style."/images/".$symbol.".jpg' class='image' onclick='Switch(this,\"".$this->style."\")'></img>";
        	// hidden field which stores this node's state ('c' for collapsed and 'e' for expanded)
        	echo "\n<input type='hidden' id='node".$node->GetId()."' name='node".$node->GetId()."' value='".$value."' />";
        }
        // if node has no subnodes
        else
        {
        	if($last)
        	   echo "\n<li class='last' id='".$node->GetId()."'>";
            else echo "\n<li class='single' id='".$node->GetId()."'>";
        }

        // displaying this node's text
        echo "\n<span onmouseover='Highlight(this)' onmouseout='Lowlight(this)' class='".$class."' ";
        echo "onclick='__TreeMenuPostBack(this)'>";
        echo $node->GetCaption()."</span>";

        //displaying this node's subnodes if there are any
        if($node->getNumChildren()>0)
        {
        	if($last)
        	   echo "\n<ul class='tree-last'>";
         	else echo "\n<ul class='tree'>";
        	for($i=1;$i<=$node->getNumChildren();$i++)
               $this->DisplayNode($node->GetId()."_".$i,$i==$node->getNumChildren());
            echo "\n</ul>";
        }
        echo "</li>";
    }

    /**
	*	Returns number of nodes on the first level
	*
	*/
	public function GetNumChildren()
    {
       return $this->numChildren;
    }

    /**
	*	Returns menu's id
	*
	*/
    public function GetId()
    {
       return $this->id;
    }

    /**
	*	Returns TreeMenu's version
	*
	*/
    public function Version()
    {
       return TreeMenu::version;
    }

    /**
	*	Returns menu's caption
	*
	*/
    public function GetCaption()
    {
    	return $this->caption;
    }

    /**
	*	Sets menu's caption
	     @param $caption - new caption
	*
	*/
    public function SetCaption($caption)
    {
    	$this->caption=$caption;
    }

    /**
	*	Sets style
	     @param $style - new style
	*
	*/
    public function SetStyle($style)
    {
    	if(file_exists($this->path."styles/".$style."/style.css"))
    	   $this->style=$style;
    }

    /**
    *   Sets current path
         @param $path - new path
    *
    */
    public function SetPath($path)
    {
    	$this->path=$path;
    }

    /**
	 *	Gets formatted microtime
	 */
     private function GetFormattedMicrotime(){
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }

    /**
	 *	Sets form submission type
	 *		@param $submission_type
	*/
	public function SetSubmissionType($submission_type = "post")
	{
		if(strtolower($submission_type) == "get") $this->submissionType = "get";
		else $this->submissionType = "post";
	}

    /**
	 *	Sets debug mode
	 *		@param $mode
	*/
	public function Debug($mode = false)
	{
		if($mode === true || strtolower($mode) == "true") $this->isDebug = true;
	}

	/**
	 *	Returns debug mode
	 *
	*/
	public function GetDebug()
	{
		return $this->isDebug;
	}

    /**
	 *	Shows debug information
	 *      @param $startTime - time when the script started
	*/
    private function ShowDebugInformation($startTime)
    {
       $endTime = $this->GetFormattedMicrotime();
	   echo "<div style='margin: 10px auto; text-align:left; color:#000096;'>";

	   echo "Debug Info: (Total running time: ".round((float)$endTime - (float)$startTime, 6)." sec.) <br />========<br />";
	   echo "NODES: <br />--------<br />";
	   echo "<pre>";
	   echo "<table style='color:#000096;'>";
       foreach($this->nodes as $node)
       {
          echo "<tr>";
          echo "<td>".$node->GetId()."</td>";
          echo "<td>".$node->GetCaption()."</td>";
          echo "</tr>";
       }
       echo "</table>";
       echo "</pre>";
	   echo "<br />GET: <br />--------<br />";
	   echo "<pre>";
	   print_r($_GET);
	   echo "</pre><br />";
	   echo "POST: <br />--------<br />";
	   echo "<pre>";
	   print_r($_POST);
	   echo "</pre><br />";
	   echo "</div>";
    }
 }
 /**
 *	class Node
      represents a separate node
      last date modified: 13.03.2010
 *
 */
class Node
{
        // PUBLIC
        // -------
        // constructor
        // AddNode
        // ShowContent
        // GetCaption
        // GetId
        // GetNumChildren
        // GetFile

        // PRIVATE
        // --------
        // IsPicture

    //--- PRIVATE DATA MEMBERS --------------------------------------------------
    private $caption;
    private $selected=false;
    private $id;
    private $parent;
    private $numChildren=0;
    private $file;


    /**
	 *	Creates a new node
	        @param $caption - node's caption
            @param $id - node's id
            @param $file - name of the file associated with this node
            @param $parent - menu which contains this node
	*
	*/
    function __construct($caption,$id,$file="",$parent)
	{
           if(preg_match("/^[0-9|_]/",$id)==0)
              $id=0;
           $this->file=$file;
           $this->id=$id;
           $this->caption=$caption;
           $this->parent=$parent;
	}

   /**
	*	Adds a new child node to this node
	      @param $caption - text on the node
	      @param $file - file associated with this node
	*
	*/
    public function AddNode($caption,$file="")
    {
        if(!is_a($this->parent,"TreeMenu"))
        {
           echo "<font color='#FF0000'>Error: node ".$this->caption." has no valid parent object</font>";
           return;
        }
        $id=$this->GetId()."_".++$this->numChildren;
        return $this->parent->AddNodeAction($caption,$file,$id);
    }

    /**
	*	Shows contents of the file which is associated with this node
	*
	*/
    public function ShowContent()
    {
         echo"<br />\n\n";
         if(!$this->IsPicture()||!file_exists($this->file))
         {
           echo "No graphic content associated with this node";
           return;
         }
    	 echo "<img src='",$this->file,"'>";
    }

     /**
	 *	Returns the node's caption
	 *
	 */
     public function GetCaption()
     {
        return $this->caption;
     }

     /**
	 *	Returns the node's file
	 *
	 */
     public function GetFile()
     {
        return $this->file;
     }

     /**
	 *	Returns the node's id
	 *
	 */
     public function GetId()
     {
        return $this->id;
     }

     /**
	 *	Returns amount of subnodes associated with this node
	 *
	 */
     public function GetNumChildren()
     {
        return $this->numChildren;
     }

     /**
	 *	Checks if file associated with this node is a graphic file
	 *
	 */
     private function IsPicture()
     {
        $extension=strtolower(substr(strrchr($this->file,"."),1));
        if($extension=="jpg"||$extension=="gif"||$extension=="bmp"||$extension=="tif"||$extension=="png"||$extension=="jpeg")
           return true;
        else return false;
     }

}
 ?>