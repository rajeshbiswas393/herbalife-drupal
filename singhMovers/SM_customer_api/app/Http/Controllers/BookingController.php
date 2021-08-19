<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Utils;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserBookingList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric'
        ]);
        
          if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        //getting booking list of a user
         $bookings = Booking::leftJoin('booking_status', 'booking.status', '=', 'booking_status.id')
         ->select('booking.*','booking_status.name AS status_name')
         ->where('user_id',$request['user_id'])
         ->orderBy('id', 'DESC')
         ->limit(10)
         ->get();
         if($bookings)
         {
               $response = ['message'=> 'Success','list' => $bookings];
                return response($response, 200);
         }
         else
         {
             $response = ['message'=> 'Something went wrong!'];
              return response($response, 422);
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|min:255',
            'email' => 'required|string|email|max:255',
            'user_id' => 'required|numeric',
            'pickup' => 'required|string|min:6',
            'delivery' => 'required|string|min:6',
            'relocationtype' => 'required|string|max:255',
            'date' => 'required|string',
            'time' => 'required|string|max:255',
            'detail' => 'required|string',
        ]);
        
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        unset($request['items']);
        $request['page_url']=$request['page_url'] ? $request['page_url']  : 'Mobile App';
        $request['querydate'] = $request['querydate'] ? $request['querydate']  :date('Y-m-d G:i:s');
        $request['requesttype'] = $request['requesttype'] ? $request['status']  : '';
        $request['size'] = $request['size'] ? $request['size']  : '';
        $request['bedroom'] = $request['bedroom'] ? $request['bedroom']  : 1;
        $request['ip'] = $request['ip'] ? $request['ip']  : 'Mobile App';
        $request['status'] = $request['status'] ? $request['status']  : 1;
        
        //die('Hi');
         $booking = Booking::create($request->toArray());
         
         try {
         
             if($booking)
             {
                   $quotedPrice ='$105';
                   $fuelPrice ='45';
                   $stairsPrice ='$25';
                   $orderConfirmSMS = "Hello $booking->name, \r\n
    
                        Greetings from Singh Movers this is just a confirmation message. \r\n
                        
                        Please confirm all your details with us for the job. \r\n
                        Customer contact: $booking->phone \r\n
                        Pick up – $booking->pickup \r\n
                        Drop off - $booking->delivery \r\n
                        Date: - date('d-m-Y',strtotime($booking->date)) \r\n
                        Time: - $booking->time \r\n
                        Truck size: - 2 men + 6 Ton \r\n
                        Advance: -
                        Quoted price: -  $quotedPrice \r\n
                        Fuel: $fuelPrice \r\n
                        Return cost: N/A \r\n
                        Stairs: If there are any stairs $stairsPrice/per flight will be  charged. \r\n
                        Move size: 3 Bedroom House \r\n
                        List of Items: Please share complete stuff list for insurance purposes . \r\n
                        
                        Packing: With heavy duty blankets (if have any special packing instructions change accordingly) \r\n
                        Dismantling and assembling service will be provided if needed Please confirm all the details. \r\n \r\n
                        
                        Kind Regards
                        Sales Team ";
                   
                   Utils::sendSMS($booking->phone,$orderConfirmSMS);
                   
                   $response = ['message'=> 'Booking Saved successfully','id' => $booking->id];
                   $adminMessage = '<p>A new order have been receieved with the following datails <br/><br/></p>';
                   $userMessage = '<p>We have receieved a your with the following details. Your executive will connect you soon<br/><br/></p>';
                       $orderdetailsTableHtml = '<table border="1" cellspacing="1" cellpadding="2">';
                       
                        $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Order Id</th>';
                       $orderdetailsTableHtml .='<td>#'.$booking->id.'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Name</th>';
                       $orderdetailsTableHtml .='<td>'.$booking->name.'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       
                       $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Phone</th>';
                       $orderdetailsTableHtml .='<td>'.$booking->phone.'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       
                       $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Email</th>';
                       $orderdetailsTableHtml .='<td>'.$booking->email.'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       
                       $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Pickup Address</th>';
                       $orderdetailsTableHtml .='<td>'.$booking->pickup.'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       
                       $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Delivery Address</th>';
                       $orderdetailsTableHtml .='<td>'.$booking->delivery.'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       
                       $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Relocation Type</th>';
                       $orderdetailsTableHtml .='<td>'.$booking->relocationtype.'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       
                       $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Date</th>';
                       $orderdetailsTableHtml .='<td>'.date('d-m-Y',strtotime($booking->date)).'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       
                       $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Time</th>';
                       $orderdetailsTableHtml .='<td>'.$booking->time.'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       
                       $orderdetailsTableHtml .='<tr>';
                       $orderdetailsTableHtml .='<th>Details</th>';
                       $orderdetailsTableHtml .='<td>'.$booking->detail.'</td>';
                       $orderdetailsTableHtml .='</tr>';
                       $orderdetailsTableHtml .= '</table>';
                       
                        $userMessage = '<p>We have receieved a your with the following details. Your executive will connect you soon<br/><br/></p>'.$orderdetailsTableHtml;
                        
                            $fromEmail = 'info@singhmovers.com.au';
                            $fromName = 'Singh Movers';
                            $toEmail = $booking->email;
                            $toName = $booking->name;
                            $subject = 'Booking Confirmation';
                
                            Utils::sendEmail($toEmail,$fromEmail,$toName,$fromName,$subject,$userMessage);
                        
                        $adminMessage = '<p>A new order have been receieved with the following datails <br/><br/></p>'.$orderdetailsTableHtml;
                        
                            $fromEmail = 'webadmin@singhmovers.com.au';
                            $fromName = 'Singh Movers Web Admin';
                            $toEmail = 'info@singhmovers.com.au';
                            $toName = 'Singh Mover Admin';
                            $subject = 'New Order Detils';
                            
                            Utils::sendEmail($toEmail,$fromEmail,$toName,$fromName,$subject,$adminMessage);
                        
                   
                   
                    return response($response, 200);
             }
             else
             {
                 $response = ['message'=> 'Something went wrong!'];
                  return response($response, 422);
             }
         }
         catch(Exception $e) 
         {
            $booking->delete();
            return response(['message'=> $e->getMessage()], 422);
         }
      
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBooking(Request $request)
    {
        //booking details
         $validator = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);
        
          if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        //getting booking list of a user
         $booking = Booking::where('id',$request['id'])
         ->first();
         if($booking)
         {
               $response = ['message'=> 'Success','booking' => $booking];
                return response($response, 200);
         }
         else
         {
             $response = ['message'=> 'Something went wrong!'];
              return response($response, 422);
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|min:255',
            'email' => 'required|string|email|max:255',
            'pickup' => 'required|string|min:6',
            'delivery' => 'required|string|min:6',
            'relocationtype' => 'required|string|max:255',
            'date' => 'required|string',
            'time' => 'required|string|max:255',
            'detail' => 'required|string',
            'id' => 'required|numeric|min:0',
        ]);
        
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        
        $booking = Booking::where(['id' => $request->id]);
        if($booking)
        {
                $booking->update([
                    'name'=>$request->name,
                    'phone'=>$request->phone,
                    'email'=>$request->email,
                    'pickup'=>$request->pickup,
                    'delivery'=>$request->delivery,
                    'relocationtype'=>$request->relocationtype,
                    'date'=>$request->date,
                    'time'=>$request->time
                    ]);
                $response = ['message' => 'Booking details updated successfully!'];
                return response($response, 200);
          
        }
        else
        {
             return response(['message'=>'No user found'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getServices(Request $request)
    {
        //
         $services = Service::where('status',1)
         ->orderBy('id', 'DESC')
         ->limit(20)
         ->get();
         if($services)
         {
            $response = ['services'=> $services];
            return response($response, 200);
         }
         else
         {
              $response = ['message'=> 'Something went wrong!'];
              return response($response, 422);
         }
    }
     public function cancle($id)
    {
        //
    }
    
      public function contactEmail(Request $request)
        {
              $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
            //Sending email to site admin
            $to  ='info@singhmovers.com.au'; // note the comma
            
            // subject
            $subject = $request['subject'];
            
            // message
            $message = $request['message'];
            
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            
            // Additional headers
            $headers .= 'To: Singh Movers <info@singhmovers.com.au>' . "\r\n";
            $headers .= "From: ".$request['name']." <".$request['email'].">" . "\r\n";
            
            
            // Mail it
            mail($to, $subject, $message, $headers);
            
            
             //Sending email to user
            $to  =$request['email']; // note the comma
            
            // subject
            $subject ='Query Confirmation';
            
            // message
            $message = 'Thank you for sending us your query. Our executive will connect you shortly';
            
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            
            // Additional headers
            $headers .= "To: ".$request['name']." <".$request['email'].">" . "\r\n";
            $headers .= 'From: Singh Movers <info@singhmovers.com.au>' . "\r\n";
            
            
            // Mail it
            mail($to, $subject, $message, $headers);
            
            $response = ['message'=> 'Your query have been send successfully!'];
            return response($response, 200);
        }
}
