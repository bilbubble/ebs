<?php

function date_formatter($date, $format)
{
    $result = explode(" ", $date);
    $result = explode("-", $result[0]);

    $dd = $result[2];
    $mm = $result[1];
    $yyyy = $result[0];

    switch ($mm) {
        case "01":
            $bulan = "January";
            $mmm = "Jan";
            break;
        case "02":
            $bulan = "February";
            $mmm = "Feb";
            break;
        case "03":
            $bulan = "March";
            $mmm = "Mar";
            break;
        case "04":
            $bulan = "April";
            $mmm = "Apr";
            break;
        case "05":
            $bulan = "May";
            $mmm = "May";
            break;
        case "06":
            $bulan = "June";
            $mmm = "Jun";
            break;
        case "07":
            $bulan = "July";
            $mmm = "Jul";
            break;
        case "08":
            $bulan = "August";
            $mmm = "Aug";
            break;
        case "09":
            $bulan = "September";
            $mmm = "Sep";
            break;
        case "10":
            $bulan = "October";
            $mmm = "Oct";
            break;
        case "11":
            $bulan = "November";
            $mmm = "Nov";
            break;
        case "12":
            $bulan = "December";
            $mmm = "Dec";
            break;
        default:
            $bulan = "";
            break;
    }

    if ($format == "dd/mm/yyyy") {
        return $dd . '/' . $mm . '/' . $yyyy;
    }

    if ($format == "dd mmmm yyyy") {
        return $dd . " " . $bulan . " " . $yyyy;
    }

    if ($format == "dd mmm yyyy") {
        return $dd . " " . $mmm . " " . $yyyy;
    }

    if ($format == "mmmm dd, yyyy") {
        return $bulan . " " . $dd . ", " . $yyyy;
    }
}
