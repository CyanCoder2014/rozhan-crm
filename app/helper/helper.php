<?php


function strTimeToInt($time):int{
    $split = explode(':',$time);
    $int = 0;
    if(isset($split[0]) && ctype_digit($split[0]))
        $int += intval($split[0])*3600;
    if(isset($split[1]) && ctype_digit($split[1]))
        $int += intval($split[1])*60;
    if(isset($split[2]) && ctype_digit($split[2]))
        $int += intval($split[2]);
    return $int;
}
function IntToTime(int $timeInt){
    $out=[];
    $out['hour'] = intval( $timeInt/3600);
    $timeInt = $timeInt%3600;
    $out['min'] = intval( $timeInt/60);
    $timeInt = $timeInt%60;
    $out['sec'] = intval($timeInt);
    foreach ($out as $key => $item)
        if($item < 10)
            $out[$key] = '0'.$out[$key];
    return $out['hour'].':'.$out['min'].':'.$out['sec'];
}
function validate_jalili($date): bool{
  return preg_match('^[1-4]\d{3}\/((0[1-6]\/((3[0-1])|([1-2][0-9])|(0[1-9])))|((1[0-2]|(0[7-9]))\/(30|([1-2][0-9])|(0[1-9]))))$^',unpersian($date));
}
function validate_time($time): bool{
  return preg_match('/(?:[01]\d|2[0123]):(:[012345]\d):(?:[012345]\d)|(^[01]\d|2[0123]):(?:[012345]\d)/',unpersian($time));
}
function validate_jalili_datetime($datetime): bool{
    $datetime = explode(' ', preg_replace('/\s+/', ' ',unpersian($datetime)));
  return validate_jalili($datetime[0]) && validate_time($datetime[1]??'');
}

function until_time($date)
{
    $now = date('m-d-Y H:i:s', time());

    $timestamp = strtotime($date);
    $timestamp_now = strtotime($now);

    $date_array = jgetdate($timestamp, $none = "", $timezone = "Asia/Tehran", $tr_num = "fa");
    $date_array_now = jgetdate($timestamp_now, $none = "", $timezone = "Asia/Tehran", $tr_num = "fa");

    $j_date = $date_array['mday'] . '/' . $date_array['month'] . '/' . $date_array['year'] . ' <i class="fa fa-clock-o"></i>  ' . $date_array['hours'] . ':' . $date_array['minutes'];
    $until_time = tr_num12($date_array_now['hours'] - $date_array['hours'], 'fa') . ' ساعت پیش';
    $until_minuet = tr_num12($date_array_now['minutes'] - $date_array['minutes'], 'fa') . ' دقیقه پیش ';
    $until_just_now = 'لحظاتی پیش';

    if ($date_array['minutes'] . $date_array['hours'] . $date_array['mday'] . $date_array['month'] . $date_array['year'] == $date_array_now['minutes'] . $date_array_now['hours'] . $date_array_now['mday'] . $date_array_now['month'] . $date_array_now['year']) {
        $result = $until_just_now;
    } elseif ($date_array['hours'] . $date_array['mday'] . $date_array['month'] . $date_array['year'] == $date_array_now['hours'] . $date_array_now['mday'] . $date_array_now['month'] . $date_array_now['year']) {
        $result = $until_minuet;
    } elseif ($date_array['mday'] . $date_array['month'] . $date_array['year'] == $date_array_now['mday'] . $date_array_now['month'] . $date_array_now['year']) {
        $result = $until_time;
    } else {
        $result = $j_date;
    }

    return $result;

}


function to_jalali_date($date)
{

    $timestamp = strtotime($date);
    $date_array = jgetdate($timestamp, $none = "", $timezone = "Asia/Tehran", $tr_num = "fa");

    $j_date = $date_array['year'] . '/' . $date_array['mon'] . '/' . $date_array['mday'];

    return $j_date;

}
function to_georgian_date($date)
{

    if(validate_jalili($date)){
        $date = explode('/', unpersian($date));
        $date = implode('-', jalali_to123_gregorian((int)$date[0], (int)$date[1], (int)$date[2]));
        return $date;
    }
    return null;

}
function to_georgian($dateTime)
{
    $datetime = explode(' ', preg_replace('/\s+/', ' ',unpersian($dateTime)));
    if(validate_jalili($datetime[0]) && validate_time($datetime[1]??'')){
        $date = explode('/', unpersian($datetime[0]));
        $date = implode('-', jalali_to123_gregorian((int)$date[0], (int)$date[1], (int)$date[2]));
        return $date.' '.$datetime[1];
    }
    return null;

}


function to_jalali_month($date)
{
    $timestamp = strtotime($date);
    $date_array = jgetdate($timestamp, $none = "", $timezone = "Asia/Tehran", $tr_num = "fa");

    $j_date = $date_array['month'] . ' &nbsp;' . $date_array['year'];

    return $j_date;
}


function to_jalali($date)
{

    //$asd = ljdate('a h:i  l, j / F / Y');
    //$datetime = date('m-d-Y H:i:s', time());
    //$date_array['weekday']
    $timestamp = strtotime($date);
    $date_array = jgetdate($timestamp, $none = "", $timezone = "Asia/Tehran", $tr_num = "fa");

    $j_date = $date_array['year'] . '/' . $date_array['mon'] . '/' . $date_array['mday'] . ' ' . $date_array['hours'] . ':' . $date_array['minutes'];

    return $j_date;

}


function to_jalali_no_time($date)
{

    //$asd = ljdate('a h:i  l, j / F / Y');
    //$datetime = date('m-d-Y H:i:s', time());
    //$date_array['weekday']
    $timestamp = strtotime($date);
    $date_array = jgetdate($timestamp, $none = "", $timezone = "Asia/Tehran", $tr_num = "fa");

    $j_date = $date_array['year'] . '/' . $date_array['mon'] . '/' . $date_array['mday'];

    return $j_date;

}

function to_jalali_datetime($date)
{

    //$asd = ljdate('a h:i  l, j / F / Y');
    //$datetime = date('m-d-Y H:i:s', time());
    //$date_array['weekday']
    $timestamp = strtotime($date);
    $date_array = jgetdate($timestamp, $none = "", $timezone = "Asia/Tehran", $tr_num = "fa");
    if ($date_array['minutes'] < 10)
        $date_array['minutes'] = '0'.$date_array['minutes'];
    $j_date = $date_array['year'] . '/' . $date_array['mon'] . '/' . $date_array['mday'] . "   " . $date_array['hours'] . ':' . $date_array['minutes']. ':' . $date_array['seconds'];

    return persian($j_date);

}


function ljdate($format, $timestamp = '', $none = '', $time_zone = 'Asia/Tehran', $tr_num = 'fa')
{

    $T_sec = 0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

    if ($time_zone != 'local') date_default_timezone_set(($time_zone === '') ? 'Asia/Tehran' : $time_zone);
    $ts = $T_sec + (($timestamp === '') ? time() : tr_num($timestamp));
    $date = explode('_', date('H_i_j_n_O_P_s_w_Y', $ts));
    list($j_y, $j_m, $j_d) = gregorian_to_jalali($date[8], $date[3], $date[2]);
    $doy = ($j_m < 7) ? (($j_m - 1) * 31) + $j_d - 1 : (($j_m - 7) * 30) + $j_d + 185;
    $kab = (((($j_y % 33) % 4) - 1) == ((int)(($j_y % 33) * 0.05))) ? 1 : 0;
    $sl = strlen($format);
    $out = '';
    for ($i = 0; $i < $sl; $i++) {
        $sub = substr($format, $i, 1);
        if ($sub == '\\') {
            $out .= substr($format, ++$i, 1);
            continue;
        }
        switch ($sub) {

            case'E':
            case'R':
            case'x':
            case'X':
                $out .= 'http://jdf.scr.ir';
                break;

            case'B':
            case'e':
            case'g':
            case'G':
            case'h':
            case'I':
            case'T':
            case'u':
            case'Z':
                $out .= date($sub, $ts);
                break;

            case'a':
                $out .= ($date[0] < 12) ? 'ق.ظ' : 'ب.ظ';
                break;

            case'A':
                $out .= ($date[0] < 12) ? 'قبل از ظهر' : 'بعد از ظهر';
                break;

            case'b':
                $out .= (int)($j_m / 3.1) + 1;
                break;

            case'c':
                $out .= $j_y . '/' . $j_m . '/' . $j_d . ' ،' . $date[0] . ':' . $date[1] . ':' . $date[6] . ' ' . $date[5];
                break;

            case'C':
                $out .= (int)(($j_y + 99) / 100);
                break;

            case'd':
                $out .= ($j_d < 10) ? '0' . $j_d : $j_d;
                break;

            case'D':
                $out .= ljdate_words(array('kh' => $date[7]), ' ');
                break;

            case'f':
                $out .= ljdate_words(array('ff' => $j_m), ' ');
                break;

            case'F':
                $out .= ljdate_words(array('mm' => $j_m), ' ');
                break;

            case'H':
                $out .= $date[0];
                break;

            case'i':
                $out .= $date[1];
                break;

            case'j':
                $out .= $j_d;
                break;

            case'J':
                $out .= ljdate_words(array('rr' => $j_d), ' ');
                break;

            case'k';
                $out .= tr_num(100 - (int)($doy / ($kab + 365) * 1000) / 10, $tr_num);
                break;

            case'K':
                $out .= tr_num((int)($doy / ($kab + 365) * 1000) / 10, $tr_num);
                break;

            case'l':
                $out .= ljdate_words(array('rh' => $date[7]), ' ');
                break;

            case'L':
                $out .= $kab;
                break;

            case'm':
                $out .= ($j_m > 9) ? $j_m : '0' . $j_m;
                break;

            case'M':
                $out .= ljdate_words(array('km' => $j_m), ' ');
                break;

            case'n':
                $out .= $j_m;
                break;

            case'N':
                $out .= $date[7] + 1;
                break;

            case'o':
                $jdw = ($date[7] == 6) ? 0 : $date[7] + 1;
                $dny = 364 + $kab - $doy;
                $out .= ($jdw > ($doy + 3) and $doy < 3) ? $j_y - 1 : (((3 - $dny) > $jdw and $dny < 3) ? $j_y + 1 : $j_y);
                break;

            case'O':
                $out .= $date[4];
                break;

            case'p':
                $out .= ljdate_words(array('mb' => $j_m), ' ');
                break;

            case'P':
                $out .= $date[5];
                break;

            case'q':
                $out .= ljdate_words(array('sh' => $j_y), ' ');
                break;

            case'Q':
                $out .= $kab + 364 - $doy;
                break;

            case'r':
                $key = ljdate_words(array('rh' => $date[7], 'mm' => $j_m));
                $out .= $date[0] . ':' . $date[1] . ':' . $date[6] . ' ' . $date[4] . ' ' . $key['rh'] . '، ' . $j_d . ' ' . $key['mm'] . ' ' . $j_y;
                break;

            case's':
                $out .= $date[6];
                break;

            case'S':
                $out .= 'ام';
                break;

            case't':
                $out .= ($j_m != 12) ? (31 - (int)($j_m / 6.5)) : ($kab + 29);
                break;

            case'U':
                $out .= $ts;
                break;

            case'v':
                $out .= ljdate_words(array('ss' => ($j_y % 100)), ' ');
                break;

            case'V':
                $out .= ljdate_words(array('ss' => $j_y), ' ');
                break;

            case'w':
                $out .= ($date[7] == 6) ? 0 : $date[7] + 1;
                break;

            case'W':
                $avs = (($date[7] == 6) ? 0 : $date[7] + 1) - ($doy % 7);
                if ($avs < 0) $avs += 7;
                $num = (int)(($doy + $avs) / 7);
                if ($avs < 4) {
                    $num++;
                } elseif ($num < 1) {
                    $num = ($avs == 4 or $avs == ((((($j_y % 33) % 4) - 2) == ((int)(($j_y % 33) * 0.05))) ? 5 : 4)) ? 53 : 52;
                }
                $aks = $avs + $kab;
                if ($aks == 7) $aks = 0;
                $out .= (($kab + 363 - $doy) < $aks and $aks < 3) ? '01' : (($num < 10) ? '0' . $num : $num);
                break;

            case'y':
                $out .= substr($j_y, 2, 2);
                break;

            case'Y':
                $out .= $j_y;
                break;

            case'z':
                $out .= $doy;
                break;

            default:
                $out .= $sub;
        }
    }
    return ($tr_num != 'en') ? tr_num($out, 'fa', '.') : $out;
}

/*	F	*/
function jstrftime($format, $timestamp = '', $none = '', $time_zone = 'Asia/Tehran', $tr_num = 'fa')
{

    $T_sec = 0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

    if ($time_zone != 'local') date_default_timezone_set(($time_zone === '') ? 'Asia/Tehran' : $time_zone);
    $ts = $T_sec + (($timestamp === '') ? time() : tr_num($timestamp));
    $date = explode('_', date('h_H_i_j_n_s_w_Y', $ts));
    list($j_y, $j_m, $j_d) = gregorian_to_jalali($date[7], $date[4], $date[3]);
    $doy = ($j_m < 7) ? (($j_m - 1) * 31) + $j_d - 1 : (($j_m - 7) * 30) + $j_d + 185;
    $kab = (((($j_y % 33) % 4) - 1) == ((int)(($j_y % 33) * 0.05))) ? 1 : 0;
    $sl = strlen($format);
    $out = '';
    for ($i = 0; $i < $sl; $i++) {
        $sub = substr($format, $i, 1);
        if ($sub == '%') {
            $sub = substr($format, ++$i, 1);
        } else {
            $out .= $sub;
            continue;
        }
        switch ($sub) {

            /* Day */
            case'a':
                $out .= ljdate_words(array('kh' => $date[6]), ' ');
                break;

            case'A':
                $out .= ljdate_words(array('rh' => $date[6]), ' ');
                break;

            case'd':
                $out .= ($j_d < 10) ? '0' . $j_d : $j_d;
                break;

            case'e':
                $out .= ($j_d < 10) ? ' ' . $j_d : $j_d;
                break;

            case'j':
                $out .= str_pad($doy + 1, 3, 0, STR_PAD_LEFT);
                break;

            case'u':
                $out .= $date[6] + 1;
                break;

            case'w':
                $out .= ($date[6] == 6) ? 0 : $date[6] + 1;
                break;

            /* Week */
            case'U':
                $avs = (($date[6] < 5) ? $date[6] + 2 : $date[6] - 5) - ($doy % 7);
                if ($avs < 0) $avs += 7;
                $num = (int)(($doy + $avs) / 7) + 1;
                if ($avs > 3 or $avs == 1) $num--;
                $out .= ($num < 10) ? '0' . $num : $num;
                break;

            case'V':
                $avs = (($date[6] == 6) ? 0 : $date[6] + 1) - ($doy % 7);
                if ($avs < 0) $avs += 7;
                $num = (int)(($doy + $avs) / 7);
                if ($avs < 4) {
                    $num++;
                } elseif ($num < 1) {
                    $num = ($avs == 4 or $avs == ((((($j_y % 33) % 4) - 2) == ((int)(($j_y % 33) * 0.05))) ? 5 : 4)) ? 53 : 52;
                }
                $aks = $avs + $kab;
                if ($aks == 7) $aks = 0;
                $out .= (($kab + 363 - $doy) < $aks and $aks < 3) ? '01' : (($num < 10) ? '0' . $num : $num);
                break;

            case'W':
                $avs = (($date[6] == 6) ? 0 : $date[6] + 1) - ($doy % 7);
                if ($avs < 0) $avs += 7;
                $num = (int)(($doy + $avs) / 7) + 1;
                if ($avs > 3) $num--;
                $out .= ($num < 10) ? '0' . $num : $num;
                break;

            /* Month */
            case'b':
            case'h':
                $out .= ljdate_words(array('km' => $j_m), ' ');
                break;

            case'B':
                $out .= ljdate_words(array('mm' => $j_m), ' ');
                break;

            case'm':
                $out .= ($j_m > 9) ? $j_m : '0' . $j_m;
                break;

            /* Year */
            case'C':
                $tmp = (int)($j_y / 100);
                $out .= ($tmp > 9) ? $tmp : '0' . $tmp;
                break;

            case'g':
                $jdw = ($date[6] == 6) ? 0 : $date[6] + 1;
                $dny = 364 + $kab - $doy;
                $out .= substr(($jdw > ($doy + 3) and $doy < 3) ? $j_y - 1 : (((3 - $dny) > $jdw and $dny < 3) ? $j_y + 1 : $j_y), 2, 2);
                break;

            case'G':
                $jdw = ($date[6] == 6) ? 0 : $date[6] + 1;
                $dny = 364 + $kab - $doy;
                $out .= ($jdw > ($doy + 3) and $doy < 3) ? $j_y - 1 : (((3 - $dny) > $jdw and $dny < 3) ? $j_y + 1 : $j_y);
                break;

            case'y':
                $out .= substr($j_y, 2, 2);
                break;

            case'Y':
                $out .= $j_y;
                break;

            /* Time */
            case'H':
                $out .= $date[1];
                break;

            case'I':
                $out .= $date[0];
                break;

            case'l':
                $out .= ($date[0] > 9) ? $date[0] : ' ' . (int)$date[0];
                break;

            case'M':
                $out .= $date[2];
                break;

            case'p':
                $out .= ($date[1] < 12) ? 'قبل از ظهر' : 'بعد از ظهر';
                break;

            case'P':
                $out .= ($date[1] < 12) ? 'ق.ظ' : 'ب.ظ';
                break;

            case'r':
                $out .= $date[0] . ':' . $date[2] . ':' . $date[5] . ' ' . (($date[1] < 12) ? 'قبل از ظهر' : 'بعد از ظهر');
                break;

            case'R':
                $out .= $date[1] . ':' . $date[2];
                break;

            case'S':
                $out .= $date[5];
                break;

            case'T':
                $out .= $date[1] . ':' . $date[2] . ':' . $date[5];
                break;

            case'X':
                $out .= $date[0] . ':' . $date[2] . ':' . $date[5];
                break;

            case'z':
                $out .= date('O', $ts);
                break;

            case'Z':
                $out .= date('T', $ts);
                break;

            /* Time and Date Stamps */
            case'c':
                $key = ljdate_words(array('rh' => $date[6], 'mm' => $j_m));
                $out .= $date[1] . ':' . $date[2] . ':' . $date[5] . ' ' . date('P', $ts) . ' ' . $key['rh'] . '، ' . $j_d . ' ' . $key['mm'] . ' ' . $j_y;
                break;

            case'D':
                $out .= substr($j_y, 2, 2) . '/' . (($j_m > 9) ? $j_m : '0' . $j_m) . '/' . (($j_d < 10) ? '0' . $j_d : $j_d);
                break;

            case'F':
                $out .= $j_y . '-' . (($j_m > 9) ? $j_m : '0' . $j_m) . '-' . (($j_d < 10) ? '0' . $j_d : $j_d);
                break;

            case's':
                $out .= $ts;
                break;

            case'x':
                $out .= substr($j_y, 2, 2) . '/' . (($j_m > 9) ? $j_m : '0' . $j_m) . '/' . (($j_d < 10) ? '0' . $j_d : $j_d);
                break;

            /* Miscellaneous */
            case'n':
                $out .= "\n";
                break;

            case't':
                $out .= "\t";
                break;

            case'%':
                $out .= '%';
                break;

            default:
                $out .= $sub;
        }
    }
    return ($tr_num != 'en') ? tr_num($out, 'fa', '.') : $out;
}

/*	F	*/
function jmktime($h = '', $m = '', $s = '', $jm = '', $jd = '', $jy = '', $none = '', $timezone = 'Asia/Tehran')
{
    if ($timezone != 'local') date_default_timezone_set($timezone);
    if ($h === '') {
        return time();
    } else {
        list($h, $m, $s, $jm, $jd, $jy) = explode('_', tr_num($h . '_' . $m . '_' . $s . '_' . $jm . '_' . $jd . '_' . $jy));
        if ($m === '') {
            return mktime($h);
        } else {
            if ($s === '') {
                return mktime($h, $m);
            } else {
                if ($jm === '') {
                    return mktime($h, $m, $s);
                } else {
                    $ljdate = explode('_', ljdate('Y_j', '', '', $timezone, 'en'));
                    if ($jd === '') {
                        list($gy, $gm, $gd) = jalali_to_gregorian($ljdate[0], $jm, $ljdate[1]);
                        return mktime($h, $m, $s, $gm);
                    } else {
                        if ($jy === '') {
                            list($gy, $gm, $gd) = jalali_to_gregorian($ljdate[0], $jm, $jd);
                            return mktime($h, $m, $s, $gm, $gd);
                        } else {
                            list($gy, $gm, $gd) = jalali_to_gregorian($jy, $jm, $jd);
                            return mktime($h, $m, $s, $gm, $gd, $gy);
                        }
                    }
                }
            }
        }
    }
}

/*	F	*/
function jgetdate($timestamp = '', $none = '', $timezone = 'Asia/Tehran', $tn = 'en')
{
    $ts = ($timestamp === '') ? time() : tr_num($timestamp);
    $ljdate = explode('_', ljdate('F_G_i_d_l_m_s_w_Y_z', $ts, '', $timezone, $tn));
    return array(
        'seconds' => tr_num((int)tr_num($ljdate[6]), $tn),
        'minutes' => tr_num((int)tr_num($ljdate[2]), $tn),
        'hours'   => $ljdate[1],
        'mday'    => $ljdate[3],
        'wday'    => $ljdate[7],
        'mon'     => $ljdate[5],
        'year'    => $ljdate[8],
        'yday'    => $ljdate[9],
        'weekday' => $ljdate[4],
        'month'   => $ljdate[0],
        0         => tr_num($ts, $tn)
    );
}

/*	F	*/
function jcheckdate($jm, $jd, $jy)
{
    list($jm, $jd, $jy) = explode('_', tr_num($jm . '_' . $jd . '_' . $jy));
    $l_d = ($jm == 12) ? ((((($jy % 33) % 4) - 1) == ((int)(($jy % 33) * 0.05))) ? 30 : 29) : 31 - (int)($jm / 6.5);
    return ($jm > 12 or $jd > $l_d or $jm < 1 or $jd < 1 or $jy < 1) ? false : true;
}

/*	F	*/
function tr_num12($str, $mod = 'en', $mf = '٫')
{
    $num_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
    $key_a = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', $mf);
    return ($mod == 'fa') ? str_replace($num_a, $key_a, $str) : str_replace($key_a, $num_a, $str);
}

function tr_num($str, $mod = 'en', $mf = '٫')
{
    $num_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
    $key_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', $mf);
    return ($mod == 'fa') ? str_replace($num_a, $key_a, $str) : str_replace($key_a, $num_a, $str);
}

/*	F	*/
function ljdate_words($array, $mod = '')
{
    foreach ($array as $type => $num) {
        $num = (int)tr_num($num);
        switch ($type) {

            case'ss':
                $sl = strlen($num);
                $xy3 = substr($num, 2 - $sl, 1);
                $h3 = $h34 = $h4 = '';
                if ($xy3 == 1) {
                    $p34 = '';
                    $k34 = array('ده', 'یازده', 'دوازده', 'سیزده', 'چهارده', 'پانزده', 'شانزده', 'هفده', 'هجده', 'نوزده');
                    $h34 = $k34[substr($num, 2 - $sl, 2) - 10];
                } else {
                    $xy4 = substr($num, 3 - $sl, 1);
                    $p34 = ($xy3 == 0 or $xy4 == 0) ? '' : ' و ';
                    $k3 = array('', '', 'بیست', 'سی', 'چهل', 'پنجاه', 'شصت', 'هفتاد', 'هشتاد', 'نود');
                    $h3 = $k3[$xy3];
                    $k4 = array('', 'یک', 'دو', 'سه', 'چهار', 'پنج', 'شش', 'هفت', 'هشت', 'نه');
                    $h4 = $k4[$xy4];
                }
                $array[$type] = (($num > 99) ? str_replace(array('12', '13', '14', '19', '20')
                            , array('هزار و دویست', 'هزار و سیصد', 'هزار و چهارصد', 'هزار و نهصد', 'دوهزار')
                            , substr($num, 0, 2)) . ((substr($num, 2, 2) == '00') ? '' : ' و ') : '') . $h3 . $p34 . $h34 . $h4;
                break;

            case'mm':
                $key = array('فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند');
                $array[$type] = $key[$num - 1];
                break;

            case'rr':
                $key = array('یک', 'دو', 'سه', 'چهار', 'پنج', 'شش', 'هفت', 'هشت', 'نه', 'ده', 'یازده', 'دوازده', 'سیزده'
                , 'چهارده', 'پانزده', 'شانزده', 'هفده', 'هجده', 'نوزده', 'بیست', 'بیست و یک', 'بیست و دو', 'بیست و سه'
                , 'بیست و چهار', 'بیست و پنج', 'بیست و شش', 'بیست و هفت', 'بیست و هشت', 'بیست و نه', 'سی', 'سی و یک');
                $array[$type] = $key[$num - 1];
                break;

            case'rh':
                $key = array('یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه', 'شنبه');
                $array[$type] = $key[$num];
                break;

            case'sh':
                $key = array('مار', 'اسب', 'گوسفند', 'میمون', 'مرغ', 'سگ', 'خوک', 'موش', 'گاو', 'پلنگ', 'خرگوش', 'نهنگ');
                $array[$type] = $key[$num % 12];
                break;

            case'mb':
                $key = array('حمل', 'ثور', 'جوزا', 'سرطان', 'اسد', 'سنبله', 'میزان', 'عقرب', 'قوس', 'جدی', 'دلو', 'حوت');
                $array[$type] = $key[$num - 1];
                break;

            case'ff':
                $key = array('بهار', 'تابستان', 'پاییز', 'زمستان');
                $array[$type] = $key[(int)($num / 3.1)];
                break;

            case'km':
                $key = array('فر', 'ار', 'خر', 'تی‍', 'مر', 'شه‍', 'مه‍', 'آب‍', 'آذ', 'دی', 'به‍', 'اس‍');
                $array[$type] = $key[$num - 1];
                break;

            case'kh':
                $key = array('ی', 'د', 'س', 'چ', 'پ', 'ج', 'ش');
                $array[$type] = $key[$num];
                break;

            default:
                $array[$type] = $num;
        }
    }
    return ($mod === '') ? $array : implode($mod, $array);
}


/** Gregorian & Jalali (Hijri_Shamsi,Solar) date converter Functions
 * Author: JDF.SCR.IR =>> Download Full Version : http://jdf.scr.ir/jdf
 * License: GNU/LGPL _ Open Source & Free _ Version: 2.70 : [2017=1395]
 * --------------------------------------------------------------------
 * 1461 = 365*4 + 4/4   &  146097 = 365*400 + 400/4 - 400/100 + 400/400
 * 12053 = 365*33 + 32/4    &    36524 = 365*100 + 100/4 - 100/100   */

/*	F	*/
function gregorian_to_jalali($gy, $gm, $gd, $mod = '')
{
    list($gy, $gm, $gd) = explode('_', tr_num($gy . '_' . $gm . '_' . $gd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
    $g_d_m = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
    if ($gy > 1600) {
        $jy = 979;
        $gy -= 1600;
    } else {
        $jy = 0;
        $gy -= 621;
    }
    $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
    $days = (365 * $gy) + ((int)(($gy2 + 3) / 4)) - ((int)(($gy2 + 99) / 100)) + ((int)(($gy2 + 399) / 400)) - 80 + $gd + $g_d_m[$gm - 1];
    $jy += 33 * ((int)($days / 12053));
    $days %= 12053;
    $jy += 4 * ((int)($days / 1461));
    $days %= 1461;
    $jy += (int)(($days - 1) / 365);
    if ($days > 365) $days = ($days - 1) % 365;
    if ($days < 186) {
        $jm = 1 + (int)($days / 31);
        $jd = 1 + ($days % 31);
    } else {
        $jm = 7 + (int)(($days - 186) / 30);
        $jd = 1 + (($days - 186) % 30);
    }
    return ($mod === '') ? array($jy, $jm, $jd) : $jy . $mod . $jm . $mod . $jd;
}

/*	F	*/
function jalali_to_gregorian($jy, $jm, $jd, $mod = '')
{
    list($jy, $jm, $jd) = explode('_', tr_num($jy . '_' . $jm . '_' . $jd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
    if ($jy > 979) {
        $gy = 1600;
        $jy -= 979;
    } else {
        $gy = 621;
    }
    $days = (365 * $jy) + (((int)($jy / 33)) * 8) + ((int)((($jy % 33) + 3) / 4)) + 78 + $jd + (($jm < 7) ? ($jm - 1) * 31 : (($jm - 7) * 30) + 186);
    $gy += 400 * ((int)($days / 146097));
    $days %= 146097;
    if ($days > 36524) {
        $gy += 100 * ((int)(--$days / 36524));
        $days %= 36524;
        if ($days >= 365) $days++;
    }
    $gy += 4 * ((int)(($days) / 1461));
    $days %= 1461;
    $gy += (int)(($days - 1) / 365);
    if ($days > 365) $days = ($days - 1) % 365;
    $gd = $days + 1;
    foreach (array(0, 31, ((($gy % 4 == 0) and ($gy % 100 != 0)) or ($gy % 400 == 0)) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31) as $gm => $v) {
        if ($gd <= $v) break;
        $gd -= $v;
    }
    return ($mod === '') ? array($gy, $gm, $gd) : $gy . $mod . $gm . $mod . $gd;
}


function translate($word,$locale) {
    $find_word = \Illuminate\Support\Facades\DB::table('translates')->where('word', $word);
    if($find_word->count() > 0){
        if($find_word->first()->$locale !== null  && $find_word->first()->$locale !== ''){
            $return = $find_word->first()->$locale;
        }
        else{
            $return = ucwords(str_replace('_', ' ', $word));
        }
    }
    else{
        $data['word'] = $word;
        $data['en'] = ucwords(str_replace('_', ' ', $word));
        \Illuminate\Support\Facades\DB::table('translates')->insert($data);
        $return = ucwords(str_replace('_', ' ', $word));
        $locale = 'en';
    }
    return $return;
}

function limit_title($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text='';
        if (strlen($text)>5){
            $text = substr($text, 0, $pos[$limit], "utf-8");
        }
    }
    $text=mb_substr(strip_tags($text),0,$limit, 'UTF-8').' ... ';
    return $text;
}
function SendSMS($apiKey, $number, $message){

    $params = array('api' => $apiKey, 'number' => $number, 'msg' => htmlentities($message));

    $curl_options = array(
        CURLOPT_URL => 'http://www.pushit.ir/api',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false
    );

    $curl = curl_init();
    curl_setopt_array($curl, $curl_options);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
function persian($string) {
    $persian_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $latin_num = range(0, 9);

    $string = str_replace($latin_num, $persian_num, $string);

    return $string;
}
function unpersian($string) {
    $persian_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $latin_num = range(0, 9);

    $string = str_replace($persian_num,$latin_num,  $string);

    return $string;
}
function slug($string){

    $string=urldecode($string);


    $total_count=strlen($string);
    $txt="";
    $num=0;

    preg_replace("/[^[:alnum][:space]]/ui", '', $string);
    $string=str_replace(' ', '-', $string);
    $string=str_replace('!', '-', $string);
    $string=str_replace('?', '-', $string);
    $string=str_replace('%', '-', $string);
    $string=str_replace('-', '-', $string);
    $string=str_replace('"', '-', $string);
    $string=str_replace('\'', '-', $string);
    $string=str_replace('__', '-', $string);
    if(substr($string, 0, 1)=="-"){
        $string=substr($string, 1);
    }
    if(Trim(substr($string, ($total_count-2)))=="-"){
        $string=substr($string, 0, ($total_count-2));
    }

    $string=trim($string,'-');

    return  $string;


}


/*  date function  */


function div($a,$b) {
    return (int) ($a / $b);
}

function gregorian123_to_jalali ($g_y, $g_m, $g_d)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);





    $gy = $g_y-1600;
    $gm = $g_m-1;
    $gd = $g_d-1;

    $g_day_no = 365*$gy+div($gy+3,4)-div($gy+99,100)+div($gy+399,400);

    for ($i=0; $i < $gm; ++$i)
        $g_day_no += $g_days_in_month[$i];
    if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
        /* leap and after Feb */
        $g_day_no++;
    $g_day_no += $gd;

    $j_day_no = $g_day_no-79;

    $j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
    $j_day_no = $j_day_no % 12053;

    $jy = 979+33*$j_np+4*div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */

    $j_day_no %= 1461;

    if ($j_day_no >= 366) {
        $jy += div($j_day_no-1, 365);
        $j_day_no = ($j_day_no-1)%365;
    }

    for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
        $j_day_no -= $j_days_in_month[$i];
    $jm = $i+1;
    $jd = $j_day_no+1;

    return array($jy, $jm, $jd);
}

function jalali_to123_gregorian($j_y, $j_m, $j_d)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);



    $jy = $j_y-979;
    $jm = $j_m-1;
    $jd = $j_d-1;

    $j_day_no = 365*$jy + div($jy, 33)*8 + div($jy%33+3, 4);
    for ($i=0; $i < $jm; ++$i)
        $j_day_no += $j_days_in_month[$i];

    $j_day_no += $jd;

    $g_day_no = $j_day_no+79;

    $gy = 1600 + 400*div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
    $g_day_no = $g_day_no % 146097;

    $leap = true;
    if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */
    {
        $g_day_no--;
        $gy += 100*div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */
        $g_day_no = $g_day_no % 36524;

        if ($g_day_no >= 365)
            $g_day_no++;
        else
            $leap = false;
    }

    $gy += 4*div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
    $g_day_no %= 1461;

    if ($g_day_no >= 366) {
        $leap = false;

        $g_day_no--;
        $gy += div($g_day_no, 365);
        $g_day_no = $g_day_no % 365;
    }

    for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
        $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
    $gm = $i+1;
    $gd = $g_day_no+1;

    return array($gy, $gm, $gd);
}
function TsToDateTime($timestamp){





    $year=date("Y", $timestamp);

    $month=date("m", $timestamp);

    $day=date("d", $timestamp);

    $hour=date("H", $timestamp);

    $minute=date("i", $timestamp);

    $second=date("s", $timestamp);
    $week_day=date("l", $timestamp);

    $weekday=array("Monday"=>"دوشنبه","Tuesday"=>"سه شنبه","Wednesday"=>"چهارشنبه","Thursday"=>"پنجشنبه","Friday"=>"جمعه","Saturday"=>"شنبه","Sunday"=>"یکشنبه");
    $month_name=array('فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند');

    $irantimestamp = $timestamp+16200;

    $ihour=date("H", $irantimestamp);

    $iminute=date("i", $irantimestamp);

    $isecond=date("s", $irantimestamp);



    $shamsi=gregorian123_to_jalali(date("Y", $timestamp), date("m", $timestamp), date("d", $timestamp));

    $shamsi_y=$shamsi['0'];

    $shamsi_m=$shamsi['1'];

    $shamsi_d=$shamsi['2'];





    $data["Timestamp"]=$timestamp;

    $data["MiladiYear"]=$year;

    $data["MiladiMonth"]=$month;

    $data["MiladiDay"]=$day;

    $data["ShamsiYear"]=$shamsi_y;

    $data["ShamsiMonth"]=$shamsi_m;

    $data["ShamsiDay"]=$shamsi_d;

    $data["WorldHour"]=$hour;

    $data["WorldMinute"]=$minute;

    $data["WorldSecond"]=$second;

    $data["IranHour"]=$ihour;

    $data["IranMinute"]=$iminute;

    $data["IranSecond"]=$isecond;
    $data["WeekDay"]=$weekday[$week_day];
    $data["month_name"]=$month_name[$shamsi_m-1];



    return $data;





}
function DateTimeToTs($shamsiyear, $shamsimonth, $shamsiday, $ihour, $iminute, $isecond){
    $miladi=jalali_to123_gregorian("$shamsiyear", "$shamsimonth", "$shamsiday");
    $tmm=mktime($ihour,$iminute,$isecond,$miladi['1'],$miladi['2'],$miladi['0']);
    return $tmm-16200;


}

function fulldate($timestamp){
    $dt=TsToDateTime($timestamp);
    // $dt["IranWeekDay"]." ".
    $dt=$dt["ShamsiYear"]."/".$dt["ShamsiMonth"]."/".$dt["ShamsiDay"]."&nbsp; ".$dt["IranHour"].":".$dt["IranMinute"];
    return $dt;
}
function justdate($timestamp){
    $dt=TsToDateTime($timestamp);
    $dt=$dt["ShamsiYear"]."/".$dt["ShamsiMonth"]."/".$dt["ShamsiDay"];
    return $dt;
}
function wweek($timestamp){
    $dt=TsToDateTime($timestamp);
    $dt=$dt['WeekDay'].' '.$dt['ShamsiDay'].' '.$dt['month_name'].' '.$dt['ShamsiYear'];;
    return $dt;
}


function format_time($time)
{
        $time = explode(':', unpersian($time));
        $time = $time[0].':'.$time[1];
        return $time;
}

/* end date function */



?>