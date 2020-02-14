<?php


const IDEA_WED_SERVER = "apache";

//check dominio
if($_SERVER["HTTP_HOST"] == "idea4host.localdev")
    require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/config/idea4host.localdev/cfg.php");