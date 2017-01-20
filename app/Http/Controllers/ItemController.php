<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ItemRequest;

use App\Model\Categories;
use App\Model\Occassions;
use App\Model\Items;

use App\User;

use Auth;
use Flash;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $occassions = Occassions::get();
        $categories = Categories::get();

        $items = Items::paginate(9);
        return view('items/index', [
            'categories' => $categories,
            'occassions' => $occassions,
            'items' => $items,
            'request' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $occassions = Occassions::get();
        $categories = Categories::get();
        //var_dump($categories);
        return view('items/create', [
            'categories' => $categories,
            'occassions' => $occassions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        /* Accept input data */
        $item_raw = $request->all();

        /* Massage data */
        $item = array();
        $item['title'] = $item_raw['title'];
        $item['description'] = $item_raw['description'];
        $item['image_path'] = $item_raw['image_path'];
        $item['is_active'] = 1;
        $item['max_price'] = 0;
        $logged_in_user = Auth::id();
        $item['user_id'] = $logged_in_user;

        $item['categories'] = array();
        $item['occassions'] = array();

        foreach($item_raw['categories_list'] as $cat){
            array_push($item['categories'], intval($cat));
        }

        foreach($item_raw['occassions_list'] as $occ){
            array_push($item['occassions'], intval($occ));
        }

        /* Save data in model */
        $itemModel = new Items();
        $savedData = $itemModel->insertItems($item);
        $id = $savedData['itemId'];

        /* Return to the view */
        if($savedData['isSuccess'] === true) {
            Flash::overlay($savedData['message']);
        }
        else {
            Flash::overlay($savedData['message']);
        }

        return redirect()->route('item.show', ['item' => $savedData['itemId']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemModel = new Items();
        $itemData = $itemModel->getItemById($id);

        if(!$itemData['isSuccess']){
            abort(404);
        }

        //var_dump($itemData['item']);
        return view('items/show', [
            'item' => $itemData['item']
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
