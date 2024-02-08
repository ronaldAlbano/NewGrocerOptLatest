<?php

include('../config/function.php');

if(!isset($_SESSION['productItems'])){
    $_SESSION['productItems'] = [];
}

if(!isset($_SESSION['productItemIds'])){
    $_SESSION['productItemIds'] = [];
}

if(isset($_POST['addItem']))
{
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
    if($checkProduct){
        if(mysqli_num_rows($checkProduct) > 0){

            $row = mysqli_fetch_assoc($checkProduct);
            if($row['quantity'] < $quantity){
                redirect('order-create.php','Only' .$row['quantity']. 'quantity available!');
            }

            $productData = [
                'product_id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'price' => $row['price'],
                'quantity' => $quantity,
            ];

            if(!in_array($row['id'], $_SESSION['productItemIds'])){

                array_push($_SESSION['productItemIds'],$row['id']);
                array_push($_SESSION['productItems'],$productData);

            }else{

                foreach($_SESSION['productItems'] as $key => $prodSessionItem){
                    if($prodSessionItem['product_id'] == $row['id']){

                        $newQuantity = $prodSessionItem['quantity'] + $quantity;

                        $productData = [
                            'product_id' => $row['id'],
                            'name' => $row['name'],
                            'image' => row['image'],
                            'price' => row['price'],
                            'quantity' => $newQuantity,
                        ];
                        $_SESSION['productItems'][$key] = $productData;

                    }
                }

            }

            redirect('order-create.php', 'Item Added '.$row['name']);

        }else{
            redirect('order-create.php', 'No such product found!');
        }

    }else{
        redirect('order-create.php','Something Went Wrong!');
    }
}

if(isset($_POST['productIncDec']))
{
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $flag = false;
    foreach ($_SESSION['productItems'] as $key => $item){
        if($item['product_id'] == $productId){
            
            $flag = true;
            $_SESSION['productItems'][$key]['quantity'] = $quantity;

        }
    }

    if($flag){

        jsonResponse(200, 'success', 'Quantity Updated');
    }else{

        jsonResponse(500, 'error', 'Something Went Wrong. Please refresh');
    }
}

if(isset($_POST['proceedToPlaceBtn'])) {
    $_SESSION['invoice_no'] = "INV-" . time(); // Set invoice number to timestamp
    jsonResponse(200, 'success', 'Proceed BTN SUCCESS!');
}



if(isset($_POST['saveOrder']))
{
    $invoice_no = validate($_SESSION['invoice_no']);
    $order_placed_by_id = $_SESSION['loggedInUser']['user_id'];

    if(!isset($_SESSION['productItems'])){
        jsonResponse(404,'warning', 'No Items to place order!');
    }

    $sessionProducts = $_SESSION['productItems'];

    $totalAmount = 0;
    foreach($sessionProducts as $amtItem){
        $totalAmount += $amtItem['price'] * $amtItem['quantity'];
    }
    
    $data = [
        'invoice_no' => $invoice_no,
        'total_amount' => $totalAmount,
        'order_date' => date('Y-m-d'),
        'order_placed_by_id' => $order_placed_by_id
    ];
    $result = insert('orders',$data);

    $lastOrderId = mysqli_insert_id($conn);

    foreach($sessionProducts as $prodItem){

        $productId = $prodItem['product_id'];
        $price = $prodItem['price'];
        $quantity = $prodItem['quantity'];
        

        // Inserting order items

        $dataOrderItem = [
            'order_id' => $lastOrderId,
            'product_id' => $productId,
            'price' => $price,
            'quantity' => $quantity,
        ];
        $orderItemQuery = insert('order_items', $dataOrderItem);

        // Checking for the books quantity and decreasing quantity and making total Quantity
        $checkProductQuantityQuery = mysqli_query($conn, "SELECT *FROM products WHERE id='$productId'");
        $productQtyData = mysqli_fetch_assoc($checkProductQuantityQuery);
        $totalProductQuantity = $productQtyData['quantity'] - $quantity;

        $dataUpdate = [
            'quantity' => $totalProductQuantity
        ];
        $updateProductQty = update('products', $productId, $dataUpdate);
    }

    unset($_SESSION['productItemIds']);
    unset($_SESSION['productItems']);
    unset($_SESSION['invoice_no']);

    jsonResponse(200, 'success', 'Order Placed Successfully');

}



?>