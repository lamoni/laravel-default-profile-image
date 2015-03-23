<?php

namespace A6Digital\Image;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Exception;

class DefaultProfileImage
{
	
    /**
     */
    protected function __construct ()
    {
    }

    /**
     * @param string $name
     * @param int $size
	 * @return ImageManagerStatic
	 * @throws Exception
     */
    public static function create ($name = '', $size = 512, $background_color = '#666', $text_color = '#FFF')
    {
	
		if (strlen($name) <= 0) {
            throw new Exception('Name must be at least 2 characters.');
        }
		
		if ($size <= 0) {
            throw new Exception('Input must be greater than zero.');
        }
		
        $str = "";
		$name_ascii = strtoupper(Str::ascii($name));

		$words = preg_split("/[\s,_-]+/", $name_ascii);
		if(count($words) >= 2) $str = $words[0][0].$words[1][0];
		else $str = substr($name_ascii, 0, 2);

		$img = ImageManagerStatic::canvas($size, $size, $background_color)->text($str, $size / 2, $size / 2, function($font) {
		    $font->file(public_path('assets/fonts/OpenSans-Semibold.ttf'));
		    $font->size($size / 2);
		    $font->color($text_color);
		    $font->align('center');
		    $font->valign('middle');
		});
		
		return $img;
		
    }

    
}