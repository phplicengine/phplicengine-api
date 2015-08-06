## Upload Files

You can upload files with post() method and with this array structure as post parameter. Note that 'filename' must be absolute path to file.


```php
Array
(
    [files] => Array
        (
            [0] => Array
                (
                    [filename] => /path/to/file2.txt
                )
            [1] => Array
                (
                    [filename] => /path/to/file1.txt
                )
        )
    [foo] => bar
)
```
