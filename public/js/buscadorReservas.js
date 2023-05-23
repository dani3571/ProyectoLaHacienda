document.addEventListener("keyup", e => {

    if (e.target.matches("#buscador")) {

        if (e.key === "Escape") e.target.value = ""

        document.querySelectorAll(".reserva").forEach(fruta => {

            fruta.id.toLowerCase().includes(e.target.value.toLowerCase())
                ? fruta.classList.remove("filtro")
                : fruta.classList.add("filtro")
        })

    }
    });

    document.addEventListener("change", e => {
    if (e.target.matches("#buscadorDate")) {
        if (e.key === "Escape") e.target.value = "";

        document.querySelectorAll(".reserva").forEach(fruta => {
            fruta.id.toLowerCase().includes(e.target.value.toLowerCase())
                ? fruta.classList.remove("filtro")
                : fruta.classList.add("filtro");
        });
    }
    });

    document.addEventListener("change", e => {
    if (e.target.matches("#buscadorDateSalida")) {
        if (e.key === "Escape") e.target.value = "";

        document.querySelectorAll(".reserva1").forEach(fruta => {
            fruta.id.toLowerCase().includes(e.target.value.toLowerCase())
                ? fruta.classList.remove("filtro")
                : fruta.classList.add("filtro");
        });
    }
    });