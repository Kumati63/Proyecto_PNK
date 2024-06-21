function validar(btn){
    if(btn!="Cancelar"){
        if(document.form.Nombre.value=="")
        {
            swal("Debe ingresar un nombre/titulo");
            document.form.Nombre.focus();
            return false;
        }

        if(document.form.Direccion.value=="")
        {
            swal("Debe ingresar una Dirección");
            document.form.Direccion.focus();
            return false;
        }
        if(document.form.Precio.value=="")
        {
            swal("Debe ingresar un Precio en CLP");
            document.form.Precio.focus();
            return false;
        }

        if(document.form.Descripcion.value=="")
        {
            swal("Debe ingresar una descripción");
            document.form.Descripcion.focus();
            return false;
        }
        if(document.form.Banos.value=="")
        {
            swal("Debe ingresar la cantidad de baños");
            document.form.Banos.focus();
            return false;
        }
        if(document.form.Dormitorios.value=="")
        {
            swal("Debe ingresar la cantodad de dormitorios");
            document.form.Dormitorios.focus();
            return false;
        }
        if(document.form.areaTotal.value=="")
        {
            swal("Debe ingresar el area total de la propiedad");
            document.form.areaTotal.focus();
            return false;
        }
        if(document.form.areaconstruida.value=="")
        {
            swal("Debe ingresar los m2 contruidos ");
            document.form.areaconstruida.focus();
            return false;
        }
        if(document.form.sectores.value=="")
            {
                swal("Debe ingresar un Sector");
                document.form.sectores.focus();
                return false;
            }
        if(document.form.tipo_prop.value=="")
        {
            swal("Debe ingresar un Tipo de Propiedad");
            document.form.tipo_prop.focus();
            return false;
        }
    
        if (document.form.File.value==""){
            swal("Debe ingresar minimo la Imagen Principal");
            document.form.File.focus();
            return false;
        }

        document.form.accion_btn.value=btn; 
        document.form.submit();
    }else{
        document.form.accion_btn.value=btn;
        document.form.submit();
    }
}
