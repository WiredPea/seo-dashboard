<?php

define('MODULESDIR', 'sites/all/modules/custom');

if (!empty($argv[1])) {
  $dirs = scandir(MODULESDIR . "/{$argv[1]}");
}
else {
  $dirs = scandir(MODULESDIR);
}
loop_directories($dirs);

/**
 * Recursively loop over the directories.
 *
 * @param $dirs array or directories to recurse over.
 */
function loop_directories($dirs) {
  // Skip . and ..
  array_shift($dirs); // The first element is .
  array_shift($dirs); // The first element is ..

  // Loop over the directories one by one.
  foreach ($dirs as $dir) {
    if (file_exists(MODULESDIR . "/{$dir}/{$dir}.info")) {
      // There exists a $dir/$dir.info so it is a module directory.
      exec('drush coder-review minor no-empty comment i18n security sql style ' . $dir, $result);
      print_array($result);
    } elseif ( is_dir(MODULESDIR . "/$dir")) {
      $subdirs = scandir(MODULESDIR . "/{$dir}");
      loop_directories($subdirs);
    }
  };
}

/**
 * Prints out the summary of the coder-review
 *
 * @param $array Array of string as produced by Drush.
 */
function print_array($array) {
  $print = FALSE;                       // Set the print flag to FALSE.
  foreach ($array as $line) {
    if ( strstr($line, MODULESDIR) ) {  // If the line contains the modules dir.
      print( "{$line}\n" );             // print it.
      $print = TRUE;                    // and keep printing.
    } elseif ($print === TRUE) {
      if ( substr($line, 1, 1) === '+') { // As long as the second char is +.
        print("{$line}\n");
      } else {
        print("\n");                    // otherwise print an empty line.
        $print = FALSE;                 // And stop printing.
      }
    }
  }
}
