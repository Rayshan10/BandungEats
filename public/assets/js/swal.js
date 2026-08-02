/*
|--------------------------------------------------------------------------
| BandungEats Notification Center
|--------------------------------------------------------------------------
*/
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2200,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

/*
|--------------------------------------------------------------------------
| TOAST
|--------------------------------------------------------------------------
*/
function ToastSuccess(message){
    Toast.fire({
        icon:'success',
        title:message
    });
}

function ToastError(message){
    Toast.fire({
        icon:'error',
        title:message
    });
}

function ToastInfo(message){
    Toast.fire({
        icon:'info',
        title:message
    });
}

function ToastWarning(message){
    Toast.fire({
        icon:'warning',
        title:message
    });
}

/*
|--------------------------------------------------------------------------
| MODAL
|--------------------------------------------------------------------------
*/
function SwalSuccess(title,text=''){
    Swal.fire({
        icon:'success',
        title:title,
        text:text,
        confirmButtonColor:'#0d6efd'
    });
}

function SwalError(title,text=''){
    Swal.fire({
        icon:'error',
        title:title,
        text:text,
        confirmButtonColor:'#dc3545'
    });
}

function SwalInfo(title,text=''){
    Swal.fire({
        icon:'info',
        title:title,
        text:text,
        confirmButtonColor:'#0dcaf0'
    });
}

function SwalWarning(title,text=''){
    Swal.fire({
        icon:'warning',
        title:title,
        text:text,
        confirmButtonColor:'#ffc107'
    });
}

/*
|--------------------------------------------------------------------------
| CONFIRM DELETE
|--------------------------------------------------------------------------
*/
function SwalDelete(callback){
    Swal.fire({
        title:'Yakin ingin menghapus?',
        text:'Data yang dihapus tidak dapat dikembalikan.',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Ya, Hapus',
        cancelButtonText:'Batal',
        confirmButtonColor:'#dc3545',
        cancelButtonColor:'#6c757d',
        reverseButtons:true

    }).then((result)=>{
        if(result.isConfirmed){
            callback();
        }
    });
}

/*
|--------------------------------------------------------------------------
| CONFIRM LOGOUT
|--------------------------------------------------------------------------
*/
function SwalLogout(callback){
    Swal.fire({
        title:'Logout',
        text:'Apakah Anda yakin ingin keluar?',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'Logout',
        cancelButtonText:'Batal',
        confirmButtonColor:'#0d6efd',
        cancelButtonColor:'#6c757d',
        reverseButtons:true

    }).then((result)=>{
        if(result.isConfirmed){
            callback();
        }
    });
}