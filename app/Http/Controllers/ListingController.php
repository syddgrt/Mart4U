<?php

namespace App\Http\Controllers;


use App\Models\Listing;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    // Show All Lisitings
    public function index() // return home page frontend file to the user
    {

        $announcements = Announcement::all();

        return view('listings.index', [
            'announcements' => $announcements,
            'listings' => Listing::latest()->filter(request(['search']))->paginate(8), // Paginatian purpose
        ]);
    }

    public function index2() // return admin page fronted file to the user
    {
        return view('admin.layout.auth.stock', [
            'listings' => Listing::latest()->filter(request(['search']))->paginate(8),
            'x' => 1,
        ]);
    }

    public function create() // return creating stock form frontend file to the user
    {
        return view('listings.create');
    }

    public function store(Request $request){ // store the stock information into the database
        $formFields = $request->validate([ // validation
            'stock_name' => 'required',
            'tags' => 'required',
            'stock_price' => 'required',
            'stock_quantity' => 'required',
            'stock_description' => 'required',
        ]);

        

        if ($request->hasFile('stock_image')) {
            $formFields['stock_image'] = $request->file('stock_image')->store('images', 'public'); // store image
        }

        Listing::create($formFields); // create the stock in the database

        return redirect('/stock')->with('message', 'Listing Created Successfully'); // redirect to "/stock" page with a message 
    }

    public function edit(Listing $listing) // return stock edit form frontend file to the user
    {
        return view('admin.layout.auth.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing){ // update the stock information
        $formFields = $request->validate([
            'stock_name' => 'required',
            'tags' => 'required',
            'stock_price' => 'required',
            'stock_quantity' => 'required',
            'stock_description' => 'required',
        ]);
        if ($request->hasFile('stock_image')) {
            $formFields['stock_image'] = $request->file('stock_image')->store('images', 'public');
        }
        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    public function destroy(Listing $listing) // delete the stock
    {

        $listing->delete();
        return redirect('/stock')->with('message', 'Listing delete successfully');
    }

    public function show($id)
    {
        // var_dump(explode(', ', Listing::find($id)->tags));
        return view('listings.item-detail', ['product' => Listing::find($id)]);
    }
}
