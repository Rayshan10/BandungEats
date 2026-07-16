const uploadArea = document.getElementById("uploadArea");
    const defaultUpload= uploadArea.innerHTML;
    const imageInput = document.getElementById("image");
    const imagePreview = document.getElementById("imagePreview");
    const previewContainer = document.getElementById("previewContainer");
    const removeImage = document.getElementById("removeImage");
    const changeImage = document.getElementById("changeImage");

    // Klik upload
    uploadArea.addEventListener("click", () => {
        imageInput.click();
    });

    changeImage.onclick=()=>{
            imageInput.click();
        }

    removeImage.onclick = () => {
        imageInput.value = "";
        imagePreview.src = "";
        previewContainer.classList.add("d-none");
        uploadArea.classList.remove("d-none");
    };

    // Fungsi preview
    function previewImage(file){

        if(!file.type.startsWith("image/")){
            Swal.fire({
                icon:'error',
                title:'File tidak valid',
                text:'Silakan upload file gambar.'
            });
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e){

            imagePreview.src = e.target.result;
            previewContainer.classList.remove("d-none");
            uploadArea.classList.add("d-none");

        }

        reader.readAsDataURL(file);
    }

    // Upload manual
    imageInput.addEventListener("change", function(){

        if(this.files.length){

            previewImage(this.files[0]);

        }

    });

    // =========================
    // DRAG & DROP
    // =========================

    uploadArea.addEventListener("dragover", function(e){

        e.preventDefault();
        e.stopPropagation();

        uploadArea.classList.add("drag-active");

        uploadArea.innerHTML=`

        <i class="bi bi-cloud-check upload-icon"></i>

        <h5>Lepaskan gambar di sini</h5>

        `;

    });

    uploadArea.addEventListener("dragleave", function(e){

        e.preventDefault();
        e.stopPropagation();

        uploadArea.classList.remove("drag-active");

        uploadArea.innerHTML=defaultUpload;

    });

    uploadArea.addEventListener("drop", function(e){

        e.preventDefault();
        e.stopPropagation();

        uploadArea.classList.remove("drag-active");

        const files = e.dataTransfer.files;

        if(files.length){

            imageInput.files = files;

            previewImage(files[0]);

        }

    });

    window.addEventListener("dragover", function(e){

        e.preventDefault();

    });

    window.addEventListener("drop", function(e){

        e.preventDefault();

    });

    const video = document.getElementById("video");
    const youtubePreview = document.getElementById("youtubePreview");

    video.addEventListener("input", function () {

        const url = this.value.trim();

        let id = "";

        if (url.includes("watch?v=")) {

            id = url.split("watch?v=")[1].split("&")[0];

        } else if (url.includes("youtu.be/")) {

            id = url.split("youtu.be/")[1].split("?")[0];

        }

        if (id !== "") {

            youtubePreview.src =
                "https://img.youtube.com/vi/" +
                id +
                "/hqdefault.jpg";

            youtubePreview.classList.remove("d-none");

        } else {

            youtubePreview.classList.add("d-none");

        }

    });

    // Check for success message
    const successMessage = document.body.getAttribute('data-success');
    if (successMessage) {
        Swal.fire({
            icon:'success',
            title:'Berhasil',
            text:'Resep berhasil ditambahkan.',
            timer:2000,
            showConfirmButton:false
        });
    }