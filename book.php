<html>
    <head>
        <title>TEST BOOK THING</title>
    </head>
    <body>
<?php
echo("<p>" . $_REQUEST['b'] . "</p>");
echo($_REQUEST);
if($_REQUEST["b"] === "") echo "b is an empty string\n";
if($_REQUEST["b"] === false) echo "b is false\n";
if($_REQUEST["b"] === null) echo "b is null\n";
if(isset($_REQUEST["b"])) echo "b is set\n";
if(!empty($_REQUEST["b"])) echo "b is not empty";

//if($_REQUEST['b'] in glob("./books/*.md" as $b)) { // this sint' working
//    include $b;
//}
echo "<ul>";
foreach(glob("./books/*.md") as $b){
    echo "<li>".$b."</li>\n";
};
echo "</ul>";

// The following taken from github.com/circa75/dropplets index.php
//
// $collection is used for collections of books
// $filename is the name of the file, before adding file extension
//

include("settings.php");
include("./plugins/markdown.php")

define('BOOKS_DIR', $books_dir);
define('FILE_EXT', '.md');

$collection = NULL;
if (empty($_GET['b'])) {
    $filename = NULL;
    echo("<p>The filename is null!</p>");
    // and therefore you should post the front of the bookcase
} else {
    
    //Filename can be /some/blog/post-filename.md We should get the last part only
    $filename = explode('/',$_GET['b']);
    // File name could be the name of a collection
    if($filename[count($filename) - 2] == "collection") { // url.tld/collection/collectionname/post
        $collection = $filename[count($filename) - 1];
        $filename = null;
        // Collections of books, based on tagging!
        echo("<p>The collection of books to be displayed is ". $collection ."</p>");
    } else {
        // Individual Post
        $filename = BOOKS_DIR . $filename[count($filename) - 1] . FILE_EXT;
        echo("<p>The post filename is ".$filename."</p>");
        /*
        if (!file_exists($filename)) {
            echo "<h1>404</h1>";
        } else {
            $content = Markdown($filename); //for the template
            echo $content;
        }
        */
        
        // 
    }
}
?>
        
    </body>
</html>