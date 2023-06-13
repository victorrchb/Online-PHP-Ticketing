<?php

// Si l'evenement est annule, on redirige vers $directory
function isEventCanceled($event, $directory)
{
    if ($event["active"] == 0)
    {
        header("Location: " . $directory);
        exit();
    }
}