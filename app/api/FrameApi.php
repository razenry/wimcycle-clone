<?php

class FrameApi
{
    public static function get($apiKey)
    {
        $key = "access";
        if ($apiKey == $key) {
            return FrameModel::all();
        }else {
            return "Invalid API Key";
        }
    }
}
