<?php

namespace App\Http\Controllers\nurse;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
//use Illuminate\Http\Client\ConnectionException;
use Spatie\Browsershot\Browsershot;
use Auth;
use DB;

class AhpraLookupsController extends Controller
{
     public function getAhpraDetails(Request $request)
    {
        $regNumber = $request->input('reg_number'); // e.g. NMW0002057010
        $reverify_text = $request->input('reverify_text');
        $lastVerified = $request->input('lastVerified');


        try {
            $response = Http::timeout(150)->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post('https://mediqa.com.au/scrape', [
                'regNumber' => $regNumber
            ]);

            

            
             $data2 = $response->json();

             
            
            
            if ($response->successful()) {
               

                
                
                
                if($reverify_text == "1"){
                    $data = $response->json();
                    $user_id = Auth::guard('nurse_middle')->user()->id;
                    $data1['aphra_registration_no']     = $regNumber     ?? null;
                    $data1['register_division']     = $data['data']['division']     ?? null;
                    $data1['register_endorsements'] = $data['data']['endorsements'] ?? null;
                    $data1['register_reg_type']   = $data['data']['registration_type']   ?? null;
                    $data1['register_reg_status']   = $data['data']['registrationStatus']   ?? null;
                    $data1['register_notations']   = $data['data']['notations']   ?? null;
                    $data1['register_conditions']   = $data['data']['conditions']   ?? null;
                    $data1['register_expiry']   = $data['data']['expiryDate']   ?? null;
                    $data1['register_principal_place']   = $data['data']['suburb'].",".$data['data']['state'].",".$data['data']['postcode'].",".$data['data']['country'];
                    $data1['last_verified']   = $lastVerified;
                    //print_r($response);

                    DB::table('user_licenses_details')->where("user_id",$user_id)->update($data1);
                }
                return response()->json($response->json());
                
                
            }

            if($data2['error'] == 'No matching'){
                return response()->json(['error' => $data2['error']]);
            }

            

        }catch (\Exception $e) {
            // Scraper crashed, timeout, connection error, etc.
            
            return response()->json(['error' => 'failed']);
            
        }

        
    }
}
