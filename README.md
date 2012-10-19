# simple-mailer

A simple PHP mailer class and nothing special.

## Sample Usage

    <?php
    
    require_once('path/to/mailer.class.php');
    
    $m = new Mailer(); // instantiate mailer class
    
    $m->setTo('recipient@example.com'); // recipient (optional second parameter: recipient's name)
    $m->setFrom('sender@example.com'); // sender address (optional second parameter: sender's name)
    $m->setEnvelopeSenderAddress('sender@example.com'); // optional mail flag
    
    $m->setCC('carbon-copy@example.com'); // mail carbon copy (optional)
    $m->setBCC('blind-carbon-copy@example.com'); // mail blind carbon copy (optional)
    
    $m->setSubject('Hello'); // subject
    $m->setMessage("If you want something done right, do it yourself"); // mail body text
    
    $m->sendMail(); // send it!
    
    // -EOF-
    