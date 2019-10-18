# safe-landings
Safely collect private data from landing pages, using cryptography

Safe Landings is a simple Php application aiming to provide better security for data collected through landing pages.
This demo encrypts phone and email of the subscribers, making it very hard for an attacker to leak private data, even if he/she gains access to the database.
At the same time, an hypotetical backoffice user is allowed to view/export all the data and search for a specific email or phone in the database without hassle.

Safe Landings relies on LibSodium library. 

The optimal architecture for this application requires a separate server for the database, so that data is physically separated from the private key needed to decrypt it.
