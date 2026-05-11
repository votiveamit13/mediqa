<?php

namespace App\Repository\Eloquent;

use App\Models\ContactusModel;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class ContentRepository extends BaseRepository{

    protected $model;
    protected $cache;
    protected $faq;
    protected $newsletterModel;
    protected $contentModel;
    protected $aboutUs;
    protected $aboutUsCount;

    public function __construct(ContactusModel $model){
        $this->model = $model;
      

        parent::__construct($model);
    }
    public function saveContact($data){
        try {
            return $this->model->create($data);
        } catch(\Exception $e){
            Log::error("Error in ContentRepository.saveContact(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getContactList(){
        try {
            return $this->model->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in ContentRepository.getContactList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
}
