<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Barangkeluar;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrgkeluarController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $brg = Barangkeluar::latest()->when(request()->q, function($brg) {
            $brg = $brg->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('admin.barangkeluar.index', compact('brg'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $barang = Product::latest()->get();
        return view('admin.barangkeluar.create', compact('categories','barang'));
    }   
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
       $this->validate($request, [
           
           'title'          => 'required|unique:products',
           'unit'           => 'required',
           'price'          => 'required',
       ]); 

       //save to DB
       $product = Product::create([
           'title'          => $request->title,
           'unit'           => $request->unit,
           'price'          => $request->price,
       ]);

       if($product){
            //redirect dengan pesan sukses
            return redirect()->route('admin.barangkeluar.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.barangkeluar.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    
        
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */

     
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image = Storage::disk('local')->delete('public/products/'.$product->image);
        $product->delete();

        if($product){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}