<?php

class GifRecord
{
    /**
     * run gif record
     */
    public function run()
    {
        $name = md5(mt_rand(0, 1000000));
//        $contents = file_get_contents('features/bootstrap/src/BugReport/GifRecord/run.sh -r '.$name);
        exec('/home/meldon/PhpstormProjects/All4bom_TA/features/bootstrap/src/BugReport/GifRecord/run.sh -r ' . $name);
        return $name . ".gif";
    }

    /**
     * stop gif record
     */
    public function stop()
    {
//        $contents = file_get_contents('features/bootstrap/src/BugReport/GifRecord/kill.sh');
        shell_exec("/home/meldon/PhpstormProjects/All4bom_TA/features/bootstrap/src/BugReport/GifRecord/kill.sh");
        return "http://i0.kym-cdn.com/entries/icons/facebook/000/001/030/dickbutt.jpg";
    }
}