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
    }
 
?>