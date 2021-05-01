# Customers

## Description

API con los servicios para agregar, eliminar y mostrar customer

## Mostrar Customer

GET http://alivepages.com/customers/public/api/customers/[nip]/[email]

Muestra los datos de un customer a parir del nip o el mail

## Delete customer

DELETE http://alivepages.com/customers/public/api/customers/[nip]/[email]

Elimina los datos de un customer a parir del nip o el mail

# Agregar customer

[POST] http://alivepages.com/customers/public/api/customers

Agrega un customer a partir de todos sus datos

dni, name, email y last_name son requeridos, los valosres de dni, email, no deben existir. id_reg debe existir en la tbla regions y id_com deben exisistir en la tabla communes
