<?php

function slug_maker($judul, $tabel)
{
    $slug = strtolower($judul);
    $slug = str_replace(' ', '-', $slug);

    $cek_slug = query("SELECT slug FROM $tabel WHERE slug = '$slug'");
    if ($cek_slug) {
        $slug .= '-';
        $i = 0;

        while ($cek_slug) {
            $i++;
            $cek = $slug . $i;
            $cek_slug = query("SELECT slug FROM $tabel WHERE slug = '$cek'");
        }

        $slug .= $i;
    }

    return $slug;
}
