# satellite [![Code Climate](https://codeclimate.com/github/mashiox/satellite/badges/gpa.svg)](https://codeclimate.com/github/mashiox/satellite)
A small revolving WoW API client, and it's controlling client.

Satellite is a small procedural World of Warcraft API client for calling various API methods. 

Houston is Satellite's controlling client. Houston needs to work with at least 1 or many Satellite clients. 
For each API call that Houston needs to make, it will round-robin through the defined satellite clients in it's MySQL table.
