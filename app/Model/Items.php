<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use DB;
use Log;
use Carbon\Carbon;

class Items extends Model
{
    protected $table = 'items';
    
    protected $fillable = ['title','description','image_path', 'max_price', 'user_id'];

    public function insertItems($item) {

    	Log::info(__CLASS__."::".__METHOD__."::"."Attempting to insert items data into database");

    	$returnData = array();
    	try {
    		DB::beginTransaction();

    		/* Insert item */
    		$item_id = DB::table('items')->insertGetId([
    				'title' => $item['title'],
    				'description' => $item['description'],
    				'image_path' => $item['image_path'],
    				'max_price' => $item['max_price'],
    				'user_id' => $item['user_id'],
    				'created_at' => Carbon::now(),
    				'updated_at' => Carbon::now()
    			]);

    		Log::info(__CLASS__."::".__METHOD__."::"."Inserted item id ".$item_id);

    		/* Insert item_categories */
    		foreach($item['categories'] as $cat) {
    			Log::info(__CLASS__."::".__METHOD__."::"."Inserting item category ".$item_id.":".$cat);
    			DB::table('items_categories')->insert(
                    ['item_id' => $item_id, 
                     'category_id' => $cat,
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now()
                    ]
                );
    		}

    		/* Insert item_occassions */
    		foreach($item['occassions'] as $occ) {
    			Log::info(__CLASS__."::".__METHOD__."::"."Inserting item occassions ".$item_id.":".$occ);
    			DB::table('items_occassions')->insert(
                    ['item_id' => $item_id, 
                     'occassion_id' => $occ,
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now()
                    ]
                );
    		}

    		DB::commit();
    		$returnData['isSuccess'] = true;
    		$returnData['message'] = 'Successfully saved item '.$item_id;
            $returnData['itemId'] = $item_id;
            return $returnData;
    	}
    	catch(Exception $e){
    		Log::info(__CLASS__."::".__METHOD__."::"."Exception inserting item".$e->message());
            DB::rollBack();
            $returnData['isSuccess'] = false;
    		$returnData['message'] = 'Failed to save item. Please try again.';
            return $returnData;
    	}

    }

    public function getItemById($id) {

        Log::info(__CLASS__."::".__METHOD__."::"."Attempting to retrieve items data for $id");
        $returnData = array();

        try{

            /* Get item data */
            $item = DB::table('items')
                        ->join('users', 'users.id', '=', 'items.user_id')
                        ->select('items.*', 
                                'users.id as user_id',
                                'users.username as username')
                        ->where('items.id', $id)
                        ->first();

            if(count($item) <= 0){
                $returnData['isSuccess'] = false;
                $returnData['message'] = "Item not found";
                $returnData['code'] = 404;
                return $returnData;
            }

            /* Get categories data */
            $categories = DB::table('categories')
                                ->join('items_categories', 'items_categories.category_id','=','categories.id')
                                ->select('categories.name')
                                ->where('item_id', $id)
                                ->get();

            $category_names = implode(', ', array_map(function($c) {
                return $c->name;
            }, $categories));

            /* Get occassions data */
            $occassions = DB::table('occassions')
                                ->join('items_occassions', 'items_occassions.occassion_id','=','occassions.id')
                                ->select('occassions.name')
                                ->where('item_id', $id)
                                ->get();
            $occassion_names = implode(', ', array_map(function($c) {
                return $c->name;
            }, $occassions));

            /* Get comments data */
            $comments = DB::table('comments')
                                ->join('users', 'users.id', '=', 'comments.user_id')
                                ->select('comments.*',
                                    'users.id as comment_user_id',
                                    'users.username as comments_username')
                                ->where('item_id', $id)
                                ->get();

            $item->categories = $category_names;

            $item->occassions = $occassion_names;

            $item->comments = $comments;      

            $returnData['isSuccess'] = true;
            $returnData['item'] = $item;
            return $returnData;
        }

        catch(Exception $e){
            Log::info(__CLASS__."::".__METHOD__."::"."Exception inserting item".$e->message());
            $returnData['isSuccess'] = false;
            $returnData['message'] = 'Failed to get item $id. Please try again.';
            return $returnData;            
        }

    }
}