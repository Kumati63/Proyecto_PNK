function validar(btn){
    if(btn!="Cancelar"){

        if(document.form.rut.value=="")
        {
            swal("Debe ingresar el rut");
            document.form.rut.focus();
            return false;
        }
        else{
            if(!Fn.validaRut(document.form.rut.value)){
                swal("Rut invalido, asegurece de que\n contenga como minimo el guión");
                document.form.rut.focus();
                return false;
            }
        }

        if(document.form.email.value=="")
        {
            swal("Debe ingresar un email");
            document.form.email.focus();
            return false;
        }else{
            if(!validateEmail())
            {
                swal("Email invalido");
                document.form.email.focus();
                return false;
            }
        }

        if(document.form.Telefono.value==""){
            swal("Debe ingresar un telefono");
            document.form.Nombre.focus();
            return false;
        }
    
        if (document.form.Nombre.value==""){
            swal("Debe ingresar un nombre");
            document.form.Nombre.focus();
            return false;
        }

        if(btn=="Enviar")
        {
            if(document.form.contrasena.value=="")
            {
                swal("Debe ingresar la contrasena");
                document.form.contrasena.focus();
                return false;
            }

            if(document.form.Repetir_contrasena.value=="")
            {
                swal("Debe ingresar la Repeticion de la contrasena");
                document.form.Repetir_contrasena.focus();
                return false;
            }

            if(document.form.contrasena.value!=document.form.Repetir_contrasena.value)
            {
                swal("Las contrasena deben ser iguales");
                document.form.contrasena.value="";
                document.form.Repetir_contrasena.value="";
                document.form.contrasena.focus();
                return false;
            }
        }

        if(document.form.nacimiento.value==""){
            swal("Debe ingresar su fecha de nacimiento");
            document.form.nacimiento.focus();
            return false;
        }
        
        if(document.form.tipo_usuario.value==9)
        {
            swal("Debe ingresar el tipo de usuario");
            document.form.tipo_usuario.focus();
            return false;
        }

        if(document.form.estado.value==9)
        {
            swal("Debe ingresar el tipo de estado");
            document.form.estado.focus();
            return false;
        }

        if(document.form.sexo.value=="Seleccionar")
        {
            swal("Debe ingresar su sexo");
            document.form.sexo.focus();
            return false;
        }

        document.form.accion_btn.value=btn;
        document.form.submit();
    }else{
        document.form.accion_btn.value=btn;
        document.form.submit();
    }
}
function validateEmail(){
    var emailField = document.getElementById('email');
    var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    if(validEmail.test(emailField.value)){
        return true;
    }else{
        return false;
    }
}

var Fn = {
    validaRut: function(rutCompleto) {
        // Remover puntos del RUT
        rutCompleto = rutCompleto.replace(/\./g, '');
        
        if (!/^[0-9]+-[0-9kK]{1}$/.test(rutCompleto))
            return false;
        var tmp = rutCompleto.split('-');
        var digv = tmp[1];
        var rut = tmp[0];
        if (digv == 'K') digv = 'k';
        return (Fn.dv(rut) == digv);
    },
    dv: function(T) {
        var M = 0,
            S = 1;
        for (; T; T = Math.floor(T / 10))
            S = (S + T % 10 * (9 - M++ % 6)) % 11;
        return S ? S - 1 : 'k';
    }
}
function validarLongitud() {
    var input = document.getElementById("telefono");
    var longitud = input.value.length;

    if (longitud > 12) {
        alert("El número de caracteres no puede superar los 12");
        return true;
    }
}


