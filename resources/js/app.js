import "./bootstrap";
import Swal from "sweetalert2";

window.alertanew = function (mensaje) {
    Swal.fire({
        icon: "info",
        title: "Carga completa.",
        html: mensaje,
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            const event = new CustomEvent("datosActualizados");
            window.dispatchEvent(event);
        }
      });
};


window.editar = function (id) {
    const event = new CustomEvent("editar", { detail: { id: id } });
    window.dispatchEvent(event);
};

window.editarmasivamente = function (id) {
    const event = new CustomEvent("editarmasivamente", { detail: { id: id } });
    window.dispatchEvent(event);
};

window.excelUploader = function () {
    return {
        async subirExcel() {
            const csrfToken = document
                .querySelector('[name="_token"]')
                .getAttribute("value");
            const formData = new FormData();
            formData.append("excel", this.$refs.archivo.files[0]);
            formData.append("_token", csrfToken);

            try {
                const response = await fetch("imports", {
                    method: "POST",
                    body: formData,
                });

                const data = await response.json();

                if (data.success) {
                    window.alertanew(data.message);
                } else {
                    window.alertanew("Error: " + data.message, "");
                }
            } catch (error) {
                window.alertanew("Error: " + error.message, "");
            }
        },
    };
};


Livewire.on('alertamensaje', function(icono) {
    Swal.fire({
        icon: icono[0],
        title: icono[1],
        html: icono[2],
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            const event = new CustomEvent("datosActualizados");
            window.dispatchEvent(event);
        }
      });
});

window.nuevocliente = function (id) {
    const event = new CustomEvent("nuevocliente");
    window.dispatchEvent(event);
};
