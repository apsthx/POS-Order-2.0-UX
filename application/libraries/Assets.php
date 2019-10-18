<?php

/*
 * SYSTEM NAME  : Hotspot Wifi
 * VERSION	: 2016	Build 0.1
 * AUTHOR 	: Teendoi Studio
 */

/*
 * Class name : Assets
 * Author : Prasan Srisopa
 * Mail : prasan2533@gmail.com
 */

class Assets {
    
    // Assets CSS
    public function css($path_and_filename, $attr = array()) {
        return '<link href="' . base_url() . 'assets/css/' . $path_and_filename . '" rel="stylesheet" type="text/css" ' . $this->conv_to_text($attr) . '/>' . "\r\n\t\t";
    }

    // Assets CSS Full Path
    public function css_full($path_and_filename, $attr = array()) {
        return '<link href="' . base_url() . 'assets/' . $path_and_filename . '" rel="stylesheet" type="text/css" ' . $this->conv_to_text($attr) . '/>' . "\r\n\t\t";
    }

    // Assets JS
    public function js($path_and_filename, $attr = array()) {
        return '<script src="' . base_url() . 'assets/js/' . $path_and_filename . '" type="text/javascript" ' . $this->conv_to_text($attr) . '></script>' . "\r\n\t\t";
    }

    // Assets JS Full Path
    public function js_full($path_and_filename, $attr = array()) {
        return '<script src="' . base_url() . 'assets/' . $path_and_filename . '" type="text/javascript" ' . $this->conv_to_text($attr) . '></script>' . "\r\n\t\t";
    }

    // Assets Images
    public function img($path_and_filename, $attr = array()) {
        return '<img src="' . base_url() . 'assets/img/' . $path_and_filename . '"' . $this->conv_to_text($attr) . ' />';
    }

    // Assets Images Full Path
    public function img_full($path_and_filename, $attr = array()) {
        return '<img src="' . base_url() . 'assets/' . $path_and_filename . '"' . $this->conv_to_text($attr) . ' />';
    }

    // Full Path
    public function full($path_and_filename) {
        return $path_and_filename;
    }

    // Add Attribute
    public function conv_to_text($array) {
        return implode(' ', array_map(function ($value, $key) {
                    return $key . '="' . $value . '"';
                }, $array, array_keys($array)));
    }

    public function meta($property, $content) {
        return '<meta property="' . $property . '" content="' . $content . '" />' . "\r\n\t\t";
    }
    
    // Assets plugins CSS
    public function plugins_css($path_and_filename, $attr = array()) {
        return '<link href="' . base_url() . 'assets/plugins/' . $path_and_filename . '" rel="stylesheet" type="text/css" ' . $this->conv_to_text($attr) . '/>' . "\r\n\t\t";
    }
    
    // Assets plugins JS
    public function plugins_js($path_and_filename, $attr = array()) {
        return '<script src="' . base_url() . 'assets/plugins/' . $path_and_filename . '" type="text/javascript" ' . $this->conv_to_text($attr) . '></script>' . "\r\n\t\t";
    }


}
