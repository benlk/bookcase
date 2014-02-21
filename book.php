<?php

if(!isset($_REQUEST) || $_REQUEST['b']=='') { 
   $request_b=''; 
} else { 
  $request_b = $_REQUEST['b']; 
}
$collection = NULL;
$debug_text = NULL;

include("settings.php");
include("./plugins/markdown.php");

define('BOOKS_DIR', $books_dir);
define('FILE_EXT', '$file_ext');

$debug_text .= '<p>$request_b is ' . $request_b . "</p>"; // what's 'b'?
if($request_b === "") $debug_text .= "<p>b is an empty string\n</p>";
if($request_b === false) $debug_text .= "<p>b is false\n</p>";
if($request_b === null) $debug_text .= "<p>b is null\n</p>";
if(isset($request_b)) $debug_text .= "<p>b is set\n</p>";
if(!empty($request_b)) $debug_text .= "<p>b is not empty</p>";

$debug_text .= '<ul class="debug-books-list">';
foreach(glob("./books/*.md") as $b){
    $debug_text .= "<li>".$b."</li>\n";
};
$debug_text .= "</ul>";

// The following taken from github.com/circa75/dropplets index.php
//
// $collection is used for collections of books
// $filename is the name of the file, before adding file extension
//
if ($request_b === "") {
    $debug_text .= ("<p>No file was requested; displaying index." . FILE_EXT . "</p>");
    $filename = BOOKS_DIR . "index" . FILE_EXT;;
    $content = Markdown(file_get_contents($filename));
    // and therefore you should post the front of the bookcase, the file index.md
    include $templates_dir.$template."/index.php";
} else {
    
    /* This portion borrows from Dropplets' pretty-permalinks processing logic.
     * Bits of it won't make sense unless pretty permalinks are implemented, like the whole collection logic loop. 
     */
    $filename = explode('/',$request_b);
    // File name could be the name of a collection
    if($filename[count($filename) - 2] == "collection") {
        /*
         * url.tld/collection/collectionname/post if using pretty permalinks from dropplets
         * otherwise, this means nothing at all and I should feel bad, or find another way of doing collection URLs
         * this will not work until collections are implemented
         * good thing no one will link to a collection
         */
        $collection = $filename[count($filename) - 1];
        $filename = null;
        // Collections of books, based on tagging!
        $debug_text .= ("<p>The collection of books to be displayed is ". $collection ."</p>");
    } else {
        /*
         * Individual Post
         * where books/bookfilename.md has the url /bookfilename
         */        
        $filename = BOOKS_DIR . $filename[count($filename) - 1] . FILE_EXT;
        $debug_text .= ("<p>The post filename requested ".$filename."</p><hr/>");
        
        if (!file_exists($filename)) {
            $debug_text .= "<h1>404</h1>\n<p></p>";
            include $templates_dir.$template."/404.php";
        } else {
            $content = Markdown(file_get_contents($filename)); //for the template
            include $templates_dir.$template."/book.php";
        }
        // 
    }
}
?>
