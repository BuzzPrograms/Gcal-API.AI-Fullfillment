# Gcal-API.AI-Fullfillment

## What is this?

This is a Fullifllment for API.AI written in PHP used for GCal integration.

## Installation

If you want to install this on your own server make sure you have installed git, if not have a look at [Installing git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
then open the directory you want the files to be in and run:

````
git pull https://github.com/BuzzPrograms/Gcal-API.AI-Fullfillment.git
````

this wil download all the neccesary files from github

now we need to install composer, to do this run:

````
./composer-install
````

this is the install script from (https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md)

now we need to build our dependencies, run:

````
php composer install
````

this looks at the composer.json file and installs the dependecies listed there, after it finishes you should have a fully working installation

## setup

now we need to setup gcal auth. Use [this wizard](https://console.developers.google.com/start/api?id=calendar) to create or select a project in the Google Developers Console and automatically turn on the API. Click Continue, then Go to credentials.
On the Add credentials to your project page, click the Cancel button.
At the top of the page, select the OAuth consent screen tab. Select an Email address, enter a Product name if not already set, and click the Save button.
Select the Credentials tab, click the Create credentials button and select OAuth client ID.
Select the application type Other, enter any name you like, and click the Create button.
Click OK to dismiss the resulting dialog.
Click the file_download (Download JSON) button to the right of the client ID.
Move this file to your working directory and rename it client_secret.json.

after that run:

````
php setup.php
````

this wil ask you to open a link and paste the string you get back in the console
now you can add the web linkt to the working directory in the API.AI fullfillment tab and start using it in your agent
