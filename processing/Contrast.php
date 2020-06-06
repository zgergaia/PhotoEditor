<?php

class contrast {
    private $contrast_lvl;
    private $image_name, $image, $raw_name, $rnd, $Ext;
    private $edited;
    private $ajax;
    public $errors = [];

    public function __construct($brightnessArg, $img_nameArg, $ajaxArg = false) {
        $this->contrast_lvl= $brightnessArg;
        $this->image_name = $img_nameArg;
        $this->ajax = $ajaxArg;
        $this->Ext = substr($this->image_name, strrpos($this->image_name, ".") + 1);

        if($this->Ext === 'jpg' || $this->Ext === 'jpeg')
            $this->image = imagecreatefromjpeg(__DIR__ . "/../public/{$this->image_name}");
        else if($this->Ext === 'png')
            $this->image = imagecreatefrompng(__DIR__ . "/../public/{$this->image_name}");

        $this->raw_name = substr($this->image_name,  0, strrpos($this->image_name, "."));
        $this->rnd = rand(1, 100);

        $files = glob(__DIR__ . "/../public/edited/tempAJAX/*");
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }
    }

    public function adjustContrast() {
        if (imagefilter($this->image, IMG_FILTER_CONTRAST, $this->contrast_lvl)) {
            if($this->ajax === true) {
                $img_src = __DIR__ . "/../public/edited/tempAJAX/{$this->raw_name}_{$this->rnd}";
                $img_rel_src = "/../public/edited/tempAJAX/{$this->raw_name}_{$this->rnd}";
            }
            else {
                $img_src = __DIR__ . "/../public/edited/{$this->raw_name}_{$this->rnd}";
                $img_rel_src = "/../public/edited/{$this->raw_name}_{$this->rnd}";
            }

            if($this->Ext === 'jpg' || $this->Ext === 'jpeg') {
                imagejpeg($this->image, $img_src . ".jpg", 100);
                $this->edited = $img_rel_src . ".jpg";
            }
            else if($this->Ext === 'png'){
                imagepng($this->image, $img_src . ".png", 9);
                $this->edited = $img_rel_src . ".png";
            }
        } else
            $this->errors['contrast_error'] = "error occurred while adjusting contrast level of a image";

        if(count($this->errors) === 0)
            return $this->edited;
        else
            return "";
    }
    public function __destruct() {
        imagedestroy($this->image);
        if($this->ajax === false)
            unlink(__DIR__ . "/../public/{$this->image_name}");
    }
}