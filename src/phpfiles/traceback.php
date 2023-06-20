<?php
function debug_trace()
{
    $trace = debug_backtrace();
    echo "Debug Backtrace:\n";
    foreach ($trace as $index => $call) {
        echo "#{$index}: ";
        if (isset($call['file'])) {
            echo "{$call['file']}:{$call['line']} ";
        }
        if (isset($call['class'])) {
            echo "{$call['class']}{$call['type']}";
        }
        echo "{$call['function']}()\n";
    }
}

// Usage example
echo "Before breakpoint\n";
debug_trace(); // Set a breakpoint here
echo "After breakpoint\n";

?>