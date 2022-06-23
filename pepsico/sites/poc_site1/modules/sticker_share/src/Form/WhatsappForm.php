<?php
namespace Drupal\sticker_share\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\sticker_share\Form\WhatsAppApi;
/**
 * Class MyForm.
 */
class WhatsappForm  extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'whatsapp_share_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
  
    $form['#prefix'] = '<div id="whatsapp_form_wrapper">
                <div id="whatsapp_form_status_message"></div>
                <div id="website_brand_recipi"></div>';
    $form['#suffix'] = '</div>';
    $form['phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone'),
      '#description' => $this->t('Enter your phone number'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'button',
      '#value' => $this->t('Submit'),
      '#ajax' => [
        'callback' => '::sendWhatsappMessage',
      ],
    ];

   /* $form['addLogo'] = [
      '#type' => 'button',
      '#value' => $this->t('Add Logo'),
      '#ajax' => [
        'callback' => '::addCompanyLogo',
      ],
    ];*/
    return $form;
  }

  public function sendWhatsappMessage(array &$form, FormStateInterface $form_state)
  {

    $ajaxResponse = new AjaxResponse();
    if (!$form_state->getValue('phone') || empty($form_state->getValue('phone'))) {
        $text = 'Please enter your phone number';
        $ajaxResponse->addCommand(new HtmlCommand('#whatsapp_form_status_message', $text));
       // return $response;
      }
      else
      {
          $text = "Message sent successfully!";
          $ultramsg_token="y77vmvhpzoyb9fb2"; // Ultramsg.com token
          $instance_id="instance7877"; // Ultramsg.com instance id
            $to="+91".$form_state->getValue('phone');
            $caption="Herba Life POC"; 
            $image="https://hopeforlight.com/wp-content/uploads/2022/05/WhatsApp-Image-2022-05-20-at-4.14.58-PM.jpeg"; 
            $priority=10;
            $referenceId="SDK";
            $nocache=false; 

            $link = "https://hopeforlight.com/wp-content/uploads/2022/05/WhatsApp-Image-2022-05-20-at-4.14.58-PM.jpeg";

			$msgBody = "Click the link to download the sticker";
            $params =array("to"=>$to,"link"=>$link,"priority"=>$priority,"referenceId"=>$referenceId,'caption'=>$caption);
          $method = "POST";
          $path = "messages/link";
          $text = "Message sent successfully!";
          $ultramsg_token="y77vmvhpzoyb9fb2"; // Ultramsg.com token
          $instance_id="instance7877"; // Ultramsg.com instance id
          $url="https://api.ultramsg.com/".$instance_id."/".$path;
          $params['token'] = $ultramsg_token;
          $data=http_build_query($params);
          if(strtolower($method)=="get")$url = $url . '?' . $data;
          $curl = curl_init($url);
          if(strtolower($method)=="post"){
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
          }	 
          curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_HEADER, 1);
          $response = curl_exec($curl);
          $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
          if($httpCode == 404) {
          return array("Error"=>"instance not found or pending please check you instance id");
          }
          $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
          $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
          $header = substr($response, 0, $header_size);
          $body = substr($response, $header_size);
          curl_close($curl);
          if (strpos($contentType,'application/json') !== false) {
            $message_res = json_decode($body,true);
            }
        if(isset($message_res['error']))
        {
            $ajaxResponse->addCommand(new HtmlCommand('#whatsapp_form_status_message',$message_res['error']));
        }
        else
        {
            $ajaxResponse->addCommand(new HtmlCommand('#whatsapp_form_status_message',$text));
        }
        
       // return $response;
      }

      return $ajaxResponse;

   

  }
public function addCompanyLogo(array &$form, FormStateInterface $form_state)
{
  $ajaxResponse = new AjaxResponse();
  $fileBasePath='sites//poc_site1/files/herbalife/';
  $recipiimagePath = $fileBasePath.'recipi.jpg';
  $logoImagePath = $fileBasePath.'logo.jpeg';
  $logo2ImagePath = $fileBasePath.'logo2.jpg';
  if(file_exists($recipiimagePath))
  {
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
     /* header('Content-Type: image/png');
      imagepng($dest);*/
      $text ="Brand logo added successfully";
      $ajaxResponse->addCommand(new HtmlCommand('#whatsapp_form_status_message',$dest));
      imagedestroy($dest);
      imagedestroy($src);
      imagedestroy($src2);
  }
  else
  {
    $text =$image_url;
    $ajaxResponse->addCommand(new HtmlCommand('#whatsapp_form_status_message',$text));
  }
  

  return $ajaxResponse;
}
/************************************************************************** 
 




**********************************************************************************/
  
  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    
  }
}