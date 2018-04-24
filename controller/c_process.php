<?php
    
    class C_process {
        
        // function process
        public function checkFileSize($size, $minSize, $maxSize)
        {
            if($size > $minSize && $size < $maxSize)
                return true;
            return false;
        }

        public function checkFileExt($fileName, $arrExt)
        {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            if( in_array(strtolower($ext), $arrExt ) )
                return true;
            return false;
        }

        function subString($text, $start, $length) {
            return substr($text, $start, $length) . '...';
        }

        function toSlug($str) {
            $str = trim(strtolower($str)); // cắt khoảng trắng 2 bên khi đã đc change thành lower
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
            $str = preg_replace('/(đ)/', 'd', $str);
            $str = preg_replace('/^[a-z0-9-\s]$/', '', $str); // tất cả từ a-z 0-9, kí tự - các kí tự khoảng trắng
            $str = preg_replace('/[\s]+/', '-', $str);
            $str = preg_replace('/[:,"“”]/', '', $str);
            $str = preg_replace('/[&]/', 'vs', $str);
            return $str;
        }

        function clearForm($input) {
            $input = trim($input); // loại bỏ khoảng trắng 2 bên
            $input = stripslashes($input); //loại bỏ các kí tự // \
            //$input = strip_tags($input);
            $input = str_replace("'", "",$input);
            $input = htmlspecialchars($input); // chuyển các kí tự lạ sang kí tự đặc biệt của html;
            return $input;
        }
    }
 
?>