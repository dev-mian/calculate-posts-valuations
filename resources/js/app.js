require('./bootstrap');

let target = document.querySelector('#download-csv-file');
if(target) {
    target.addEventListener('click', function() {
        document.querySelector("#overlay").style.display = "flex";

        fetch('/file/csv')
            .then(function(response) {
                if(response.status === 200) {
                    window.location.href = '/file/csv/download';
                } else {
                    console.log('Respuesta de red OK pero respuesta HTTP no OK');
                }
                document.querySelector("#overlay").style.display = "none";
            })
            .catch(function(error) {
                console.log('Hubo un problema con la petición Fetch:' + error.message);
            });

    });
}