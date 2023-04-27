


function get_bookings() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/new_bookings.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('table-data').innerHTML = this.responseText;
    }
    xhr.send('get_bookings');

}

function remove_room(booking_id){
    if(confirm("Are you sure,"))
    {
        let data = new FormData();
        data.append('booking_id',booking_id);
        data.append('remove_room','');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/new_bookings.php", true);

             
    

        xhr.onload = function(){
        if(this.responseText == 1){
            alert('success','xac nhan dat phong');
            get_bookings();
        }
        else{
            alert('errorr','rooomm');
        }
        }

        xhr.send(data);
    };   
}
function cancel_booking(booking_id){
    if(confirm("Are you sure, you want to cancel this booking")){
        let data = new FormData();
        data.append('booking_id',booking_id);
        data.append('cancel_booking','');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/new_bookings.php", true);

        xhr.onload = function(){
        if(this.responseText == 1){
            alert('success','booking cancelled');
            get_bookings();
        }
        else{
            alert('errorr','rooomm');
        }
    }

        xhr.send(data);
    };   
}
function cancelb(booking_id){
    if(confirm("Are you sure, you want to cancel this booking")){
        let data = new FormData();
        data.append('booking_id',booking_id);
        data.append('cancelb','');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/new_bookings.php", true);

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














// function remove_user(user_id){
//     if(confirm("Are you sure, you want to delete this user")){
//         let data = new FormData();
//         data.append('user_id',user_id);
//         data.append('remove_user','');
//         let xhr = new XMLHttpRequest();
//     xhr.open("POST", "ajax/users.php", true);

//     xhr.onload = function(){
//         if(this.responseText == 1){
//             alert('success','User Remove');
//             get_users();
//         }
//         else{
//             alert('errorr','rooomm');
//         }
//     }

//     xhr.send(data);
//     };   
// }
// function search_user(username){
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "ajax/users.php", true);
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//     xhr.onload = function() {
//         document.getElementById('user-data').innerHTML = this.responseText;
//     }
//     xhr.send('search_user&name='+username);

// }

window.onload = function() {
    get_bookings();
}
