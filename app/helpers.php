<?php

function getQueryString($string)
{
    return str_replace(' ', '-', $string);
}

function getStringQuery($query)
{
    return str_replace('-', ' ', $query);
}

function  getPaginationPage($url)
{
    $index =  strpos($url , '=');
    $page =   substr($url, $index + 1);
      return $page;
}


function getSorts()
{
    return $sorts = array("title-ascending" => "alphabitecally , a to z",
        "title-descending" => "alphabitecally , z to a",
        "price-ascending" => "price , low to height",
        "price-descending" => "price , height to low",
        "date-ascending" => "date ,old to new",
        "date-descending" => "date , new to old",

    );

}

function getSizeGuideListData()
{
    return $data = array("Bust" => "Place the tape close under the armhole and measure from side seam to side seam.",
        "Waist" => "This is the narrowest part of the waist. Place the tape from side to side directly at the waistline.",
        "Hip" => "Place the tape approximately 7–9 inches below the natural waistline and measure from side to side at the hip linet",
        "Flare" => "This is the length of the flare of your dress. Flare is the bottom wide length of your dress.",
        "Waist" => "This is the length from the top of the strap down to the hem.",
        "Length" => "This is the length from the top of the waistband to the bottom of the hemline.",

    );

}



