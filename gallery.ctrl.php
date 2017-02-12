<?
//error reporting
error_reporting(E_ALL & ~E_NOTICE);

//config for path, files etc
define("PHOTO_PATH", "photos");
define("DESCRIPTION_FILE", "description.txt");
define("THUMB_PATH", "thumbs");


//TPL setup, static variables

$TPL['controller'] = $_SERVER['PHP_SELF'];

switch ($_REQUEST['act']) :

  // one photo
  case "onephoto":

    $TPL['one_photo'] = true;

    $PhotoDir = PHOTO_PATH . "/" . $_REQUEST['dir'] . "/";
    $scannedDirectory = glob($PhotoDir . "*.jpg");
    $directoryIndexSet = $_GET['id'];

    if($directoryIndexSet < 0)
    {
      $directoryIndexSet = 0;
    }
    else if($directoryIndexSet > count($scannedDirectory))
    {
      $directoryIndexSet = count($scannedDirectory);
    }

    $FP = opendir(PHOTO_PATH);
    while (($DIR = readdir($FP)) !== false)
    {
    // skip over . and .. directories
    if ($DIR == "." || $DIR == "..") continue;


    //individual photo
    $TPL['photo_info'] =
        array('DIR' => $_REQUEST['dir'],
              'DESCRIPTION' => file_get_contents($PhotoDir . DESCRIPTION_FILE),
              'PATHTOPHOTOS' => $PhotoDir,
              'PATHTOTHUMBS' => $PhotoDir . THUMB_PATH,
              'PHOTOTODISPLAY' => $scannedDirectory[$_GET['id']],
              'PREVIOUS' => $TPL['controller'] . "?act=onephoto&dir=" .  $_REQUEST['dir'] . "&id=" . $directoryIndexSet - 1,
              'NEXT' => $TPL['controller'] . "?act=onephoto&dir=" .  $_REQUEST['dir'] . "&id=" . $directoryIndexSet + 1,
              // 'TOTAL' =>,
              'photoList' => ($scannedDirectory),
              );
  }

  closedir($FP);
  break;

  // display gallery
  case "gallery_photos":

    $TPL['gallery_entries'] = true;

    $FP = opendir(PHOTO_PATH);
    while (($DIR = readdir($FP)) !== false)
    {
      // skip over . and .. directories
      if ($DIR == "." || $DIR == "..") continue;

      // get individual blog title, date, content
      $PhotoDir =  PHOTO_PATH . "/" . $_REQUEST['id'] . "/";
      $thumbDirectory = PHOTO_PATH . "/" . $_REQUEST['id'] . "/" . THUMB_PATH . "/";
      $scannedThumbDirectory = glob($thumbDirectory . "*.jpg");

      // set photo gallery array with list of thumb nails
      $TPL['photo_gallery'] =
        array(
              'id' => $_REQUEST['id'],
              'description_file' => file_get_contents($PhotoDir . DESCRIPTION_FILE),
              'photo_path' => $PhotoDir,
              'thumb_path' => $thumbDirectory,
              'photoThumbList' => ($scannedThumbDirectory),
             );
    }
    closedir($FP);
  break;

  // display all of the initial
  default:

    $TPL['ALL_PHOTO_ENTRIES'] = true;

    // get all the blog data through auto-discovering directories
    $FP = opendir(PHOTO_PATH);
    while (($DIR = readdir($FP)) !== false)
    {
      // skip over . and .. directories
      if ($DIR == "." || $DIR == "..") continue;

      // get individual blog title, date, content
      $PhotoDir =  PHOTO_PATH . "/" . $DIR . "/";
      $thumbDirectory = PHOTO_PATH . "/" . $DIR . "/" . THUMB_PATH . "/";
      $scannedThumbDirectory = glob($thumbDirectory . "*.jpg");
      $TPL['photos_entries'][] =
        array('id' => $DIR,
              'description_file' => file_get_contents($PhotoDir . DESCRIPTION_FILE),
              'lastThumbPath' => $scannedThumbDirectory[count($scannedThumbDirectory)-1],

             );
    }
    sort($TPL['photos_entries']);
    closedir($FP);

endswitch;

include 'gallery.view.php';

?>
