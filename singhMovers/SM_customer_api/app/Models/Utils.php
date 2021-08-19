<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
require __DIR__ .'/vendor/autoload.php';
use Twilio\Rest\Client;

class Utils extends Authenticatable
{
    use HasFactory, Notifiable;

     /**
     * The table associated with the model .
     *
     * @var String
     */
    protected $table = 'user_otp_varification';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    public static function sendEmail($toEmail,$fromEmail,$toName,$fromName,$subject,$message)
    {
            $to  = $toEmail; // note the comma
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            
            // Additional headers
            $headers .= "To: ".$toName." <".$toEmail.">" . "\r\n";
            $headers .= "From: ".$fromName." <".$fromEmail.">" . "\r\n";
            
            
            // Mail it
            mail($to, $subject, $message, $headers);
    }
    
    public static function sendSMS($phoneNumber,$message)
    {
        // In production, these should be environment variables.
        $account_sid = 'AC70fd68d371036ca346a8387295570c60';
        $auth_token = 'fd5b06a99bad910455980c454a05aa0f';
        $twilio_number = "+12015618121"; // Twilio number you own
        $client = new Client($account_sid, $auth_token);
        // Below, substitute your cell phone
        $realPhoneNumber = '+61'.$phoneNumber;
        $client->messages->create(
            $realPhoneNumber,  
            [
                'from' => $twilio_number,
                'body' => $message
            ] 
        );
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'otp',
        'varification_done',
        'datetime'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}