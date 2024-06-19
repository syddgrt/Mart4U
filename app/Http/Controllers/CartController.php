<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $from = $request->validate([
            'from' => 'required'
        ]);

        if ($from['from'] == "cart"){

            $item_count_array = $request->session()->get('items_in_cart');
            // var_dump($item_count_array);
            $data = array();

            if($item_count_array != NULL)
            {
                for( $i = 0; $i < sizeof($item_count_array[0]); $i++)
                {
                    $item = $request->session()->get('item_id_' . $item_count_array[0][$i]);
                    // print($item_count_array[0][$i] . "yow ");
                    // var_dump($item_count_array[0][$i]);
                    // var_dump($item);
                    // var_dump($item['item_quantity']);
                    // var_dump($item_quantity['item_quantity'] . "yow ");
                    // $item_count_array[0][$i]['item_quantity'] = $item_quantity['item_quantity'];
                    // var_dump($item_quantity);
                    $detail_item = Listing::find($item_count_array[0][$i]);
                    $detail_item['stock_quantity'] = $item['item_quantity'];
                    // var_dump($item_quantity);
                    array_push($data, $detail_item);
                    // $data += Listing::find($item_count_array[0][$i]);
                }
            }
            // $data = Listing::find($item_count_array[0][0]);
            return $data;
        }
        else {
            return "no";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'item_id' => 'required',
            'item_quantity' => 'required',
        ]);

        // If specific item is ALREADY in cart (in php session)             |   session => [ item_id_{{int}} ]
        // THIS FOR TO GET ITEM DETAIL IN CART (ITEM_ID & ITEM_QUANTITY)
        if ($request->session()->has('item_id_' . $formFields['item_id']))
        {
            // Get SPECIFIC item detail that stored in php session
            $value_before = $request->session()->get('item_id_' . $formFields['item_id']);

            // Remove SPECIFIC item detail that stored in php session
            $request->session()->remove('item_id_' . $formFields['item_id']);

            // Add/Update quantity of the specific item in cart
            $formFields['item_quantity'] += $value_before['item_quantity'];

            // Store back the item detail in php session
            $request->session()->put('item_id_' . $formFields['item_id'], $formFields);

            // Ni sajo nk test baco smula
            $value_after = $request->session()->get('item_id_' . $formFields['item_id']);

            return $value_after;
        }
        else
        {
            // If specific item is NOT ALREADY in cart (in php session)     |   session => [ item_id_{{int}} ]
            // Store it
            $request->session()->put('item_id_' . $formFields['item_id'], $formFields);

            // --------------------------------------------------------
            // --------------------------------------------------------
            // --------------------------------------------------------
            // FOR USE IN SESSION [ items_in_cart ]
            // Get items in cart to STORE IN session => [ items_in_cart ]
            $item_count_array = $request->session()->get('items_in_cart');
            
            // If selected item NOT ALREADY in cart
            if($item_count_array == NULL)
            {
                $empty_array = array(
                    array($formFields['item_id'])
                );

                // Store item in cart session (in php session)              | session => [ items_in_cart ]
                $request->session()->put('items_in_cart', $empty_array);
            }
            else
            {
                // If selected item is ALREADY in cart
                $val = $formFields['item_id'];
                // Check whether the item id is already exist,
                // If NOT EXIST YET IN SESSION [ item_in_cart ]
                if (!in_array($val, $item_count_array[0]))
                {
                    // Store it in SESSION [ item_in_cart ]
                    array_push($item_count_array[0], $formFields['item_id']);
                    $request->session()->put('items_in_cart', $item_count_array);
                }
            }

            return $formFields;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('listings.index', [
        //     'listings' => Listing::latest()->paginate(8),
        // ]);
        return redirect('/');
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
    public function destroy($id, Request $request)
    {
        // Remove session in item_id_{{}}
        $request->session()->remove('item_id_' . $id);

        // Read array from session items_in_cart
        $arrayOfArray = $request->session()->get('items_in_cart');

        // Get the index array of the value equal to the id that want to be deleted from the list of array
        $array_index = array_search($id, $arrayOfArray[0]);

        // Delete the array that hold value of id based on index
        unset($arrayOfArray[0][$array_index]);

        // Reset back the array index starting from zero [0]
        $resetedIndexArray = array_merge($arrayOfArray[0]);

        // Remove session in items_in_cart
        $request->session()->remove('items_in_cart');
        
        // Store item in cart session (in php session)              | session => [ items_in_cart ]
        $request->session()->put('items_in_cart', array($resetedIndexArray));
        
        return true;
    }
}
