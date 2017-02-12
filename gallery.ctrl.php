<!-- I, Bobby Filippopoulos, 000338236, Verify that this is my work and only my work-->

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

  // Display one photo
  case "onephoto":

    $TPL['one_photo'] = true;

    $PhotoDir = PHOTO_PATH . "/" . $_REQUEST['dir'] . "/";
    $thumbDirectory = PHOTO_PATH . "/" . $_REQUEST['id'] . "/" . THUMB_PATH . "/";
    $scannedDirectory = glob($PhotoDir . "*.jpg");

    //Directory index - used to avoid out of bounds errors - photo selection will only go to the beginning or end of the gallery
    $directoryIndexDecremented = $_GET['id']-1;
    $directoryIndexIncremented = $_GET['id']+1;

    if($directoryIndexDecremented < 0)
    {
      $directoryIndexDecremented = 0;
    }
    else if($directoryIndexIncremented > count($scannedDirectory)-1)
    {
      $directoryIndexIncremented = count($scannedDirectory)-1;
    }

    $directoryIndexDecrementedString = (string)$directoryIndexDecremented;
    $directoryIndexIncrementedString = (string)$directoryIndexIncremented;
    //  ------------------------------------------------------------------->

    $FP = opendir(PHOTO_PATH);
    while (($DIR = readdir($FP)) !== false)
    {
    // skip over . and .. directories
    if ($DIR == "." || $DIR == "..") continue;

    //Individual photo and information for following photo and previous photo
    $TPL['photo_info'] =
        array('DIR' => $_REQUEST['dir'],
              'DESCRIPTION' => file_get_contents($PhotoDir . DESCRIPTION_FILE),
              'PATHTOPHOTOS' => $PhotoDir,
              'PATHTOTHUMBS' => $thumbDirectory,
              'PHOTOTODISPLAY' => $scannedDirectory[$_GET['id']],
              'PREVIOUS' => $TPL['controller'] . "?act=onephoto&dir=" .  $_REQUEST['dir'] . "&id=" . $directoryIndexDecrementedString,
              'NEXT' => $TPL['controller'] . "?act=onephoto&dir=" .  $_REQUEST['dir'] . "&id=" . $directoryIndexIncrementedString,
              'THISPHOTO' => $_GET['id']+1,
              'photoList' => ($scannedDirectory),
              );
  }
  closedir($FP);
  break;

  // Display the folders gallery of photos (thumbnails)
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
      sort($scannedThumbDirectory);

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

  // Display all the initial galleries, each gallery will display the last thumbnail
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
