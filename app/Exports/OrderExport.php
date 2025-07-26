<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        $orders = Order::all();

        foreach ($orders as &$order) {
            $order->user = $order->user()->value('name');

            $order->product = $this->getOrderProducts($order);

            $order->address = $order->shippingAddress->address;
            $order->phone = $order->shippingAddress->phone;
            $order->building_number = $order->shippingAddress->building_number;
            $order->flot_number = $order->shippingAddress->flot_number;
            $order->city = $order->shippingAddress->city;
            $order->post_code = $order->shippingAddress->post_code;

            $order->status = $this->getStatus($order->status);

            unset($order->updated_at);
            unset($order->payment_method);
            unset($order->transaction_id);
            unset($order->shipping_address_id);
            unset($order->user_id);
        }

        return $orders;
            
    }

    public function headings(): array
    {
        return [
            '#',
            'Order Number',
            'Price',
            'Total Price',
            'Status',
            'Shipping Cost',
            'Tax',
            'Discount',
            'Payment Type',
            'Currency',
            'Date',
            'User',
            'Products',
            'Address',
            'Phone',
            'Building Number',
            'Flot Number',
            'City',
            'Post Code',
        ];
    }

    private function getOrderProducts($order)
    {
        $orderProducts = $order->products()->pluck('name_en as name');
        $products = [];

        foreach ($orderProducts as $productName) {
            array_push($products, $productName);
        }

        if (count($products) > 1) {
            $products = implode(',', $products);
        } else {
            $products = implode('', $products);
        }

        return $products;
    }

    private function getStatus($status)
    {
        if ($status == 0) {
            return 'pending';
        } elseif ($status == 1) {
            return 'proccess';
        } elseif ($status == 2) {
            return 'shipped';
        } elseif ($status == 3) {
            return 'deliveried';
        } else {
            return 'canceled';
        }
    }
}