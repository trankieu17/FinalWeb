function updateDeleteFileDialog(filename, id){
    let label = $('#file-to-delete');
    let idPlace = $('#idNV');

    label.html(filename);
    idPlace.val(id);
}


function update_name_for_nop_task(tenTask){
    let nameTask = $('#nameToNop');

    nameTask.val(tenTask);
}

function update_name_delete_task(nameTask){
    let Task = $('#task-to-delete');
    let toDel = $('#tenToDel');
    Task.html(nameTask);
    toDel.val(nameTask);
}

function add_value_id_edit(id, name, desc, user, dead){
    let idEdit = $('#idToEdit');
    let nameEdit = $('#name');
    let descEdit = $('#desc');
    let userEdit = $('#user');
    let deadEdit = $('#dead');
    idEdit.val(id);
    nameEdit.val(name);
    descEdit.val(desc);
    userEdit.val(user);
    deadEdit.val(dead);
}

function update_name_for_duyet_task(nameTask){
    let nameToDuyet = $('#nameToDuyet');
    nameToDuyet.val(nameTask);
}

function update_name_duyet_nghi(name, id, songay){
    let nameNV = $('#nhanVienCanDuyet');
    let idDon = $('#id')
    let name1 = $('#nameNvToDuyet');
    let songay1 = $('#songay')

    nameNV.html(name);
    idDon.val(id);
    name1.val(name);
    songay1.val(songay)
}

function update_name_reject_nghi(name, id){
    let nameNV = $('#nhanVienCanReject');
    let idDon = $('#idreject')
    let name1 = $('#nameNvToReject');

    name1.val(name)
    nameNV.html(name);
    idDon.val(id);
}

function update_field_edit_phongban(namePB, mota, maPB){
    let namePBEdit = $('#namePBEdit');
    let maPBEdit = $('#maPBToEdit');
    let descPB = $('#descPB');
    
    namePBEdit.val(namePB);
    maPBEdit.val(maPB);
    descPB.val(mota);
}

function update_confirm_reset_password(username, nameNV){
    // console.log(username)   
    let nameReset = $('#name-to-reset-password')
    let pwdReset = $('#pwd')
    let nameNVToReset = $('#nameNVToReset')

    nameReset.html(nameNV)
    pwdReset.val(username)
    nameNVToReset.val(username)
}

function success(message) {
    let b = document.querySelector(".details");
    b.insertAdjacentHTML('beforeend', `<span>${message}</span>`)
}