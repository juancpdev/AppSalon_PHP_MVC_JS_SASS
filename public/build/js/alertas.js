function servicioCreado(e){e.preventDefault(),Swal.fire({icon:"question",title:"¿Desea guardar el servicio?",showCancelButton:!0,confirmButtonText:"Sí, guardar",cancelButtonText:"No, cancelar"}).then(t=>{t.isConfirmed&&e.target.form.submit()})}function servicioActualizado(e){e.preventDefault(),Swal.fire({icon:"question",title:"¿Desea actualizar el servicio?",showCancelButton:!0,confirmButtonText:"Sí, actualizar",cancelButtonText:"No, cancelar"}).then(t=>{t.isConfirmed&&e.target.form.submit()})}function confirmDelete(e,t){e.preventDefault(),Swal.fire({title:"Confirmación",text:"¿Estás seguro de que deseas eliminar este registro?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Sí, eliminar",cancelButtonText:"Cancelar"}).then(e=>{e.isConfirmed&&document.getElementById(t).submit()})}