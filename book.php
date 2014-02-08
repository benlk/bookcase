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
// $category is used by Dropplets for handling the post categories, which isn't a thing here
// $filename is the name of the file, before adding file extension
// 
$category = NULL;
if (empty($_GET['filename'])) {
    $filename = NULL;
    echo("<p>The filename is null!</p>");
    // and therefore you should post the front of the bookcase
} else if($_GET['filename'] == 'rss' || $_GET['filename'] == 'atom') {
    $filename = $_GET['filename'];
    echo("<p>It's asking for RSS!</p>");
    // and there really souldn't be anything here, since this needs no RSS
}  else {
    
    //Filename can be /some/blog/post-filename.md We should get the last part only
    $filename = explode('/',$_GET['filename']);

    // File name could be the name of a category
    if($filename[count($filename) - 2] == "category") { // url.tld/category/categoryname/post
        $category = $filename[count($filename) - 1];
        $filename = null;
        // we don't really need categories?
    } else {
      
        // Individual Post
        $filename = POSTS_DIR . $filename[count($filename) - 1] . FILE_EXT;
        // 
    }
}
?>
        
    </body>
</html>