<?php

declare(strict_types=1);

function dd(...$values)
{
    ob_start();
        $trace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);
        echo 'file: ', $trace[0]['file'], ' line: ', $trace[0]['line'], '<br>';
        var_dump(...$values);
    $output = ob_get_clean();

    echo (php_sapi_name() !== 'cli') ? $output : str_replace('<br>', PHP_EOL, strip_tags($output, ['<br>', '<pre>']));
    exit;
}
