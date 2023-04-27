


function get_bookings() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/booking_ap.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('table-data').innerHTML = this.responseText;
    }
    xhr.send('get_bookings');

}



function cancelb(booking_id){
    if(confirm("Are you sure, you want to cancel this booking")){
        let data = new FormData();
        data.append('booking_id',booking_id);
        data.append('cancelb','');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/booking_ap.php", true);

        xhr.onload = function(){
        if(this.responseText == 1){
            alert('success','booking cancelled');
            get_bookings();
        }
        else{
            alert('errorr','rooomm');
        }
    }
        alert('success','Room Remove');

        xhr.send(data);
    };   
}

window.onload = function() {
    get_bookings();
}
