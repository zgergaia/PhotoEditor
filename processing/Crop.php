<?php

class crop {
    private $x, $y, $w, $h;
    private $image_name, $image, $raw_name, $rnd, $Ext;
    private $edited;
    public $errors = [];

    public function __construct($xArg, $yArg, $wArg, $hArg, $img_nameArg) {
        $this->x = $xArg;
        $this->y = $yArg;
        $this->w = $wArg;
        $this->h = $hArg;
        $this->image_name = $img_nameArg;
        $this->Ext = substr($this->image_name, strrpos($this->image_name, ".") + 1);

        if($this->Ext === 'jpg' || $this->Ext === 'jpeg')
            $this->image = imagecreatefromjpeg(__DIR__ . "/../public/{$this->image_name}");
        else if($this->Ext === 'png')
            $this->image = imagecreatefrompng(__DIR__ . "/../public/{$this->image_name}");

        $this->raw_name = substr($this->image_name,  0, strrpos($this->image_name, "."));
        $this->rnd = rand(1, 100);
    }

    public function cropimage() {
        $temp = imagecrop($this->image, ['x' => $this->x, 'y' => $this->y, 'width' => $this->w, 'height' => $this->h]);
        if ($temp) {
            if($this->Ext === 'jpg' || $this->Ext === 'jpeg') {
                imagejpeg($temp, __DIR__ . "/../public/edited/{$this->raw_name}_{$this->rnd}.jpg", 100);
                $this->edited = "/../public/edited/{$this->raw_name}_{$this->rnd}.jpg";
            }
            else if($this->Ext === 'png'){
                imagepng($temp, __DIR__ . "/../public/edited/{$this->raw_name}_{$this->rnd}.png", 9);
                $this->edited = "/../public/edited/{$this->raw_name}_{$this->rnd}.png";
            }
            imagedestroy($temp);
        } else
            $this->errors['crop_error'] = "error occurred while cropping the image";

       if(count($this->errors) === 0)
            return $this->edited;
       else
           return "";
    }
    public function __destruct() {
        imagedestroy($this->image);
        unlink(__DIR__ . "/../public/{$this->image_name}");
    }
}