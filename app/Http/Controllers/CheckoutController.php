<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Purchase;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseConfirmationEmail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $announcements = Announcement::all();

        $item_count_array = $request->session()->get('items_in_cart');
        // var_dump(sizeof($item_count_array[0]));
        $list_of_items_detail = array();

        if ($item_count_array != null)
        {
            foreach($item_count_array[0] as $item)
            {
                // print($item . ",");
                
                $item_unit = $request->session()->get('item_id_' . $item);
                // var_dump($item_unit['item_quantity']);
                
                $item_detail = Listing::find($item);
                array_push($list_of_items_detail, array(
                    'product_id' => $item_detail->stock_id,
                    'product_image' => $item_detail->stock_image,
                    'product_name' => $item_detail->stock_name,
                    'product_description' => $item_detail->stock_description,
                    'product_price' => $item_detail->stock_price,
                    'product_quantity' => $item_detail->stock_quantity,
                    'product_checkout_quantity' => $item_unit['item_quantity'],
                ));
    
                // var_dump($item_detail);
                // print("<br>");
            }
        }
        // var_dump($list_of_items_detail);

        return view('listings.checkout', ['announcements' => $announcements, 'products' => $list_of_items_detail]);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|digits_between:7,11',
            'email' => 'required|email',
            'address1' => 'required',
            'address2' => 'nullable',
            'zip' => 'required|digits_between:5,5',
            'payment_method' => 'required',
        ]);

        // Append country code to the phone
        $formFields['phone'] = '+60' . $formFields['phone'];

        // Set default state & country
        $formFields += ['state' => 'penang', 'country' => 'malaysia'];

        // Get checkout items
        $item_count_array = $request->session()->get('items_in_cart');
        $stock_quantity = '';
        $stock_price = '';
        $total_payment = 0;
        $product_status = array();
        $items_to_be_send_via_email = array();

        for( $i = 0; $i < sizeof($item_count_array[0]); $i++)
        {
            $item = $request->session()->get('item_id_' . $item_count_array[0][$i]);
            
            $detail_item = Listing::find($item_count_array[0][$i]);
            $detail_item['stock_quantity'] = $item['item_quantity'];
            
            $stock_quantity = $stock_quantity . $item['item_id'] . ':' . $item['item_quantity'];
            
            // Read checkout item
            $checkout_item = Listing::find($item['item_id']);

            $checkout_item_quantity_available = $checkout_item->stock_quantity;
            $checkout_item_price = $checkout_item->stock_price;

            $stock_price = $stock_price . $item['item_id'] . ':' . $checkout_item_price;
            $total_payment += $checkout_item_price * $item['item_quantity'];

            if($checkout_item_quantity_available < $item['item_quantity'])
            {
                array_push($product_status, [
                    'stock_id' => $item['item_id'],
                    'error' => 'Insufficient quantity'
                ]);
            }

            if($i != sizeof($item_count_array[0]) - 1)
            {
                $stock_quantity .= ', ';
                $stock_price .= ', ';
            }

            array_push($items_to_be_send_via_email, array(
                'name' => $checkout_item->stock_name,
                'price' => $checkout_item_price,
                'quantity' => $item['item_quantity'],
                'total_price' => $checkout_item_price * $item['item_quantity'],
            ));
        }

        // Append items in form of productId:productQuantity    23:2, 1:4
        $formFields += ['items' => $stock_quantity];    //------------------------------------
        $formFields += ['price_each_item' => $stock_price];    //------------------------------------
        $formFields += ['total_price' => $total_payment];    //------------------------------------
        
        
        if(empty($product_status))
        {

            $item_count_array = $request->session()->get('items_in_cart');
            for( $i = 0; $i < sizeof($item_count_array[0]); $i++)
            {
                $item = $request->session()->get('item_id_' . $item_count_array[0][$i]);

                // Remove session in item_id_{{}}
                $request->session()->remove('item_id_' . $item_count_array[0][$i]);

                $item_in_stock = Listing::findOrFail($item_count_array[0][$i]);
                $item_in_stock->stock_quantity -= $item['item_quantity'];
                $item_in_stock->save();
            }

            $newData = array(
                'buyer' => array(
                    'name' => $formFields['first_name'] . ' ' . $formFields['last_name'],
                    'address1' => $formFields['address1'],
                    'address2' => $formFields['address2'],
                    'zip' => $formFields['zip'],
                    'phone' => $formFields['phone'],
                    'email' => $formFields['email'],
                    'date' => date("d/m/Y"),
                    'payment_method' => ucfirst($formFields['payment_method']),
                    'payment_id' => Purchase::count() + 1,
                ),
            );

            // $display_once1 = $newData;
            // $display_once2 = $items_to_be_send_via_email;
            $newData += ['items' => $items_to_be_send_via_email];

            // Remove session in items_in_cart
            $request->session()->remove('items_in_cart');

            // Send Email to buyer
            Mail::to($formFields['email'])->send(new PurchaseConfirmationEmail($newData));    //---------------------
            
            // Store purchase detail in DB
            Purchase::create($formFields);  //----------------------
            
            return redirect('/')->with('success', 'Your purchase is success, please check your email');  //-------------------------
            // return view('mail.purchase', ['buyer' => $display_once1, 'items' => $display_once2]);  //-------------------------
            // dd($newData);
            // dd($formFields);
        }
        else
        {
            $ct = 0;
            foreach($product_status as $insufficient_product_status)
            {
                $product_name = Listing::find($insufficient_product_status['stock_id'])->stock_name;
                $product_status[$ct]  += ['stock_name' => $product_name];
                $ct++;
            }

            return redirect('/')->with('unsuccess', $product_status);
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
        //
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
