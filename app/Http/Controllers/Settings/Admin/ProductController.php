<?php
namespace App\Http\Controllers\Settings\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Rules\TransparentImageBackground;

class ProductController extends Controller
{
    public function index() {
        return view('admin.product.main', ['products' => Product::orderBy('id', 'desc')->paginate(5)]);
    }

    public function create(Request $request)
    {
        $rules = [
            'main_text' => 'required|min:5|max:60',
            'secondary_text' => 'min:10|max:120',
            'price' => 'required',
            'image' => ['required','file','max:2048','mimes:png', new TransparentImageBackground('image')]
        ];

        $request->validate($rules);

        $filename =  md5(uniqid(time())) . '.'. $request->file('image')->getClientOriginalExtension();

        $product = Product::create([
            'main_text' => $request->main_text,
            'secondary_text' => $request->secondary_text,
            'price' => $request->price,
            'image' => $filename
        ]);

        if($product->id){
            Product::where('main_product', 1)->update(['main_product' => 0]);
            $product->main_product = 1;
            $product->save();
            $image_path = 'product/'.$product->id.'/media/';

            $request->file('image')->storeAs($image_path, $product->image, 'public');
            return redirect()->route('product.index', ['success' => 'The product was succefully created', 'products' => Product::paginate(10)]);
        }

        return redirect()->route('product.index', ['error' => 'The product could not be created']);
    }

    public function update(Request $request, $product_id, $status = null)
    {
        $product = Product::where('id', $product_id);

        if($status === 'set_main'){

            Product::where('main_product', 1)->update(['main_product' => 0]);
            $product->update(['main_product' => 1]);
            return redirect()->route('product.index');
        }

        else if($status === 'updating')
        {

            return view('admin.product.main', ['products' => Product::orderBy('id', 'desc')->paginate(5), 'updating_product' => $product->first()]);
        }

        else
        {
            $rules = [
                'main_text' => 'required|min:5|max:60',
                'secondary_text' => 'min:10|max:120',
                'price' => 'required',
                'image' => !$request->file_label ? ['required','file','max:2048','mimes:png', new TransparentImageBackground('image')] : '',
            ];

            $request->validate($rules);

            $filename =  !$request->file_label ? md5(uniqid(time())) . '.'. $request->file('image')->getClientOriginalExtension() : $request->file_label;

            $product_update = $product->update([
                'main_text' => $request->main_text,
                'secondary_text' => $request->secondary_text,
                'price' => $request->price,
                'image' => !$request->file_label ? $filename : $request->file_label
            ]);

            if(!$request->file_label){
                if($product_update === 1){
                    $product = Product::where('id', $product_id)->first();
                    $image_path = 'public/product/'.$product_id.'/media/';
                    Storage::deleteDirectory($image_path);
                    Storage::putFileAs($image_path, $request->file('image'), $product->image);
                    return redirect()->route('product.index', ['success' => 'The product was succefully updated', 'products' => Product::paginate(5)]);
                }
            }
            return redirect()->route('product.index', ['success' => 'The product was succefully updated', 'products' => Product::paginate(5)]);
        }


    }

    public function delete(Request $request, $product_id)
    {
        $product = Product::where('id', $product_id);
        if($product->delete())
        {
            $image_path = 'public/product/'.$product_id;
            Storage::deleteDirectory($image_path);
            return redirect()->route('product.index', ['success' => 'The product was successfully deleted']);
        }
        return redirect()->route('product.index', ['error' => 'The product could not be removed from our database']);
    }

    public function getThumbnail(Request $request, $id, $img = null)
    {
        $path = 'public/product/'.$id.'/media/'.$img;
        $url = Storage::get($path);
        return Response::make($url, 200, ['Content-Type' => 'image'])->setMaxAge(864000)->setPublic();
    }
}
