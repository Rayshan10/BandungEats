const SwalSuccess = (title, text = '') => {
    Swal.fire({
        icon: 'success',
        title: title,
        text: text,
        confirmButtonColor: '#0d6efd'
    });
};

const SwalError = (title, text = '') => {
    Swal.fire({
        icon: 'error',
        title: title,
        text: text,
        confirmButtonColor: '#dc3545'
    });
};

const SwalInfo = (title, text = '') => {
    Swal.fire({
        icon: 'info',
        title: title,
        text: text,
        confirmButtonColor: '#0dcaf0'
    });
};

const SwalWarning = (title, text = '') => {
    Swal.fire({
        icon: 'warning',
        title: title,
        text: text,
        confirmButtonColor: '#ffc107'
    });
};

function SwalDelete(callback){

    Swal.fire({

        title:'Yakin ingin menghapus?',

        text:'Data yang dihapus tidak dapat dikembalikan.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#dc3545',

        cancelButtonColor:'#6c757d',

        confirmButtonText:'Ya, Hapus',

        cancelButtonText:'Batal'

    }).then((result)=>{

        if(result.isConfirmed){

            callback();

        }

    });

}

function SwalLogout(callback){

    Swal.fire({

        title:'Logout?',

        text:'Anda akan keluar dari akun.',

        icon:'question',

        showCancelButton:true,

        confirmButtonText:'Logout',

        cancelButtonText:'Batal',

        confirmButtonColor:'#0d6efd'

    }).then((result)=>{

        if(result.isConfirmed){

            callback();

        }

    });

}