document.addEventListener("DOMContentLoaded", function() {
    const fileInput = document.getElementById("photo");
    const label = document.getElementById("uploadButton");
    const previewContainer = document.createElement("div");
    previewContainer.id = "previewContainer";
    label.parentNode.insertBefore(previewContainer, label);

    if (fileInput) {
        fileInput.addEventListener("change", function() {
            if (fileInput.files && fileInput.files[0]) {
                const file = fileInput.files[0];
                const fileName = file.name;
                label.innerText = fileName;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.createElement("img");
                    previewImage.src = e.target.result;
                    previewImage.style.maxWidth = "500px";
                    previewImage.style.maxHeight = "500px";

                    previewContainer.innerHTML = "";
                    previewContainer.appendChild(previewImage);
                };
                reader.readAsDataURL(file);
            } else {
                label.innerText = "Загрузить изображение";
                previewContainer.innerHTML = "";
            }
        });
    }
});
