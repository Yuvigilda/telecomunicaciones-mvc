(function(){
    
    const VendedoresInput = document.querySelector('#vendedores');
    if(VendedoresInput){
        let vendedores = [];
        let vendedoresFiltrados = [];
        const listadoVendedores = document.querySelector('#listado-vendedores');
        const vendedorHidden = document.querySelector('[name="id_proveedor"]');
        obtenerVendedores();
        VendedoresInput.addEventListener('input', buscarVendedores);

        if(vendedorHidden.value){
            (async()=>{
                const vendedor = await obtenerVendedor(vendedorHidden.value);
                const {nombre} = vendedor;
                //insertar el en html
                const  vendedorDOM = document.createElement('LI');
                vendedorDOM.classList.add('listado-vendedores__vendedor','listado-vendedores__vendedor--seleccionado');
                vendedorDOM.textContent = `${nombre}`;
                obtenerVendedores.appendChild(vendedorDOM);
            })();
        }
        async function obtenerVendedores() {
            const url = `/api/vendedores`;
             const respuesta = await fetch(url);
             const resultado = await respuesta.json();
             formatearVendedores(resultado);
        }
        async function obtenerVendedor(id) {
            const url = `/api/vendedor?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        }
        function formatearVendedores(arrayVendedores = []){
            vendedores = arrayVendedores.map(vendedor => {
                return {
                    nombre : `${vendedor.nombre.trim()}`,
                 
                    id : vendedor.id
                }
            })
            
        }
        function buscarVendedores(e){
            const busqueda = e.target.value;
            if(busqueda.length > 3){
                const expresion = new RegExp(busqueda, "i");
                vendedoresFiltrados = vendedores.filter(vendedor => {
                    if(vendedor.nombre.toLowerCase().search(expresion) !== -1){
                        return vendedor;
                    }
                })
                
            }else{
                vendedoresFiltrados = [];
            }
            mostrarVendedores();
        }
        function mostrarVendedores(){
            while(listadoVendedores.firstChild){
                listadoVendedores.removeChild(listadoVendedores.firstChild);
            }
            if(vendedoresFiltrados.length > 0){
                vendedoresFiltrados.forEach(vendedor =>{
                const vendedorHTML = document.createElement('LI');
                vendedorHTML.classList.add('listado-vendedores__vendedor');
                vendedorHTML.textContent = vendedor.nombre;
                vendedorHTML.dataset.vendedorId = vendedor.id;
                vendedorHTML.onclick = seleccionarVendedor;

                //añadir al dom
                listadoVendedores.appendChild(vendedorHTML);
            });
            }else{
                const noResultados = document.createElement('P');
                noResultados.classList.add('listado-vendedores__no-resultado');
                noResultados.textContent = 'No hay resultados coincidentes';
                listadoVendedores.appendChild(noResultados);
            }
            
        }
        function seleccionarVendedor(e){
            const vendedor = e.target;
            //remover la clase previa
            const vendedorPrevio = document.querySelector('.listado-vendedores__vendedor--seleccionado');
            if(vendedorPrevio){
                vendedorPrevio.classList.remove('listado-vendedores__vendedor--seleccionado');
            }
            vendedor.classList.add('listado-vendedores__vendedor--seleccionado');
            vendedorHidden.value = vendedor.dataset.vendedorId;
        }
    }
})();