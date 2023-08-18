<?php 

$consulta= "SELECT '*' as Abrir , e.TipoEntidad
			,e.Entidad	as Entidad
			,e.CodLegal	as Rut
			,Replace(e.RazonSocial, ',', ' ')	as NombreCompleto
			,e.TipoContrato	as TipoContrato
			,case when isnull(e.CentroCosto,'')='' then 'SIN CECO' else e.CentroCosto end	as CentroCosto
			,isnull(cc.Descripcion,'SIN CECO')	as CecoDesc
			,e.Cargo		as Cargo
			,c.Descripcion	as CargoDesc
			,e.Area			as Area
			,e.FechaHasta	as FechaTermino
			,e.CausaTermino as CausaTermino
			,e.FormaPago	as FormaPago
			,e.Banco		as Banco
			,e.CuentaBanco	as CtaBanco
			,e.Clasif1		as Prevision
			,e.Clasif2		as Salud
			,e.Clasif12		as Estudios
			,e.Clasif11		as Nacionalidad
			,e.Valor1		as AExEmpleador
			,e.Clasif7		as TipoTrabPrev
			,e.Clasif17		as Recontrata
			,e.Sexo			as Sexo
			,e.FechaNacimiento as FechaNacimiento
			,e.EstadoCivil	as EstadoCivil
			,e.Direccion	as Direccion
			,e.Ciudad		as Ciudad
			,ci.Descripcion as CiudadDesc
			,e.Comuna		as Comuna
			,co.Descripcion as ComunaDesc
			,e.Fono         as Telefono
			,e.Email        as Mail		
from		Entidad e 
left join	(select ev.Empresa, ev.Entidad, ev.Monto, max(ev.FechaDesde)Fecha  From EntidadVal ev WITH(NOLOCK) where	ev.Empresa='«$Empresa»'	and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='anticipo.variablesi' group by ev.Empresa,ev.Entidad,ev.Monto) a ON a.Empresa=e.Empresa and e.Entidad=a.Entidad
left join	Codigo c WITH(NOLOCK)		on	e.Empresa=c.Empresa 	and	c.TipoCodigo='(RH.Cargo)'		and	e.cargo=c.codigo
left join	Codigo cc WITH(NOLOCK)		on	e.Empresa=cc.Empresa	and	cc.TipoCodigo='(CentroCosto)'	and	e.CentroCosto=cc.codigo
left join 	Codigo ca WITH(NOLOCK) 		on	cc.Empresa=ca.Empresa 	and ca.TipoCodigo='(CentroCosto_N2)' and ca.Codigo=cc.Clasif2
left join 	Codigo ci WITH(NOLOCK)		on 	ci.Empresa=e.Empresa 	and ci.TipoCodigo='(Ciudad)' 		and ci.Codigo=e.Ciudad
left join 	Codigo co WITH(NOLOCK)		on 	co.Empresa=e.Empresa 	and co.TipoCodigo='(Comuna)' 		and co.Codigo=e.Comuna
left join 	SeccionInfo si WITH(NOLOCK) on	si.Empresa=e.Empresa 	and si.Tabla='ENTIDAD'	and si.SubTabla='FUNCIONARIO' and si.Seccion='TRATO' and si.Id=e.Entidad
left join 	Codigo fa WITH(NOLOCK)		on 	fa.Empresa=si.Empresa 	and fa.TipoCodigo='FAENAS' 		and fa.Codigo=si.Clasif6
left join	Codigo ct WITH(NOLOCK) on ct.Empresa=e.Empresa and ct.TipoCodigo='RH.TURNOS' and ct.Codigo=e.Clasif8
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	ev.Empresa='«$Empresa»' and ev.TipoDocumento='ANTICIPO ESTANDAR' and ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='anticipos' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.Empresa='«$Empresa»' and v.TipoDocumento='ANTICIPO ESTANDAR' And v.Nombre='anticipos' And v.Entidad=ev.Entidad)) af ON af.Empresa=e.Empresa and e.Entidad=af.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	ev.Empresa='«$Empresa»' and ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='ASIG.COLACIONVALOR' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.Empresa='«$Empresa»' and v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='ASIG.COLACIONVALOR' And v.Entidad=ev.Entidad)) colm ON colm.Empresa=e.Empresa and e.Entidad=colm.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	ev.Empresa='«$Empresa»' and ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='ASIG.COLACIONDIARIAV' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.Empresa='«$Empresa»' and v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='ASIG.COLACIONDIARIAV' And v.Entidad=ev.Entidad)) cold ON cold.Empresa=e.Empresa and e.Entidad=cold.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	ev.Empresa='«$Empresa»' and ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='ASIG.MOVILIZVALOR' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.Empresa='«$Empresa»' and v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='ASIG.MOVILIZVALOR' And v.Entidad=ev.Entidad) ) movm ON movm.Empresa=e.Empresa and e.Entidad=movm.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	ev.Empresa='«$Empresa»' and ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='ASIG.MOVILIZDIARIAV' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.Empresa='«$Empresa»' and v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='ASIG.MOVILIZDIARIAV' And v.Entidad=ev.Entidad)) movd ON movd.Empresa=e.Empresa and e.Entidad=movd.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	ev.Empresa='«$Empresa»' and ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='VIATICO.MONTO' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.Empresa='«$Empresa»' and v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='VIATICO.MONTO' And v.Entidad=ev.Entidad)) viatico ON viatico.Empresa=e.Empresa and e.Entidad=viatico.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	ev.Empresa='«$Empresa»' and ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='BONO.DESEMPVALOR' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.Empresa='«$Empresa»' and v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='BONO.DESEMPVALOR' And v.Entidad=ev.Entidad)) bonofijo ON bonofijo.Empresa=e.Empresa and e.Entidad=bonofijo.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	ev.Empresa='«$Empresa»' and ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='SALUD.UFPACTADO' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.Empresa='«$Empresa»' and v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='SALUD.UFPACTADO' And v.Entidad=ev.Entidad)) saluduf ON saluduf.Empresa=e.Empresa and e.Entidad=saluduf.Entidad
where		e.empresa='«$Empresa»'
AND e.TipoEntidad='funcionario'
AND ('«Vigente»' <> 'S' OR e.Vigencia = 'S')
and e.Entidad <> '(APROBACION)'
and LEN(e.Entidad)<9
and LEFT(e.Entidad,3) <> 'SFT'
ORDER BY 2 ";


?>