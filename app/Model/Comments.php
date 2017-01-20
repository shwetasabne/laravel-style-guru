<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
	use SoftDeletes;

	protected $table = 'comments';

	protected $dates = ['deleted_at'];
    
    protected $fillable = ['comment_text','item_id','user_id'];

}