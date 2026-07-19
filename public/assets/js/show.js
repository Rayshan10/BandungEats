const recipeImage=document.getElementById("recipeImage");

const modalImage=document.getElementById("modalImage");

if(recipeImage){

    recipeImage.onclick=()=>{

        modalImage.src=recipeImage.src;

        new bootstrap.Modal(
            document.getElementById("imageModal")
        ).show();

    }

}

const deleteButton=document.getElementById("deleteButton");

if(deleteButton){
    
    deleteButton.onclick=()=>{
        Swal.fire({
            title:"Hapus resep?",
            text:"Data tidak bisa dikembalikan.",
            icon:"warning",
            
            showCancelButton:true,
            
            confirmButtonColor:"#dc3545",
            confirmButtonText:"Ya, Hapus"
        
        }).then((result)=>{
            if(result.isConfirmed){
                document.getElementById("deleteForm").submit();
            }
        });
    }
}