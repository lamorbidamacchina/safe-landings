# safe-landings
Safely collect private data from landing pages, using cryptography

Safe Landings is a simple Php application demo aiming to provide better security for data collected through landing pages.
This demo encrypts phone and email of the subscribers, making it very hard for an attacker to leak private data, even if he/she gains access to the database.
At the same time, an hypotetical backoffice user is allowed to view/export all the data and search for a specific email or phone in the database without hassle.

Safe Landings relies on LibSodium library. 

The optimal architecture for this application requires a separate server for the database, so that data is physically separated from the private key needed to decrypt it. Please also consider to move your keys outside the public folder of your server for better security.

## Requirements

* An Apache web server
* Php 7.1 or more
* Mysql or MariaDB

## Installation

Download or pull from git.
* Import /_sql/subscribers.sql to your Mysql database
* Remove /_sql/ folder
* Upload files and folders to your server
* Visit  /generate_key.php and write down your keys somewhere safe
* Edit /includes/config-sample.php with your database data (l.20-23) and your keys (l.50-51)
* Save, rename file to config.php and upload in /includes folder
* Visit index.php and start saving encrypted records
* Visit /backoffice/index.php to use the backoffice demo page
