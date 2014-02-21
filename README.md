# The Bookcase

It's a custom CMS written for foodreportingsyllabus.com, to handle the Bookcase.

## Features:

- Detection of book files
- Template capability (ships with a very basic theme)
- Collections of books (not yet implemented)

## Setup

- Books go in `books/` in Markdown
    - No idea what the header format looks like yet (not yet implemented)
        - title
        - image
        - next
        - previous
        - star rating?
        - bonus?
        - category (ies?) (would use explode() in case of multiple categories?)
- Front page `index.md` goes in `books/`
- Templates go in `templates/` in PHP. The following files are required:
    - `index.php` - the index or front page of your site
    - `book.php` - used to display a single book
    - `404.php` - displayed when the requested book
- Settings go in 'settings.php'



## Function documentation

Settings:

- `$books_dir` - Directory containing book.md files, default value is `'./books/'`
- `$templates_dir` - Directory containing book.md files, default value is `'./templates/'`
- `$template` - Directory name of chosen theme, default value is `'basic'`
- `$file_ext` - This is usually `'.md'`, but you can change it if you like. 

Stuff for templates:

- `$content` - The HTML contents of a page, as converted from Markdown using `$content = Markdown(file_get_contents($filename))`
- `$debug_text` - HTML containing debug information:
    - `$request_b` - the page requested with the format `?b=pagename`
    - a list of files in $books_dir

Other variables:

- $filename - used in `book.php` to reference the file in `$books_dir` to be converted to HTML from Markdown

Apache logs are generally in /var/log/