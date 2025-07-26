<?php

if( !function_exists('adminurl') ){
    function adminurl(){
        return auth()->guard('admin')->user();
    }
}


if( !function_exists('calcProductPriceAfterDiscount') ) {
    function calcProductPriceAfterDiscount($discountPercentage, $price) {
        return $price - (($discountPercentage * $price) / 100 );
    }
}


if( !function_exists('successMessage') ){
    function successMessage($message){
        session()->flash('success',$message);
    }
}

if( !function_exists('errorMessage') ){
    function errorMessage($message){
        session()->flash('error',$message);
    }
}

if( !function_exists('infoMessage') ){
    function infoMessage($message){
        session()->flash('info',$message);
    }
}

if(! function_exists('getNewProductEmailContent')) {
    function getNewProductEmailContent($lang): array 
    {
        if ($lang == 'fr') {
            return array(
                'email_header' => 'Nouveau produit ajouté !',
                'dear' => 'Chère',
                'email_description1' => "Nous sommes ravis de vous informer qu'un nouveau produit a été ajouté à notre collection :",
                'email_description2' => "Pour afficher plus de détails sur ce produit, ouvrez l'application :",
                'thank_you' => 'Merci!',
                'description' => 'description',
                'product_name' => 'nom du produit',
                'price' => 'prix',
            );
        } else {
            return array(
                'email_header' => 'تمت إضافة منتج جديد!',
                'dear' => 'عزيزي',
                'email_description1' => 'يسعدنا أن نعلمكم أنه تمت إضافة منتج جديد إلى مجموعتنا:',
                'email_description2' => 'لعرض المزيد من التفاصيل حول هذا المنتج، افتح التطبيق:',
                'thank_you' => 'شكرًا لك!',
                'description' => 'الوصف',
                'product_name' => 'اسم المنتج',
                'price' => 'السعر',
            );
        }
    }
}


if(! function_exists('getBeforeDeleteProductContent')) {
    function getBeforeDeleteProductContent($lang, $daysNumber, $productNameAr, $productNameFr): array 
    {
        if ($lang == 'fr') {
            return array(
                'title' => 'Le produit sera alors supprimé ' . $daysNumber . ' jours.',
                'message' => 'Le produit sera supprimé: ' . $productNameFr . ' après ' . $daysNumber . ' jours.',
            );
        } else {
            return array(
                'title' => 'سوف يتم حذف المنتج بعد '  . $daysNumber . ' ايام.',
                'message' => 'سوف يتم حذف المنتج: ' . $productNameAr . ' بعد ' . $daysNumber . ' ايام.',
            );
        }
    }
}

if(! function_exists('getAfterDeleteProductContent')) {
    function getAfterDeleteProductContent($lang, $productNameAr, $productNameFr): array 
    {
        if ($lang == 'fr') {
            return array(
                'title' => 'Le produit a été supprimé.',
                'message' => 'Le produit a été supprimé: ' . $productNameFr,
            );
        } else {
            return array(
                'title' => 'تم حذف المنتج.',
                'message' => 'تم حذف المنتج: ' . $productNameAr,
            );
        }
    }
}


if( !function_exists('sendNotificationToMobile') ) {

    function sendNotificationToMobile($token = null, $title = null, $body = null){
        
        $SERVER_API_KEY = env("FIREBASE_SERVER_API_KEY");

            $data = [

                "registration_ids" => [
                    $token
                ],

                "notification" => [

                    "title" => $title,

                    "body" => $body,

                    "sound"=> "default" // required for sound on ios

                ],

            ];

            $dataString = json_encode($data);

            $headers = [

                'Authorization: key=' . $SERVER_API_KEY,

                'Content-Type: application/json',

            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
    }
}