<?php 
if (!function_exists('sidebar_open')) {
    function sidebar_open($routes = []) {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }
        return $open ? 'active' : '';
    }
}

function dateDifferenceFromNow($startdate)
{
    $datetime1 = strtotime($startdate);
    $datetime2 = strtotime(date('Y-m-d'));
    $totaldays = (int)(($datetime2 - $datetime1)/86400);
    $year = (int)($totaldays/365);
    return $year.' Year ';
}

function sendMail($data,$template,$to,$subject){
    $newMail = new \App\Models\EmailLog();
    $newMail->from = 'onenesstechsolution@gmail.com';
    $newMail->to = $to;
    $newMail->subject = $subject;
    $newMail->view_file = $template;
    $newMail->payload = json_encode($data);
    $newMail->save();
    
   /* Mail::send($template, $data, function($message)use ($data,$to,$subject) {
        $message->to($to, $data['name'])->subject($subject);
        $message->from('onenesstechsolution@gmail.com','Mentorly');
    });*/
}

if (!function_exists('imageResizeAndSave')) {
    function imageResizeAndSave($imageUrl, $type = 'categories', $filename)
    {
        if (!empty($imageUrl)) {
                                                    
            //save 60x60 image
            \Storage::disk('public')->makeDirectory($type.'/60x60');
            $path60X60     = storage_path('app/public/'.$type.'/60x60/'.$filename);
            $canvas = \Image::canvas(60, 60);
            $image = \Image::make($imageUrl)->resize(60, 60,
                    function($constraint) {
                        $constraint->aspectRatio();
                    });
            $canvas->insert($image, 'center');
            $canvas->save($path60X60, 70); 
            
            //save 350X350 image
            \Storage::disk('public')->makeDirectory($type.'/350x350');
            $path350X350     = storage_path('app/public/'.$type.'/350x350/'.$filename);
            $canvas = \Image::canvas(350, 350);        
            $image = \Image::make($imageUrl)->resize(350, 350,
                    function($constraint) {
                        $constraint->aspectRatio();
                    });
            $canvas->insert($image, 'center');
            $canvas->save($path350X350, 75);

            return $filename;
        } else { return false; }
    }
}

    function get_guard()
    {
        if(Auth::guard('admin')->check()){
            return 'admin';
        }elseif(Auth::guard('web')->check()){
            return 'web';
        }elseif(Auth::guard('mentor')->check()){
            return 'mentor';
        }else{
            return '';
        }
    }

    function emptyCheck($string)
    {
        return !empty($string) ? $string : '';
    }

    function uniqueString()
    {
        return uniqid().''.date('ymdhis').''.uniqid();
    }

    function randomPassword()
    {
        return str_random(8);
    }

    function avgRatingOfMentors($reviews){
        $array = [];
        foreach($reviews as $review){
            array_push($array, $review->rating);
        }
        if(count($array) == 0){
            return 0;
        }else{
            return array_sum($array)/count($array);
        }
    }

    function removeDollerSign($string)
    {
        $newString = '';
        for($i=0;$i<strlen($string); $i++){
            if($string[$i] != '$'){
                $newString .= $string[$i];
            }
        }
        return $newString;
    }