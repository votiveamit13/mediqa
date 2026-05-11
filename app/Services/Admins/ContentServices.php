<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use App\Repository\Eloquent\ContentRepository;
use Illuminate\Http\Request;
use File;

class ContentServices
{
    protected $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }
    // this function used to save the contact us in database
    public function addContact($data)
    {
        try {
            $allData['name'] = $data['name'];
            $allData['lastname'] = $data['lastname'];
            $allData['phone_code_id'] = $data['phone_code'];
            $allData['phone_no'] = $data['phone_no'];
            $allData['email'] = $data['email'];
            $allData['message'] = $data['message'];
            $run = $this->contentRepository->saveContact($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => 'Thank you for contacting with us. We will get back to you as soon as possible.']);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ContentServices/addContact(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
   

}
