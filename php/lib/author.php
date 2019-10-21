<?php
//load the author class
require_once("../Classes/autoload.php");

use Zachary22Sanchez\ObjectOrientedProject\Author;
use Ramsey\Uuid\Uuid;

//use the constructor to create a new author
$author = new Author ("fce9798a-e681-4559-957d-d57d03a7789a",
	"ddd0077f7f92a1e76fae9b3038c8ccb5",
	"http://google.com",
	"newauthor@email.com",
	"40f81924e1a468465a6c53b576122d148a3ca2cb7cec535fac827781ce38a502c354d68ab20148f88721a09146ee75644",
	"authorTest");

echo ($author->getAuthorId());
echo ($author ->getAuthorActivationToken());
echo ($author -> getAuthorAvatarUrl());
echo ($author->getAuthorEmail());
echo ($author-> getAuthorHash());
echo($author->getAuthorUsername());
