function validar_signup(){
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

    if(document.form.telefono.value==""){
        swal("Debe ingresar un telefono");
        document.form.telefono.focus();
        return false;
    }

    if (document.form.nombre.value==""){
        swal("Debe ingresar un nombre");
        document.form.nombre.focus();
        return false;
    }

    
    if(document.form.contrasena.value=="")
    {
        swal("Debe ingresar una contrasena");
        document.form.contrasena.focus();
        return false;
    }

    if(document.form.propiedad.value==""){
        swal("Debe ingresar una propiedad");
        document.form.propiedad.focus();
        return false;
    }

    if(document.form.nacimiento.value==""){
        swal("Debe ingresar su fecha de nacimiento");
        document.form.nacimiento.focus();
        return false;
    }
    

    if(document.form.sexo.value=="Seleccionar")
    {
        swal("Debe ingresar su sexo");
        document.form.sexo.focus();
        return false;
    }

    document.form.submit();
}
function validateEmail(){
var emailField = document.form.email;
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