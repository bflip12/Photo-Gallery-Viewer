<!-- I, Bobby Filippopoulos, 000338236, Verify that this is my work and only my work-->
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gallery</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />

  </head>
  <body>

  <!-- Navbar -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?= $TPL['controller'] ?>">My Photo Galleries</a>
      </div>
    </div>
  </nav>
  <!-- Navbar -->


  <!-- Display Initial Load-->
  <? if ($TPL['photos_entries']) { ?>
    <div class="container">
      <div class="row">
        <? foreach ($TPL['photos_entries'] as $photo) { ?>
          <div class="col-lg-3 col-md-6 col-xs-12 ">
            <a class = "thumbnail" href="<?= $TPL['controller'] ?>?act=gallery_photos&id=<?= $photo['id'] ?>">
              <img class="" src="<?=$photo['lastThumbPath'] ?>" >
            </a>
            <h4 class="thumb text-center"><?= $photo['description_file'] ?></h4>
          </div>
        <? }?>
      </div>
    </div>
  <? } ?>
  <!-- Display Initial Load-->

  <!--Display Gallery-->
    <? if ($TPL['gallery_entries']) { ?>
      <div class="container">
        <div class="row">
          <? foreach ($TPL['photo_gallery']['photoThumbList'] as $key => $photo) { ?>
            <div class="col-lg-4 col-md-4 col-xs-6 ">
              <a class="thumbnail" href="<?= $TPL['controller'] ?>?act=onephoto&dir=<?= $TPL['photo_gallery']['id'] ?>&id=<?=$key?>">
                <img class="img-responsive" src="<?=$photo ?>">
              </a>
            </div>
          <? }?>
        </div>
      </div>
    <? } ?>
  <!--Display Gallery-->

<!--One Photo-->
<? if ($TPL['one_photo'])
  { ?>
    <div class="container-fluid">
      <div class="col-md-12">
        <h1 class = "text-center"><?= $TPL['photo_info']['DESCRIPTION'] ?></h1>
      </div>
    </div>

    <div class = "text-center">
      <div class="container-fluid">
        <div class="col-md-12">
          <p>
            <a href="<?=$TPL['photo_info']['PREVIOUS'] ?>">PREV</a>
            <a href="<?=$TPL['photo_info']['NEXT'] ?>">NEXT</a>
            <span><strong>(<?= $TPL['photo_info']['THISPHOTO']?>/<?= count($scannedDirectory)?>)</strong></span>
            <a class="" href="<?= $TPL['controller'] ?>?act=gallery_photos&id=<?= $TPL['photo_info']['DIR'] ?>">Show All Photos</a>
          </p>
        </div>
      </div>
    </div>

    <hr />

    <div class="container-fluid">
      <div class="col-md-12">
        <img class="img-responsive center-block" src="<?=$TPL['photo_info']['PHOTOTODISPLAY'] ?>" ></a> <br />
      </div>
    </div>
<? } ?>
<!--One Photo-->

<!-- JS Script -->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
<!-- JS Script -->

    <!-- Use for testing if needed - <pre>  <? print_r($TPL) ?></pre> -->
  </body>
</html>
