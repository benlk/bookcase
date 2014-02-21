# The Bookcase

It's a custom CMS written for foodreportingsyllabus.com, to handle the Bookcase.

- Books go in `books/` in Markdown
    - No idea what the header format looks like At this point,
        - title
        - category (ies?) (would use explode() in case of multiple categories?)
- Templates go in `templates/` in PHP, and have not yet been implemented.
- Settings go in 'settings.php'

## Features:

- Detection of book files
- Collections of books

Apache logs are generally in /var/log/