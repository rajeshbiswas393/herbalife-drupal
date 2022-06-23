<?php
namespace Drupal\sticker_share\Controller;
use Drupal\sticker_share\Controller\FPDF;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManager;
class StickerController extends ControllerBase  {
  public function share_page($id) {

    
    $node = \Drupal::EntityTypeManager()->getStorage('node')->load($id);
    $fileBasePath='sites//poc_site1/files/herbalife/';
    $noImageFoundURI = $fileBasePath.'no-image.jpg';
    if(!$node)
    {
      $imageURI = $noImageFoundURI;
    }
    $image = $node->get('field_image')->getValue();
    $fid = $image[0]['target_id'];
    $file = \Drupal\file\Entity\File::load($fid);
    $imageURI = $file->getFileUri();

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,'Recipe Details');
  $x = 15;
  $y = 20;
  $pdf->Image($imageURI,$x,$y,200);
  $fileName = time().md5(rand(0,100)).'_download.pdf';
  $pdf->Output('D',$fileName,true);
  return ['#markup' => '<div>File Not exist</div>'];
  }
  public function recipImage($id=null)
  {
    $node = \Drupal::EntityTypeManager()->getStorage('node')->load($id);
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

            // Save the image as 'simpletext.jpg'
            $imageName = $fileBasePath."brand-recipies/herbalile_healthy_recipies_".time().".jpg";
            imagejpeg($dest,$imageName);
            header('Content-Type: image/png');
            imagepng($dest);
            
            imagedestroy($dest);
            imagedestroy($src);
            imagedestroy($src2);
    }
    else
    {
      return ['#markup' => '<div>File Not exist</div>'];
    }
   
  }
}