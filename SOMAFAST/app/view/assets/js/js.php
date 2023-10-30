<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


<script>
   
   window.addEventListener("load", (event) => {

    setTimeout(function(){
      hiddenPreload();
    },1500);
  
});

function hiddenPreload(){
  var objPreload=document.getElementById('preloder');
  objPreload.style.display="none";
}

function validarFormulario() {
    var password1 = document.getElementById("p_pass").value;
    var password2 = document.getElementById("repeat_pass").value;

    if (password1 !== password2) {
        alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
        return false; // Evita que el formulario se envíe
    }

    // Si las contraseñas coinciden, el formulario se enviará normalmente
    return true;
}

/* $(document).ready(function() {
      // Función para hacer la barra de navegación fija al desplazarse
      $(window).scroll(function() {
         if ($(this).scrollTop() > 50) {
            $('.navbar').addClass('fixed-top');
         } else {
            $('.navbar').removeClass('fixed-top');
         }
      });
   }); */
</script> 
<script>
    // Función para ocultar elementos del header en los formularios
    function ocultarHeaderEnFormularios() {
        // Obtener los elementos del header que deseas ocultar por su ID
        const opcion1 = document.getElementById('1');
        const opcion2 = document.getElementById('2');
        const opcion3 = document.getElementById('3');

        // Ocultar los elementos del header en los formularios
        opcion1.style.display = 'none';
        opcion2.style.display = 'none';
        opcion3.style.display = 'none';
    }

    // Ejecutar la función al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        ocultarHeaderEnFormularios();
    });
</script>
<script>
    function vercontraseña(){
        const passwordInput = document.getElementById('p_pass');
        const repeatPasswordInput = document.getElementById('repeat_pass');
        const showPasswordCheckbox1 = document.getElementById('showPassword1');
        const showPasswordCheckbox2 = document.getElementById('showPassword2');

        showPasswordCheckbox1.addEventListener('change', function() {
            passwordInput.type = showPasswordCheckbox1.checked ? 'text' : 'password';
        });

        showPasswordCheckbox2.addEventListener('change', function() {
            repeatPasswordInput.type = showPasswordCheckbox2.checked ? 'text' : 'password';
        });
      }
    </script>
    <script>
    function showUsername() {
        alert("Estás conectado como <?php echo $username; ?>");
    }
</script>