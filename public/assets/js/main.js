// Ver comentarios
let btnViewComments = document.querySelectorAll('.view-comentarios');

const viewComents = (e) => {
    let comentarios = e.target.parentElement.nextElementSibling;
    if(e.target.textContent == 'Ver Comentarios') {
        e.target.textContent = 'Ocultar Comentarios';
    } else {
        e.target.textContent = 'Ver Comentarios';
    }
    comentarios.classList.toggle('comentarios-container_active');
}

btnViewComments.forEach(element => {
    element.addEventListener('click', viewComents)    
});

// DRAG DROP
const fileInput = document.getElementById('form-input_file'),
      dropZone = document.getElementById('drop-zone'),
      form = document.getElementById('form');
      
if(dropZone != null) {
    dropZone.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', (e) => {
        eliminarImg.style.display = "block";
        printInResult();
    });
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('drop-zone_active')
    });
    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drop-zone_active')
    });
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drop-zone_active')
        fileInput.files = e.dataTransfer.files;
        eliminarImg.style.display = "block";
        printInResult();
    });
    form.addEventListener('submit', (e) => {
        if (fileInput.files.length == 0) {
            e.preventDefault();
        }
    });
    
    // Subir imágenes
    let contenedorImg = document.querySelector('.input-image');
    let eliminarImg = document.querySelector('.eliminar-img');

    eliminarImg.addEventListener('click', () => {
        contenedorImg.removeChild(document.querySelector('.input-image > img'));
        eliminarImg.style.display = "none";
    });
    
    function printInResult() {
        for (const file of fileInput.files) {
            const fileReader = new FileReader()
            fileReader.readAsDataURL(file);
            let img = document.createElement('img');
            fileReader.addEventListener('load', (e) => {
                img.setAttribute('src', e.target.result);
            });
            fileReader.addEventListener('loadend', (e) => {
                contenedorImg.appendChild(img);
            });
        }
    }
}


// QUITAR ALERT
let wrapper = document.querySelector('.wrapper');
let alertPokemon = document.querySelector('.alert');

if(alertPokemon != null) {
    setTimeout(function(){ wrapper.removeChild(alertPokemon) }, 4000);
}