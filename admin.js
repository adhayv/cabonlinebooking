// Creates the XMLHttpRequest object to be used
var xhr = createRequest();

function findData(dataSource, divID, bsearch) {

    // Variable created to to be used to display messages later
    var obj = document.getElementById(divID);
    if (xhr) {

        //Creating request body to be used for the POST function
        var requestBody = "bsearch=" + encodeURIComponent(bsearch);

        //Calling the POST function for the admin.php file which will deal with the database work
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
        alert("Something is wrong, try again.");
    }
}

//This function is used to change unassigned to assigned
function updateAssign(dataSource, divID, bookingRef) {
    // Variable created to to be used to display messages later
    var obj = document.getElementById(divID);
    if (xhr) {

        //Creating request body to be used for the POST function
        var requestBody = "bookingRef=" + encodeURIComponent(bookingRef);

        //Calling the POST function for the adminassign.php file which will deal with the database work
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
        alert("Something is wrong, try again.");
    }
}