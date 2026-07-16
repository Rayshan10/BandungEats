// =====================================
// Element
// =====================================

const uploadArea = document.getElementById("uploadArea");
const imageInput = document.getElementById("image");
const imagePreview = document.getElementById("imagePreview");
const previewContainer = document.getElementById("previewContainer");

const changeImage = document.getElementById("changeImage");
const removeImage = document.getElementById("removeImage");

const uploadTitle = document.getElementById("uploadTitle");
const uploadSubtitle = document.getElementById("uploadSubtitle");

const videoInput = document.getElementById("video");
const youtubePreview = document.getElementById("youtubePreview");

// =====================================
// Preview Image
// =====================================

function previewImage(file) {

    if (!file) {

        return;

    }

    if (!file.type.startsWith("image/")) {

        Swal.fire({

            icon: "error",

            title: "Upload gagal",

            text: "File harus berupa gambar."

        });

        return;

    }

    const reader = new FileReader();

    reader.onload = function (e) {

        imagePreview.src = e.target.result;

        previewContainer.classList.remove("d-none");

        uploadArea.classList.add("d-none");

    }

    reader.readAsDataURL(file);

}

// =====================================
// Upload Manual
// =====================================

if (uploadArea) {

    uploadArea.addEventListener("click", () => {

        imageInput.click();

    });

}

imageInput.addEventListener("change", () => {

    if (imageInput.files.length) {

        previewImage(imageInput.files[0]);

    }

});

// =====================================
// Change Image
// =====================================

if (changeImage) {

    changeImage.addEventListener("click", () => {

        imageInput.click();

    });

}

// =====================================
// Remove Image
// =====================================

if (removeImage) {

    removeImage.addEventListener("click", () => {

        imageInput.value = "";

        imagePreview.src = "";

        previewContainer.classList.add("d-none");

        uploadArea.classList.remove("d-none");

    });

}

// =====================================
// Drag & Drop
// =====================================

["dragenter", "dragover"].forEach(eventName => {

    uploadArea.addEventListener(eventName, e => {

        e.preventDefault();

        e.stopPropagation();

        uploadArea.classList.add("drag-active");

        uploadTitle.innerText = "Lepaskan gambar di sini";

        uploadSubtitle.innerText = "";

    });

});

["dragleave", "drop"].forEach(eventName => {

    uploadArea.addEventListener(eventName, e => {

        e.preventDefault();

        e.stopPropagation();

        uploadArea.classList.remove("drag-active");

        uploadTitle.innerText = "Drag & Drop Foto";

        uploadSubtitle.innerText = "atau klik untuk memilih gambar";

    });

});

uploadArea.addEventListener("drop", e => {

    const files = e.dataTransfer.files;

    if (files.length) {

        imageInput.files = files;

        previewImage(files[0]);

    }

});

document.addEventListener("dragover", e => {

    e.preventDefault();

});

document.addEventListener("drop", e => {

    e.preventDefault();

});

// =====================================
// Youtube Preview
// =====================================

if (videoInput) {

    videoInput.addEventListener("input", () => {

        const url = videoInput.value.trim();

        let id = "";

        if (url.includes("watch?v=")) {

            id = url.split("watch?v=")[1].split("&")[0];

        }

        else if (url.includes("youtu.be/")) {

            id = url.split("youtu.be/")[1].split("?")[0];

        }

        if (id) {

            youtubePreview.src =
                `https://img.youtube.com/vi/${id}/hqdefault.jpg`;

            youtubePreview.classList.remove("d-none");

        }

        else {

            youtubePreview.classList.add("d-none");

        }

    });

}

// =====================================
// Success Alert
// =====================================

const success = document.body.dataset.success;

if (success) {

    Swal.fire({

        icon: "success",

        title: "Berhasil",

        text: success,

        timer: 1800,

        showConfirmButton: false

    });

}

// =====================================
// Preview Resep
// =====================================

const previewBtn = document.getElementById("previewRecipe");

if (previewBtn) {

    previewBtn.addEventListener("click", () => {

        document.getElementById("previewTitle").innerText =
            document.querySelector("[name='title']").value;

        document.getElementById("previewCategory").innerText =
            document.querySelector("[name='category']").value;

        document.getElementById("previewTime").innerText =
            "⏱ " + document.querySelector("[name='time']").value;

        document.getElementById("previewDifficulty").innerText =
            "⭐ " + document.querySelector("[name='difficulty']").value;

        document.getElementById("previewServings").innerText =
            "🍽 " + document.querySelector("[name='servings']").value;

        document.getElementById("previewDescription").innerText =
            document.querySelector("[name='description']").value;

        document.getElementById("previewIngredients").innerText =
            document.querySelector("[name='ingredients']").value;

        document.getElementById("previewSteps").innerText =
            document.querySelector("[name='steps']").value;

        // Preview Foto
        if (imagePreview.src) {

            document.getElementById("previewImage").src =
                imagePreview.src;

            document.getElementById("previewImage")
                .classList.remove("d-none");

        }

        // Preview Thumbnail YouTube
        if (youtubePreview.src) {

            document.getElementById("previewYoutube").src =
                youtubePreview.src;

            document.getElementById("previewYoutube")
                .classList.remove("d-none");

        }

        new bootstrap.Modal(
            document.getElementById("previewModal")
        ).show();

    });

}

// =====================================
// Existing Image (Edit Page)
// =====================================

if (imagePreview && imagePreview.src && imagePreview.getAttribute("src") !== "") {

    previewContainer.classList.remove("d-none");

    uploadArea.classList.add("d-none");

}

// =====================================
// Existing YouTube (Edit Page)
// =====================================

if (videoInput && videoInput.value.trim() !== "") {

    videoInput.dispatchEvent(new Event("input"));

}