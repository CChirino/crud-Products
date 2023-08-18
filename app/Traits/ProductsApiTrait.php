<?php

namespace App\Traits;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

trait ProductsApiTrait {

    /**
     * Write code on Method
     *
     * @return response()
     */

     public function sendResponse($result, $message)
     {
         $response = [
             'success' => true,
             'data'    => $result,
             'message' => $message,
         ];
 
         return response()->json($response, 200);
 
     }
 
     /**
      * return error response.
      *
      * @return \Illuminate\Http\Response 
      */
 
     public function sendError($error, $errorMessages = [], $code = 404)
     {
         $response = [
             'success' => false,
             'message' => $error,
         ];
 
         if(!empty($errorMessages)){
             $response['data'] = $errorMessages;
         }
 
 
         return response()->json($response, $code);
 
     }

     public function indexProducts(): JsonResponse

     {
 
         $products = Product::all();
 
         return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
 
     }

     public function storeProduct(Request $request): JsonResponse

     {
 
         $fields = $request->all();
 
    
 
         $validator = Validator::make($fields, [
             'name' => 'required',
             'price' => 'required'
         ]);
 
         if($validator->fails()){
             return $this->sendError('Validation Error.', $validator->errors());       
 
         }
 
         $product = Product::create($fields);
         return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
 
     } 

     public function showProduct($id): JsonResponse

     {
 
         $product = Product::find($id);
 
         if (is_null($product)) {
 
             return $this->sendError('Product not found.');
         }

         return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
 
     }

     public function updateProduct(Request $request,Product $product): JsonResponse

     {
         $fields = $request->all();
         $validator = Validator::make($fields, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

         $product->name = $fields['name'];
         $product->price = $fields['price'];
         $product->save();
 
         return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
 
     }


     public function destroyProduct($id): JsonResponse
     {
          $product = Product::find($id);
 
         if (is_null($product)) {
 
             return $this->sendError('Product not found.');
         }
         $product->delete();

         return $this->sendResponse([], 'Product deleted successfully.');
 
     }
     
 
 }


    

