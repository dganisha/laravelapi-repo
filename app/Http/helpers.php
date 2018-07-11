<?php

if (! function_exists('get_price')) {
    function get_price($prices, $type)
    {
        return $prices->first(function($item) use($type){
                return $item->calendar_type == $type;
            })->adult_price;
    }
}

function icon_service($service){
    if($service=='car'){
        return 'cardriver';
    }elseif($service=='fnb'){
        return 'foodbeverage';
    }else{
        return 'activityleisure';
    }
}

function getRupiah($value) {
        $format = "Rp. " . number_format($value,2,',','.');
        return $format;
}

function balikKata($string) {
    $result = '';
    $panjang = strlen($string);
    for($i = 1; $i <= $panjang; $i++)
    {

    $result .= substr($string, $panjang-$i, 1);

    }

    return $result;
}

function get_min($range){
    if(empty($range) || trim($range)=='-'){
        return 0;
    }

    $minRange= explode('-', $range);
    return trim($minRange[0]);
}

function get_max($range){
    if(empty($range) || trim($range)=='-'){
        return 0;
    }

    $maxRange= explode('-', $range);
    return trim($maxRange[1]);
}

function set_pickup($pickup)
{
    return title_case( str_replace('-',' ',$pickup));
}

function show_view_url($service, $url = '.cars-services.show')
{
    return '<a href="'.route(ADMIN . $url, $service->id).'" >'.$service->name.'</a>';
}

function get_form_name($document)
{
    if(!empty($document)){
        $name = explode("/",$document);
        return isset($name[4])?$name[4]:$name[3];
    }

    return 'No document';
}

if (! function_exists('is_form_document')) {
    function is_form_document($form, $id, $admin=false)
    {
        if($form==null){
            return '';
        }else{
            $url = url('admin/cars-services/form-document/'.$id);

            if($admin){
                $url = url('admin/services/form-document/'.$id);
            }

            return '<a class="sidebar-link" href="'.$url.'" target="_blank">
                          <span class="icon-holder">
                            <i class="c-brown-500 ti-notepad"></i>
                          </span>
                        </a>';
        }
    }
}
if (! function_exists('get_status')) {
    function get_status($status)
    {
        if($status==='accept'){
            return '<span class="peer"><span class="badge badge-pill fl-r badge-success lh-0 p-10">Accept</span></span>';
        }elseif ($status==='decline') {
            return '<span class="peer"><span class="badge badge-pill fl-r badge-danger lh-0 p-10">Decline</span></span>';
        }else{
            return '<span class="peer"><span class="badge badge-pill fl-r badge-warning lh-0 p-10">Pending</span></span>';
        }
    }
}

if (! function_exists('move_file')) {
    function move_file($file, $type='avatar', $withWatermark = false)
    {
        // Grab all variables
        $destinationPath = config('variables.'.$type.'.folder');
        $width           = config('variables.' . $type . '.width');
        $height          = config('variables.' . $type . '.height');
        $full_name       = str_random(16) . '.' . $file->getClientOriginalExtension();

        if ($width == null && $height == null) { // Just move the file
            $file->storeAs($destinationPath, $full_name);
            return $full_name;
        }


        // Create the Image
        $image  = Image::make($file->getRealPath());

        if ($width == null || $height == null) {
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }else{
            $image->fit($width, $height);
        }

        if ($withWatermark) {
            $watermark = Image::make(public_path() . '/img/watermark.png')->resize($width * 0.5, null);

            $image->insert($watermark, 'center');
        }

        Storage::put($destinationPath . '/' . $full_name, (string) $image->encode());

        return $full_name;
    }
}

if (! function_exists('storeToJson')) {
    function storeToJson($dataSetting)
    {
        $settings = [];
        foreach ($dataSetting as $val) {
            $settings[$val->key] = serialize($val->value);
        }
        file_put_contents(storage_path('settings.json'), json_encode($settings));
    }
}

if (! function_exists('getAllSettings')) {
    function getAllSettings()
    {
        $values = json_decode(file_get_contents(storage_path('settings.json')), true);
        foreach ($values as $key => $value) {
            $values[$key] = unserialize($value);
        }
        return $values;
    }
}

if (! function_exists('getAvatar')) {
    function getAvatar($file)
    {
        return ($file=='http://placehold.it/160x160') ? $file : url('storage/avatar/'.$file);
    }
}

if (! function_exists('getSetting')) {
    function getSetting($key, $default = null)
    {
        $settings=getAllSettings();
        return (array_key_exists($key, $settings) ? $settings[$key] : $default);
    }
}

if (! function_exists('array2json')) {
    function array2json($arr) {
        if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
        $parts = array();
        $is_list = false;

        //Find out if the given array is a numerical array
        $keys = array_keys($arr);
        $max_length = count($arr)-1;
        if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
            $is_list = true;
            for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
                if($i != $keys[$i]) { //A key fails at position check.
                    $is_list = false; //It is an associative array.
                    break;
                }
            }
        }

        foreach($arr as $key=>$value) {
            if(is_array($value)) { //Custom handling for arrays
                if($is_list) $parts[] = array2json($value); /* :RECURSION: */
                else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */
            } else {
                $str = '';
                if(!$is_list) $str = '"' . $key . '":';

                //Custom handling for multiple data types
                if(is_numeric($value)) $str .= $value; //Numbers
                elseif($value === false) $str .= 'false'; //The booleans
                elseif($value === true) $str .= 'true';
                else $str .= '"' . addslashes($value) . '"'; //All other things
                // :TODO: Is there any more datatype we should be in the lookout for? (Object?)

                $parts[] = $str;
            }
        }
        $json = implode(',',$parts);

        if($is_list) return '[' . $json . ']';//Return numerical JSON
        return '{' . $json . '}';//Return associative JSON
    }
}
