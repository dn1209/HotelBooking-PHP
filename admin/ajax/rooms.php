<?php
require('../inc/essentials.php');
require('../inc/db_config.php');

adminLogin();

if(isset($_POST['add_room'])){
    $frm_data = filteration($_POST);
    
    $flag = 0;
    $q = "INSERT INTO `rooms` ( `name`, `area`, `price`, `adult`, `children`, `description` ) VALUES (?,?,?,?,?,?)";
    $values = [$frm_data['name'],$frm_data['area'],$frm_data['price'],$frm_data['adult'],$frm_data['children'],$frm_data['desc']];
    
   
    if(insert($q,$values,'ssiiis')){
        echo 1;
    }else{
        echo 0;
    }
}
if(isset($_POST['get_all_rooms'])){
    $res = select("SELECT * FROM `rooms` WHERE `removed`=?",[0],'i');
    $i = 1;
    $data = "";
    while($row = mysqli_fetch_assoc($res)){

        if($row['status'] == 1){
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>hoạt động</button>";
        }else{
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>không hoạt động</button>";
        }
        $data.="
            <tr class='align-midle'>
                <td>$i</td>     
                <td>$row[name]</td>   
                <td>$row[area]</td>   
                <td>
                    <span class='badge rounded-pill bg-light text-dark'>
                        người lớn: $row[adult]
                    <span><br>
                    <span class='badge rounded-pill bg-light text-dark'>
                        trẻ con: $row[children]
                    <span>
                
                </td>   
                  
                <td>$row[price]</td>   
                <td>$row[description]</td>   

                <td>$status</td>      
                <td>
                <button type='button' onclick='edit_detail($row[id])' class='btn btn-dark shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-room'>
                SỬA     
                </button>
                <button type='button' onclick=\"room_images($row[id],'$row[name]')\" class='btn btn-warning shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#room-images'>
                HÌNH ẢNH     
                </button>
                <button type='button' onclick=\"remove_room($row[id])\" class='btn btn-danger shadow-none btn-sm' >
                XÓA     
                </button>
                     </td>
            <tr> ";
            $i++;
    }
    echo $data;


}
if(isset($_POST['get_room'])){
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `rooms`  WHERE   `id`=?", [$frm_data['get_room']],'i');

    $roomdata = mysqli_fetch_assoc($res1);
    $data = ["roomdata" => $roomdata];
    $data = json_encode($data);
    echo $data;
}
if(isset($_POST['edit_room'])){
    $frm_data = filteration($_POST);
    $flag = 0;
    $q="UPDATE `rooms` SET `name`=?,`area`=?,`price`=?,`adult`=?,`children`=?,`description`=? WHERE `id`=?";
    $values = [$frm_data['name'],$frm_data['area'],$frm_data['price'],$frm_data['adult'],$frm_data['children'],$frm_data['desc'],$frm_data['room_id']];
    if(update($q,$values,'ssiiisi')){
        echo 1;
    }
    else{
        echo 0;
    }

}
if(isset($_POST['add_image'])){
    $frm_data = filteration($_POST);
    $img_r =uploadImage($_FILES['image'],ROOMS_FOLDER);
    if($img_r == 'inv_img'){
        echo $img_r;
    }
    else if($img_r == 'inv_size'){
        echo $img_r;

    }
    else if($img_r == 'upd_failed'){
        echo $img_r;
    }
    else{
        $q = "INSERT INTO `room_images`( `room_id`, `image`) VALUES (?,?)";
        $values = [$frm_data['room_id'],$img_r];
        $res = insert($q,$values,'is');
        echo $res;
    }
}
if(isset($_POST['get_room_images'])){
    $frm_data = filteration($_POST);

    $res= select("SELECT * FROM `room_images` WHERE `room_id`=?",[$frm_data['get_room_images']],'i');

    $path = ROOMS_IMG_PATH;


    while($row = mysqli_fetch_assoc($res)){

        if($row['thumb'] == 1){
            $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-secondary shadow-none'>
            <i class='bi bi-trash'> Ảnh nền</i>
            </button>";
        }
        else{
            $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-secondary shadow-none'>
            <i class='bi bi-trash'>không phải ảnh nền</i>
            </button>";
        }

        echo<<<data
            <tr class='align-midle'>
                <td><img src='$path$row[image]' class='img-fluid'></td>
            <td>$thumb_btn</td>
            <td>
            <button onclick='rem_image($row[sr_no],$row[room_id])' class='btn btn-danger shadow-none'>
                <i class='bi bi-trash'> xóa</i>
                </button>
            </td>
            </tr>
        data;
    }    
    
}

if(isset($_POST['toggle_status'])){
    $frm_data = filteration($_POST);
    $q = "UPDATE `rooms` SET  `status`=?  WHERE  `id`=?  " ;
    $v = [$frm_data['value'],$frm_data['toggle_status']];

    if(update($q,$v,'ii')){
        echo 1;

    }
    else{
        echo 0;
    }
}
if(isset($_POST['rem_image'])){
    $frm_data = filteration($_POST);
    $values = [$frm_data['image_id'],$frm_data['room_id']];

    $q = "SELECT * FROM `room_images`  WHERE  `sr_no`=? AND `room_id`=?";
    $res= select($q,$values,'ii');
    $img=mysqli_fetch_assoc($res);

    if(deleteImage($img['image'],ROOMS_FOLDER)){
        $q = "DELETE FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
        $res = delete($q,$values,'ii');
        echo $res;
    }
    else{
        echo 0;
    }

}
if(isset($_POST['thumb_image'])){
    $frm_data = filteration($_POST);

    $pre_q = "UPDATE `room_images`  SET `thumb`=?  WHERE `room_id`=?";
    $pre_v=[0,$frm_data['room_id']];
    $pre_res = update($pre_q,$pre_v,'ii');

    $q="UPDATE `room_images`  SET `thumb`=?  WHERE `sr_no`=? AND `room_id`=?";
    $v = [1,$frm_data['image_id'],$frm_data['room_id']];
    $res = update($q,$v,'iii');

    echo $pre_res;
    

}


if(isset($_POST['remove_room'])){
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `room_images` WHERE `room_id`=?",[$frm_data['room_id']],'i');
    while($row = mysqli_fetch_assoc($res1)){
        deleteImage($row['image'],ROOMS_FOLDER);
    }
    $res2 = delete("DELETE FROM `room_images`  WHERE  `room_id`=?",[$frm_data['room_id']],'i');
    $res3 = update("UPDATE `rooms` SET `removed`=?  WHERE  `id`=?",[1,$frm_data['room_id']],'ii');

    if($res2 || $res3){
        echo 1;
    }
    else{
        echo 0;
    }
}
?>