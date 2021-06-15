README
Name:Adhay Vraich
ID: 15887053

This program is a web-based taxi booking system called CabsOnline. It allows users to book taxi services
from their web connected devices. This program was made through the use of Ajax(JavaScript/HTML, XMLHttpRequest, CSS, and DOM), MySQL and PHP.

Included files:
    admin.html 
    admin.js
    admin.php
    admingassign.php
    booking.html
    booking.js
    booking.php
    mysqlcommand.txt
    readme.txt
    styles.css
    xhr.js

booking.html:
This runs the webpage for booking a cab. It allows the user to input multiple things which are then passed 
onto booking.js.
booking.js:
This file takes the data from booking.html and passes it to booking.php after doing checks for time and data
validation alongside required validation and integer validation.
booking.php:
This creates a table if needed and then enters the data which the user inputs. It then sends back the information
to the user to give conformation for what they booked.

admin.html:
This runs the admin.html webpage which allows the admin to handle customer cab assigning.
admin.js:
This file is called from admin.html and gets the data and further sends the data to the admin.php file to handle the database
queries.
admin.php:
This file finds the data that is entered in the admin.html file. It then creates a table to display the 
customer data. If nothing is entered all records within 2 hours of now and that are unassigned show up.
adminassign.php
When the assign button is clicked when available, it will change the status to assigned in the database and how it
on the UI as well.

xhr.js:
This creates a XMLHttpRequest object to be used.
styles.css:
This file is just for design purposes.

Instructions:
Booking Component
The booking.html should be run first. In the webpage, data can be entered as per the users request.
When the "Book" button is clicked, the data will be sent to booking.js which will then run the storedata.php
file. This file will try to create a table and store the data the user has enter and send back
conformation information so the user can check the booked time, data and their reference number.

Admin Component
THe admin.html should be run. In the webpage a value can be entered and if it matches with a booking reference
it will display the corresponding row. If no input is entered and the search button is clicked. All the customers
that are unassigned and within 2 hours of the search period will appear. They will show up with an assign button
next to each row which can then be pressed to change unassigned to assigned.

