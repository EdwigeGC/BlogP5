# Blog P5

This is a professional blog created "from scratch" to validate the « PHP/Symfony developer» training with OpenClassrooms. Creation of administration and public interfaces programmed with PHP language and MVC architecture. 

## Getting started
### Prerequisites

Installation of the project, requires:

  *  PHP version 7.3.8
  *  HTML 5
  *  CSS 3
  *  Bootstrap 4.5.3
  *  MySQL version 5.7.26
  *  Apache Server 2.2.34
  *  Composer 2.0
  *  Twig 2.13
  *  PHPMailer 6.2
  *  phpDocumentor 3.0

### Installation
 1. Copy the link on GitHub and clone it on your local repository
 2. Install Composer
 3. Create a class in App/utilities named __DatabaseConstant.php__ like this:

```
<?php 
namespace App\utilities;

final class DatabaseConstant {
    const HOST= '';
    const DBNAME='';
    const USER='';
    const PASS='';
}
```
and write the parameter of your database between each ' '. 

4. Create your database in MySQL named __EG-blog__ and import the file database.sql

## Features
### Public interface
  *  display posts’ list
  *  read a post
  *  contact form via phpmailer
  *  log in/log out
  *  write a comment in a post

### Admin interface
  *  add a post
  *  update a post
  *  delete a post
  *  validate a comment

## Credit
banner-image: Canva.com
