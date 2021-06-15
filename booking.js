//This file is server based and gets the data and sends to the database functioning file.
//It also displays what needs to be displayed to the user depending on the situation 

// Creates the XMLHttpRequest object to be used
var xhr = createRequest();

//This function checks if the required inputs have been put in
function requiredInputCheck(cname, phone, snumber, stname, ) {
    if (cname == "") {
        alert("Name must be filled out");
        return false;
    }
    if (phone == "") {
        alert("Phone must be filled out");
        return false;
    }
    if (snumber == "") {
        alert("Street number must be filled out");
        return false;
    }
    if (stname == "") {
        alert("Street name must be filled out");
        return false;
    }
    return true;
}

//validating int input
function isValidInt(phone, snumber) {
    var valid = true;
    var intRegex = /^[0-9]+$/;
    valid = intRegex.test(phone);
    if (valid) {
        valid = intRegex.test(snumber);
    }
    if (!valid) {
        alert("Numeric inputs are invalid. Try again.");
    }
    return valid;
}

//This function is used to validate the time and date as it can't be the current time and a previous date
function isValidDate(time, date) {
    var valid = true;
    var dateCheck = new Date(date + "T" + time);
    if (dateCheck < new Date) {
        alert("Used invalid Date/Time!");
        valid = false;

    }
    return valid;
}

//This function deals with getting the data and using it for checks and storing
function getData(dataSource, divID, cname, phone, unumber, snumber, stname, sbname, dsbname, time, date) {

    // Variable created to to be used to display messages later
    var obj = document.getElementById(divID);

    //Validating in the required inputs have been input
    if (requiredInputCheck(cname, phone, snumber, stname)) {
        //Validating time and date
        if (isValidDate(time, date) && isValidInt(phone, snumber)) {
            if (xhr) {
                //Creating request body to be used for the POST function
                var requestBody = "cname=" + encodeURIComponent(cname) + "& phone=" + encodeURIComponent(phone) + "& unumber=" + encodeURIComponent(unumber) + "& snumber=" +
                    encodeURIComponent(snumber) + "& stname=" + encodeURIComponent(stname) + "& sbname=" + encodeURIComponent(sbname) + "& dsbname=" + encodeURIComponent(dsbname) +
                    "& time=" + encodeURIComponent(time) + "& date=" + encodeURIComponent(date);

                //Calling the POST function for the storedata.php file which will deal with the database work
                xhr.open("POST", dataSource, true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {

                    if (xhr.readyState == 4 && xhr.status == 200) {
                        obj.innerHTML = xhr.responseText;
                    }
                }
                xhr.send(requestBody);
            } else {

                //If something goes wrong this will be displayed
                alert("Something is wrong, try again");
            }
        }
    } else {
        //Sending messaged to user to try again is inputs fail
        alert("Try again");
    }
}