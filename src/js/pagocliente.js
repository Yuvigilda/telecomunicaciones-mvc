(function(){
    
    const serviciosInput = document.querySelector('#servicios');
    if(serviciosInput){
        let servicios = [];
        let serviciosFiltrados = [];
        const listadoServicios = document.querySelector('#listado-servicios');
        const servicioHidden = document.querySelector('[name="id_servicio"]');
        obtenerServicios();
        serviciosInput.addEventListener('input', buscarServicios);

        if(servicioHidden.value){
            (async()=>{
                const servicio = await obtenerServicio(servicioHidden.value);
                const {mbps} = servicio;
                //insertar el en html
                const servicioDOM = document.createElement('LI');
                servicioDOM.classList.add('listado-servicios__servicio','listado-servicios__servicio--seleccionado');
                servicioDOM.textContent = `${mbps}`;
                listadoServicios.appendChild(servicioDOM);
            })();
        }
        async function obtenerServicios() {
            const url = `/api/servicios`;
             const respuesta = await fetch(url);
             const resultado = await respuesta.json();
             formatearServicios(resultado);
        }
        async function obtenerServicio(id) {
            const url = `/api/servicio?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        }
        function formatearServicios(arrayServicios = []){
            servicios = arrayServicios.map(servicio => {
                return {
                    mbps : `${servicio.mbps.trim()}`,
                    id : servicio.id
                }
            })
            
        }
        function buscarServicios(e){
            const busqueda = e.target.value;
            if(busqueda.length > 3){
                const expresion = new RegExp(busqueda, "i");
                serviciosFiltrados = servicios.filter(servicio => {
                    if(servicio.nombre.toLowerCase().search(expresion) !== -1){
                        return servicio;
                    }
                })
                
            }else{
                serviciosFiltrados = [];
            }
            mostrarServicios();
        }
        function mostrarServicios(){
            while(listadoServicios.firstChild){
                listadoServicios.removeChild(listadoServicios.firstChild);
            }
            if(serviciosFiltrados.length > 0){
                serviciosFiltrados.forEach(servicio =>{
                const servicioHTML = document.createElement('LI');
                servicioHTML.classList.add('listado-servicios__servicio');
                servicioHTML.textContent = servicio.mbps;
                servicioHTML.dataset.servicioId = servicio.id;
                servicioHTML.onclick = seleccionarServicio;

                //añadir al dom
                listadoServicios.appendChild(servicioHTML);
            });
            }else{
                const noResultados = document.createElement('P');
                noResultados.classList.add('listado-servicios__no-resultado');
                noResultados.textContent = 'No hay resultados coincidentes';
                listadoServicios.appendChild(noResultados);
            }
            
        }
        function seleccionarServicio(e){
            const servicio = e.target;
            //remover la clase previa
            const servicioPrevio = document.querySelector('.listado-servicios__servicio--seleccionado');
            if(servicioPrevio){
                servicioPrevio.classList.remove('listado-servicios__servicio--seleccionado');
            }
            servicio.classList.add('listado-servicios__servicio--seleccionado');
           servicioHidden.value = servicio.dataset.servicioId;
        }
    }
})();