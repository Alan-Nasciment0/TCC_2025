<script>
        function toggleAparecerMenu() {
            document.getElementById("menuDropDown").classList.toggle("mostrarMenu");
        }

        // Fecha o dropdown se clicar fora
        window.onclick = function (event) {
            if (!event.target.closest('.dropDown')) {
                const dropdowns = document.getElementsByClassName("containerMenu");
                for (let i = 0; i < dropdowns.length; i++) {
                    dropdowns[i].classList.remove("mostrarMenu");
                }
            }
        }
    </script>