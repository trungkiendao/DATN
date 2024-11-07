<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        
        if ($request->isMethod('post'))  {
            $id = $request->input('id');
           
            $image = $request->input('image');
            $name = $request->input('name');
            $price = $request->input('price');
            $description = $request->input('description');
            $quantity = $request->input('quantity',1);
            
            
            
            
            // Tính tổng tiền
            $total = $price * $quantity;
    
            // Lấy giỏ hàng từ session, nếu chưa có thì khởi tạo mảng rỗng
            $cart = session()->get('cart', []);
           
            
            $ktr = false; // Biến kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    
            // Kiểm tra sản phẩm đã có trong giỏ hàng
            foreach ($cart as $i => $item) {
               
                if ($item['id'] == $id) {
                    $newQuanTity = $quantity + $item['quantity']; // Cập nhật số lượng mới
                    $cart[$i]['quantity'] = $newQuanTity; // Cập nhật lại số lượng trong giỏ hàng
                    $ktr = true; // Đã tìm thấy sản phẩm
                    break;
                }
            }
    
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới
            if (!$ktr) {
                $spadd = [
                    'id' => $id,
                    'image' => $image,
                    'name' => $name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'description' => $description
                ];
                $cart[] = $spadd;
            }
    
            // Lưu giỏ hàng vào session
            session()->put('cart', $cart);
        }
        else{
            echo("Khong co request");
        }
        return view('client.addCart');
    }
   
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Cập nhật số lượng cho sản phẩm trong giỏ hàng
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        // Tính tổng giá trị giỏ hàng
        $total = 0;
        foreach ($cart as $product) {
            $total += $product['quantity'] * $product['price'];
        }

        // Trả về tổng mới để cập nhật giao diện
        return response()->json(['total' => $total]);
    }

    // Hàm để hiển thị trang checkout
    public function checkout()
    {
       
        return view('client.checkout');
    }
}
