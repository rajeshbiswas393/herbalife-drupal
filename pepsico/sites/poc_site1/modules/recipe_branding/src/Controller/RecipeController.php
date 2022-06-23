<?php
namespace Drupal\recipe_branding\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManager;
class RecipeController extends ControllerBase  {
  public function recipeImageWithBrandLogo($id=null)
  {
    $node = \Drupal::EntityTypeManager()->getStorage('node')->load($id);
    $fileBasePath='sites//poc_site1/files/herbalife/';
    $noImageFoundURI = $fileBasePath.'no-image.jpg';
    if(!$node)
    {
      $dest = imagecreatefromjpeg($noImageFoundURI);
      header('Content-Type: image/png');
      imagepng($dest);
      return;
    }
    $image = $node->get('field_image')->getValue();
    $fid = $image[0]['target_id'];
    $file = \Drupal\file\Entity\File::load($fid);
    $imageURI = $file->getFileUri();
    if(file_exists($imageURI))
    {
      $fileBasePath='sites//poc_site1/files/herbalife/';
      $recipiimagePath = $imageURI;
      $logoImagePath = $fileBasePath.'logo.jpeg';
      $logo2ImagePath = $fileBasePath.'logo2.jpg';
       
            $dest = imagecreatefromjpeg($recipiimagePath);
            $src = imagecreatefromjpeg($logoImagePath);
            $src2 = imagecreatefromjpeg($logo2ImagePath);
            $logoSize = getimagesize($logoImagePath);
            $logoHeight = $logoSize[1];
            $logoWidth =  $logoSize[0];
            $logo2Size = getimagesize($logo2ImagePath);
            $logo2width = $logo2Size[0];
            $logo2heigth = $logo2Size[1];
            $recipiSize = getimagesize($recipiimagePath);
            $recipiWidth = $recipiSize[0];
            $recipiHeight = $recipiSize[1];

            $destinationLogoPositionX = 10;
            $destinationLogoPositionY = ($recipiHeight -  $logoHeight);

            $destinationLogo2PositionX = ($recipiWidth - $logo2width)-10;
            $destinationLogo2PositionY = ($recipiHeight -  $logo2heigth)-10;

            imagealphablending($dest, false);
            imagesavealpha($dest, true);

            imagecopymerge($dest, $src, $destinationLogoPositionX,$destinationLogoPositionY-10, 0, 0,$logoWidth,$logoHeight,100); //have to play with these numbers for it to work for you, etc.
            imagecopymerge($dest, $src2, $destinationLogo2PositionX,$destinationLogo2PositionY, 0, 0,$logo2width,$logo2heigth, 100); //have to play with these numbers for it to work for you, etc.

            header('Content-Type: image/png');
            imagepng($dest);
            
            imagedestroy($dest);
            imagedestroy($src);
            imagedestroy($src2);
            return;
    }
    else
    {
      $dest = imagecreatefromjpeg($noImageFoundURI);
      header('Content-Type: image/png');
      imagepng($dest);
      return;
    }
   
  }
}