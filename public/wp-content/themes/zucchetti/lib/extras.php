<?php
/**
 * Theme extra functions
 */
foreach (glob(__DIR__ . "/extras/*.php") as $filename) {
    include $filename;
}