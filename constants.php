<?php


define("TBL_ACCOUNT", "account");
define("COL_ACCOUNT_ID", "id");
define("COL_ACCOUNT_USERNAME", "username");
define("COL_ACCOUNT_PASSWORD", "password");
define("COL_ACCOUNT_EMAIL", "email");
define("COL_ACCOUNT_PHONE", "phone_number");
define("COL_ACCOUNT_ADDRESS", "address");
define("COL_ACCOUNT_NAME", "name");
define("COL_ACCOUNT_SURNAME", "surname");
define("COL_ACCOUNT_ROLE_ID","role_id");

define("TBL_ROLE", "admin");
define("COL_ROLE_ID", "id");
define("COL_ROLE_NAME", "role_name");

define("TBL_ARTICLE", "article");
define("COL_ARTICLE_ID", "id");
define("COL_ARTICLE_NAME", "name");
define("COL_ARTICLE_PRICE", "price");
define("COL_ARTICLE_DESCRIPTION", "description");
define("COL_ARTICLE_QUANTITY", "quantity");
define("COL_ARTICLE_WAY_OF_USE","way_of_use");
define("COL_ARTICLE_IMAGE","image");
define("COL_ARTICLE_TYPE","article_type");
define("COL_ARTICLE_DELETED","deleted");


define("TBL_ORDER", "order");
define("COL_ORDER_ID", "id");
define("COL_ORDER_AMOUNT", "total_amount");
define("COL_ORDER_ACCOUNT_ID", "account_id");

define("TBL_ORDERARTICLE", "order_article");
define("COL_ORDERARTICLE_ID", "id");
define("COL_ORDERARTICLE_QUANTITY", "quantity");
define("COL_ORDERARTICLE_PRICE", "price");
define("COL_ORDERARTICLE_AMOUNT", "total_amount");
define("COL_ORDERARTICLE_ORDERID", "order_id");
define("COL_ORDERARTICLE_ARTICLEID", "article_id");
