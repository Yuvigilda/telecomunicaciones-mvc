(function(){
    
    const clientesInput = document.querySelector('#clientes');
    if(clientesInput){
        let clientes = [];
        let clientesFiltrados = [];
        const listadoClientes = document.querySelector('#listado-clientes');
        const clienteHidden = document.querySelector('[name="id_cliente"]');
        obtenerClientes();
        clientesInput.addEventListener('input', buscarClientes);

        if(clienteHidden.value){
            (async()=>{
                const cliente = await obtenerCliente(clienteHidden.value);
                const {nombre} = cliente;
                //insertar el en html
                const clienteDOM = document.createElement('LI');
                clienteDOM.classList.add('listado-clientes__cliente','listado-clientes__cliente--seleccionado');
                clienteDOM.textContent = `${nombre}`;
                listadoClientes.appendChild(clienteDOM);
            })();
        }
        async function obtenerClientes() {
            const url = `/api/clientes`;
             const respuesta = await fetch(url);
             const resultado = await respuesta.json();
             formatearClientes(resultado);
        }
        async function obtenerCliente(id) {
            const url = `/api/cliente?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        }
        function formatearClientes(arrayClientes = []){
            clientes = arrayClientes.map(cliente => {
                return {
                    nombre : `${cliente.nombre.trim()}`,
                    id : cliente.id
                }
            })
            
        }
        function buscarClientes(e){
            const busqueda = e.target.value;
            if(busqueda.length > 3){
                const expresion = new RegExp(busqueda, "i");
                clientesFiltrados = clientes.filter(cliente => {
                    if(cliente.nombre.toLowerCase().search(expresion) !== -1){
                        return cliente;
                    }
                })
                
            }else{
                clientesFiltrados = [];
            }
            mostrarClientes();
        }
        function mostrarClientes(){
            while(listadoClientes.firstChild){
                listadoClientes.removeChild(listadoClientes.firstChild);
            }
            if(clientesFiltrados.length > 0){
                clientesFiltrados.forEach(cliente =>{
                const clienteHTML = document.createElement('LI');
                clienteHTML.classList.add('listado-clientes__cliente');
                clienteHTML.textContent = cliente.nombre;
                clienteHTML.dataset.clienteId = cliente.id;
                clienteHTML.onclick = seleccionarCliente;

                //añadir al dom
                listadoClientes.appendChild(clienteHTML);
            });
            }else{
                const noResultados = document.createElement('P');
                noResultados.classList.add('listado-clientes__no-resultado');
                noResultados.textContent = 'No hay resultados coincidentes';
                listadoClientes.appendChild(noResultados);
            }
            
        }
        function seleccionarCliente(e){
            const cliente = e.target;
            //remover la clase previa
            const clientePrevio = document.querySelector('.listado-clientes__cliente--seleccionado');
            if(clientePrevio){
                clientePrevio.classList.remove('listado-clientes__cliente--seleccionado');
            }
            cliente.classList.add('listado-clientes__cliente--seleccionado');
           clienteHidden.value = cliente.dataset.clienteId;
        }
    }
})();