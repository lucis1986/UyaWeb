<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$config["page_template"] = array(
    "vekada/head",
    "vekada/container_left",
    "vekada/container_right",
    "vekada/foot"
);
$config["template1"] = array(
    "vekada/head",
    "vekada/container_left",
    "vekada/container_right_content",
    "vekada/foot"
);
$config["template2"] = array(
    "vekada/head",
    "vekada/container_left",
    "vekada/container_right_empty",
    "vekada/foot"
);
$config["template3"]=array(
    "vekada/empty_view"
);

$config["product_template"]=array(
    "vekada/head",
    "vekada/product_left",
    "vekada/product_right",
    "vekada/foot"
);
$config["product_case_template"]=array(
    "vekada/head",
    "vekada/product_case_left",
    "vekada/product_case_right",
    "vekada/foot"
);
