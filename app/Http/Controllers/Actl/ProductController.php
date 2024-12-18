<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Family;
use App\Models\TaxRate;
use App\Models\UnitMeasure;

use Auth;
use Illuminate\Support\Carbon;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    public function ProductAll()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    public function ProductAdd()
    {
        $families = Family::all();
        $unitMeasures = UnitMeasure::latest()->get();
        $taxRates = TaxRate::latest()->get();
<<<<<<< HEAD

        return view('backend.product.product_add', compact('families', 'unitMeasures', 'taxRates'));
=======

>>>>>>> 4ad9b74aa8af4abfc993c5fb0173e513015902f0
    }

    public function ProductStore(Request $request)
    {
        // 'extension=gd' must be uncommented in php.ini file
        if ($request->file('profile_image')) {
            $manager = new ImageManager(new Driver());
            $transformName = hexdec(uniqid()) . "." . $request->file('profile_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('profile_image'));
            $img->resize(200, 200);
            $img->toJpeg(80)->save(base_path('public/backend/assets/images/product/' . $transformName));
            $save_url = '/backend/assets/images/product/' . $transformName;
        }

        try {
            Product::insert([
                'code' => $request->code,
                'description' => $request->description,
                'family' => $request->product_family,
                'unit' => $request->product_unit,
                'taxRateCode' => $request->taxRateCode_Product,
                'image' => $save_url,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Product Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('product.all')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Product Added Failed',
                'alert-type' => 'error'
            );
            if (file_exists($save_url)) {
                unlink($save_url);
            }
            return redirect()->route('product.all')->with($notification);
        }
    }

    public function ProductEdit($id)
    {
        $families = Family::all();
        $unitMeasures = UnitMeasure::all();
        $taxRates = TaxRate::all();

        $product = Product::findOrFail($id);

        return view('backend.product.product_edit', compact('families', 'unitMeasures', 'taxRates', 'product'));
    }

    public function ProductUpdate(Request $request)
    {
        $product_id = $request->id;

        $product = Product::findOrFail($product_id);
        $oldImagePath = base_path('public' . $product->image); // Convert to full path

        if ($request->file('profile_image')) {
            // image manager for intervention image
            $manager = new ImageManager(new Driver());
            // unique name for image
            $transformName = hexdec(uniqid()) . "." . $request->file('profile_image')->getClientOriginalExtension();
            // read and save image
            $img = $manager->read($request->file('profile_image'));
            $img->resize(200, 200);
            $newImagePath = base_path('public/backend/assets/images/product/' . $transformName);
            $img->toJpeg(80)->save($newImagePath);

            $save_url = '/backend/assets/images/product/' . $transformName;
        }

        try {
            if ($request->file('profile_image')) {
                // Atualiza o produto com a nova imagem
                Product::findOrFail($product_id)->update([
                    'code' => $request->code,
                    'description' => $request->description,
                    'family' => $request->product_family,
                    'unit' => $request->product_unit,
                    'taxRateCode' => $request->taxRateCode_Product,
                    'image' => $save_url,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                ]);

                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $notification = array(
                    'message' => 'Product Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('product.all')->with($notification);
            } else {
                // Atualiza o produto sem a nova imagem
                Product::findOrFail($product_id)->update([
                    'code' => $request->code,
                    'description' => $request->description,
                    'family' => $request->product_family,
                    'unit' => $request->product_unit,
                    'taxRateCode' => $request->taxRateCode_Product,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                ]);

                $notification = array(
                    'message' => 'Product Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('product.all')->with($notification);
            }
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Product Update Failed.' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('product.all')->with($notification);
        }
    }

    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        $imagePath = base_path('public' . $product->image); // Convert to full path

        try {
            $product->delete();
            // verfica se a imagem existe e remove
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $notification = array(
                'message' => 'Product Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Product Delete Failed.' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
