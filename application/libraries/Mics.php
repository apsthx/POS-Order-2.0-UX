<?php

/*
 * SYSTEM NAME  : Hotspot Wifi
 * VERSION	: 2016	Build 0.1
 * AUTHOR 	: Teendoi Studio
 */

/**
 * Description of Mics
 * @author Prasan Srisopa
 */
class Mics {

    public function Mics() {
        $CI = & get_instance();
    }

    public function getDate() {
        return date('Y-m-d H:i:s');
    }

    public function getDate2Date() {
        return date('Y-m-d');
    }

    public function getThaiDate() {
        return $this->date2Thai(date('Y-m-d H:i:s'), '%d %m %y %h:%i:%s', '1');
    }

    public function dateThai2Eng($date_select) {
        $date_concat = '';
        $date_concat = $date_concat . intval(substr($date_select, 0, 4)) - 543;
        $date_concat = $date_concat . substr($date_select, 4, 6);
        return $date_concat;
    }

    public function dateEng2Thai($date_select) {
        $date_concat = '';
        $date_concat = $date_concat . intval(substr($date_select, 0, 4)) + 543;
        $date_concat = $date_concat . substr($date_select, 4, 6);
        return $date_concat;
    }

    public function date2Thai($strDate, $format = NULL, $short = NULL) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        if ($short == NULL) {
            $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        } else {
            $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        }
        $strMonthThai = $strMonthCut[$strMonth];
        if ($format == NULL) {
            $format = '%d %m %y, %h %i %s';
        }
        $find = array('%d', '%m', '%y', '%h', '%i', '%s');
        $replace = array($strDay, $strMonthThai, $strYear, $strHour, $strMinute, $strSeconds);
        return str_replace($find, $replace, $format);
    }

    function ThaiBahtConversion($number) {
        $txtnum1 = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
        $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
        $number = str_replace(",", "", $number);
        $number = str_replace(" ", "", $number);
        $number = str_replace("บาท", "", $number);
        $number = explode(".", $number);
        if (sizeof($number) > 2) {
            return 'ทศนิยมหลายตัวนะจ๊ะ';
            exit;
        }
        $strlen = strlen($number[0]);
        $convert = '';
        for ($i = 0; $i < $strlen; $i++) {
            $n = substr($number[0], $i, 1);
            if ($n != 0) {
                if ($i == ($strlen - 1) AND $n == 1) {
                    $convert .= 'เอ็ด';
                } elseif ($i == ($strlen - 2) AND $n == 2) {
                    $convert .= 'ยี่';
                } elseif ($i == ($strlen - 2) AND $n == 1) {
                    $convert .= '';
                } else {
                    $convert .= $txtnum1[$n];
                }
                $convert .= $txtnum2[$strlen - $i - 1];
            }
        }

        $convert .= 'บาท';
        if ($number[1] == '0' OR $number[1] == '00' OR
                $number[1] == '') {
            $convert .= 'ถ้วน';
        } else {
            $strlen = strlen($number[1]);
            for ($i = 0; $i < $strlen; $i++) {
                $n = substr($number[1], $i, 1);
                if ($n != 0) {
                    if ($i == ($strlen - 1) AND $n == 1) {
                        $convert
                                .= 'เอ็ด';
                    } elseif ($i == ($strlen - 2) AND
                            $n == 2) {
                        $convert .= 'ยี่';
                    } elseif ($i == ($strlen - 2) AND
                            $n == 1) {
                        $convert .= '';
                    } else {
                        $convert .= $txtnum1[$n];
                    }
                    $convert .= $txtnum2[$strlen - $i - 1];
                }
            }
            $convert .= 'สตางค์';
        }
        return $convert;
    }

    function ReadNumber($number) {
        $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
        $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $number = $number + 0;
        $ret = "";
        if ($number == 0)
            return $ret;
        if ($number > 1000000) {
            $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
            $number = intval(fmod($number, 1000000));
        }

        $divider = 100000;
        $pos = 0;
        while ($number > 0) {
            $d = intval($number / $divider);
            $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
                    ((($divider == 10) && ($d == 1)) ? "" :
                            ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
            $ret .= ($d ? $position_call[$pos] : "");
            $number = $number % $divider;
            $divider = $divider / 10;
            $pos++;
        }
        return $ret;
    }

    public function dayThai($date) {
        $daythai = array("", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์", "อาทิตย์");
        $strDay = date('N', strtotime($date));
        return $daythai[$strDay];
    }

    function thaiNumDigit($num) {
        return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array("o", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
    }

    public function countAgeNow($param) {
        $End_time = new DateTime($param);
        $Answer = $End_time->diff(new DateTime);
        return $Answer;
    }

    public function ShortenTitle($string, $length = 256) {
        if (mb_strlen($string) > $length)
            $string = (preg_match('/^(.*)\W.*$/', mb_substr($string, 0, $length + 1), $matches) ? $matches[1] : mb_substr($string, 0, $length)) . '...';
        return strip_tags(preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]' .
                        '|[\x00-\x7F][\x80-\xBF]+' .
                        '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*' .
                        '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})' .
                        '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S', '', $string));
    }

    public function convertTextUrl($id, $text) {
        $vowels = array("-", "_", "'", '"', ".", ";", ":", ",", "#", "@", "!", "&", "%", "\\", "/", "?", "(", ")", "\'", "'", "[", "]", "*", "ฯ", "“", "”");
        $spec = array("     ", "    ", "   ", "  ", " ", "---", "--", "-");
        $trim_title1 = trim(str_replace($vowels, "", $text));
        $trim_title2 = str_replace($spec, "-", $trim_title1);
        $url = strtolower($trim_title2);
        return $id . '-' . $url;
    }

    public function convertNameUrl($text) {
        $vowels = array("-", "_", "'", '"', ".", ";", ":", ",", "#", "@", "!", "&", "%", "\\", "/", "?", "(", ")", "\'", "'", "[", "]", "*", "ฯ", "“", "”");
        $spec = array("     ", "    ", "   ", "  ", " ", "---", "--", "-");
        $trim_title1 = trim(str_replace($vowels, "", $text));
        $trim_title2 = str_replace($spec, "-", $trim_title1);
        $url = strtolower($trim_title2);
        return $url;
    }

    public function dateth2stringth($strYmd) {
        $arrayYmd = explode('-', $strYmd);
        $y = $arrayYmd[0];
        $m = intval($arrayYmd[1]);
        $d = intval($arrayYmd[2]);
        $strMonth = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $d . ' ' . $strMonth[$m] . ' ' . $y;
    }

    public function dateen2stringth($strYmd, $short = NULL) {
        $arrayYmd = explode('-', $strYmd);
        $y = $arrayYmd[0] + 543;
        $m = intval($arrayYmd[1]);
        $d = intval($arrayYmd[2]);
        if ($short == NULL) {
            $strMonth = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        } else {
            $strMonth = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        }
        return $d . ' ' . $strMonth[$m] . ' ' . $y;
    }

    public function dateth2stringthM($strYmd) {
        $m = $strYmd;
        $strMonth = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $strMonth[$m];
    }

    public function dateen2stringthMS($strYmd = null) {
        if ($strYmd != null) {
            $arrayYmd = explode('-', $strYmd);
            $y = $arrayYmd[0] + 543;
            $m = intval($arrayYmd[1]);
            $d = intval($arrayYmd[2]);
            $strMonth = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
            return $d . ' ' . $strMonth[$m] . ' ' . $y;
        }
    }

    public function dateen2stringthnum($strYmd) {
        $arrayYmd = explode('-', $strYmd);
        $y = $arrayYmd[0] + 543;
        $m = intval($arrayYmd[1]);
        $d = intval($arrayYmd[2]);
        return $d . '/' . $m . '/' . $y;
    }

}
