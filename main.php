<?php     
     // split long Twitter message into thread
    function convertLongTweetIntoThread($tweet)
    {
        $thread = [];
    // decode html entities
    $tweet = html_entity_decode($tweet);
    // replace URLs with 23 characters long temporary url as Twitter use 23 characters for URL
    $length = strlen(preg_replace('/(http(s)?:\/\/)?(([a-zA-Z0-9])([-\w]*\.)+([^\s\.]+[^\s]*)+[^,.\s])/', 'http://8901234567890123', $tweet));

    if ($length > 280) {
        // pattern to break string into array
        $pattern = '[cs$$break]';
        // divide into 273 characters long tweets because we added 4 characters( ...) at end of the thread and 3 characters (...) at the start of the next thread.
        $tweets = explode($pattern, wordwrap($tweet, 273, $pattern));

        foreach ($tweets as $index => $output) {
            if (
                $index == 0
            ) // first thread check
                array_push($thread, $output . ' ...');
            else if ($index + 1 == count($tweets)) // last thread check
            array_push($thread, '...' . $output);
            else // middle thread
            array_push($thread, '...' . $output . ' ...');
        }
    } else {
        array_push($thread, $tweet);
    }
    return $thread;
   
    }
