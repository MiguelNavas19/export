import './bootstrap';


window.cambioestatus = function (selectedValue, id, tipo){
    const event = new CustomEvent('cambio', { detail: { valor: selectedValue, id: id, tipo: tipo } });
    window.dispatchEvent(event);
}


window.editar = function (id){
    const event = new CustomEvent('editar', { detail: { id: id } });
    window.dispatchEvent(event);

}
