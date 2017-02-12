
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
  </head>
  <body>

    <div class="row">
      <div class="large-12 columns">
        <h1 class="text-center subheader"><a href="<?= $TPL['controller'] ?>"><strong>My Photo Galleries</strong></a></h1>
      </div>
    </div>


    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
             <ul class="small-block-grid-3">

              <!-- Display Initial Load-->
               <? if ($TPL['photos_entries']) { ?>
                 <? foreach ($TPL['photos_entries'] as $photo) { ?>
                   <hr>
                   <a href="<?= $TPL['controller'] ?>?act=gallery_photos&id=<?= $photo['id'] ?>"><img class="th" src="<?=$photo[lastThumbPath] ?>" ></a> <br />
                   <p><?= $photo['description_file'] ?></p>

                 <? }?>
               <? } ?>

               <!--Display Gallery-->
               <? if ($TPL['gallery_entries']) { ?>
                 <? foreach ($TPL['photo_gallery']['photoThumbList'] as $key => $photo) { ?>
                   <hr>
                   <a href="<?= $TPL['controller'] ?>?act=onephoto&dir=<?= $TPL['photo_gallery']['id'] ?>&id=<?=$key?>"><img class="th" src="<?=$photo ?>" ></a> <br />
                 <? }?>
               <? } ?>

               <!--One Photo-->
               <? if ($TPL['one_photo'])
               { ?>
                  <h3><strong><?= $TPL['photo_info']['DESCRIPTION'] ?></strong></h3>
                  <p>
                  <a href="<?=$TPL['photo_info']['PREVIOUS'] ?>">PREV</a>
                  <a href="<?=$TPL['photo_info']['NEXT'] ?>">NEXT</a>
                  <span><strong>Picture numbers</strong></span>
                  <a class="" href="">Show All Photos</a>
                  </p>
                  <img class="" src="<?=$TPL['photo_info']['PHOTOTODISPLAY'] ?>" ></a> <br />
                  <?
                } ?>


                <!--
                               <li class="text-center">
                 <a href="">
                 <img class="th" src="" ></a> <br />
                  <p class="text-center">My Visit to a Baseball Park</p>
                 </li>
                                <li class="text-center">
                 <a href="">
                 <img class="th" src="" ></a> <br />
                  <p class="text-center">The Gardens I visited when I went to the Antartctic</p>
                 </li>
                                <li class="text-center">
                 <a href="">
                 <img class="th" src="" ></a> <br />
                  <p class="text-center">A bunch of boring road pictures.</p>
                 </li>
                                <li class="text-center">
                 <a href="eventPhotos.php?act=allphotos&dir=4">
                 <img class="th" src="photos/d4/thumbs/vacation_009.jpg" ></a> <br />
                  <p class="text-center">Some great vacation photos here. </p>
                 </li>
                                <li class="text-center">
                 <a href="eventPhotos.php?act=allphotos&dir=5">
                 <img class="th" src="photos/d5/thumbs/spain_007.jpg" ></a> <br />
                  <p class="text-center">My awesome photos from Spain!!!</p>
                 </li>
                             </ul>
                           -->








      	</div>
      </div>
    </div>


    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>



    <pre>  <? print_r($TPL) ?></pre>


  </body>
  </html>
