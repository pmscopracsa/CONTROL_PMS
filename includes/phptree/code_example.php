<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ApPHP TreeMenu</title>
</head>

<body>
<?php
    ## +---------------------------------------------------------------------------+
    ## | 1. Creating & Calling:                                                    |
    ## +---------------------------------------------------------------------------+
    // include TreeMenu class
    require_once("treemenu.class.php");

    // create TreeMenu object
    $treeMenu = new TreeMenu();

    ## *** add nodes
    /// parameters:
    /// param #1 - text on the node
    /// param #2 - file associated with this node
    ///            "" is default value (i.e. no file)

    $squares = $treeMenu->AddNode("Squares","content/square.jpg");
    $squares->AddNode("red","content/redsquare.jpg");
    $squares->AddNode("green","content/greensquare.jpg");
    $squares->AddNode("blue","content/bluesquare.jpg");
    $circles = $treeMenu->AddNode("circles","content/circle.jpg");
    $circles->AddNode("red","content/redcircle.jpg");
    $circles->AddNode("green","content/greencircle.jpg");
    $circles->AddNode("blue","content/bluecircle.jpg");
    $treeMenu->AddNode("star","content/star.jpg");
    $nuevo = $treeMenu->AddNode("Nuevo");

    ## +---------------------------------------------------------------------------+
    ## | 2. General Settings:                                                      |
    ## +---------------------------------------------------------------------------+

    ## *** set TreeMenu caption
    $treeMenu->SetCaption("ApPHP TreeMenu v".$treeMenu->Version());
    ## *** show debug info - false|true
    $treeMenu->Debug(false);
    ## *** set form submission type: "get" or "post"
    $treeMenu->SetSubmissionType("post");

    ## +---------------------------------------------------------------------------+
    ## | 3. Display TreeMenu:                                                         |
    ## +---------------------------------------------------------------------------+

    $treeMenu->Display();

?>
</body>
</html>