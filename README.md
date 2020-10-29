
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>  
  
# Products API   
Escolhi usar o SQLite nesse projeto para manter a simplicidade e evitar problemas não relacionados a aplicação, que é o foco do teste.  
  
Também, optei por criar as tabelas e rotas em inglês, para manter o padrão por todo o código.  
  
## Iniciando localmente 
1. Instale as dependências com `composer install`
2. Crie o arquivo `.env` com base no `.env.example`
3. Crie a database `/database/database.sqlite`
4. Rode as migrations com `php artisan migrate`  
5. Inicie o servidor local com `php artisan serve --port=8000`  
  
## Fazendo requests localmente  
Para facilitar o processo de fazer requests localmente, criei uma collection com [todas as rotas disponives](https://documenter.getpostman.com/view/13233153/TVYKYvZj), no Postman  
  
  
## Rotas  
Cria uma categoria - **POST**  `/api/categories`       
 -  Body: 
	 ```json
	 { 
	 "name": "Computers" 
	 }`
	 ```
 - Response: *201 - Object*
	 ```json
	 {
	  "name":  "Computers",
	  "updated_at":  "2020-10-29T15:54:09.000000Z",
	  "created_at":  "2020-10-29T15:54:09.000000Z",
	  "id":  1
	}
	 ```

Busca todas as categorias - **GET** `/api/categories`
 - Response:  *200 - Array*
	 ```json
	 [{
	  "name":  "Computers",
	  "updated_at":  "2020-10-29T15:54:09.000000Z",
	  "created_at":  "2020-10-29T15:54:09.000000Z",
	  "id":  1
	}]
	 ```

Busca uma categoria - **GET** `/api/categories/{id}`
- Param: `id` 
 - Response:  *200 - Object*
	 ```json
	 {
	  "name":  "Computers",
	  "updated_at":  "2020-10-29T15:54:09.000000Z",
	  "created_at":  "2020-10-29T15:54:09.000000Z",
	  "id":  1
	}
	 ```

Atualiza uma categoria - **PUT** `/api/categories/{id}`
 -  Body: 
	 ```json
	 { 
	 "name": "Laptops" 
	 }`
	 ```
 - Response:  *200 - Object*
	 ```json
	 {
	  "name":  "Laptops",
	  "updated_at":  "2020-10-29T15:54:09.000000Z",
	  "created_at":  "2020-10-29T15:54:09.000000Z",
	  "id":  1
	}
	 ```

Apaga uma categoria - **DELETE** `/api/categories/{id}`
- Param: `id` 
 - Response:  *200 - Object*
	 ```json
	 {
	  "message":  "Deleted"
	}
	 ```

---

Cria um produto - **POST**  `/api/products`       
 -  Body: 
	 ```json
	 { 
	 "name": "Computers",
	 "description":  "Gaming laptop",
	 "category_id":  2
	 }`
	 ```
 - Response: *201 - Object*
	 ```json
	 {
	  "name":  "Razer Blade",
	  "description":  "Gaming laptop",
	  "category_id":  2,
	  "updated_at":  "2020-10-29T16:09:46.000000Z",
	  "created_at":  "2020-10-29T16:09:46.000000Z",
	  "id":  1
	}
	 ```

Busca todos os produtos - **GET** `/api/products`
 - Response:  *200 - Array*
	 ```json
	 [{
	  "id":  1,
	  "name":  "Razer Blade",
	  "description":  "Gaming laptop",
	  "category_id":  "2",
	  "created_at":  "2020-10-29T16:09:46.000000Z",
	  "updated_at":  "2020-10-29T16:09:46.000000Z"
	}]
	 ```

Busca um produto - **GET** `/api/products/{id}`
- Param: `id` 
 - Response:  *200 - Object*
	 ```json
	 {
	  "id":  1,
	  "name":  "Razer Blade",
	  "description":  "Gaming laptop",
	  "category_id":  "2",
	  "created_at":  "2020-10-29T16:09:46.000000Z",
	  "updated_at":  "2020-10-29T16:09:46.000000Z"
	}
	 ```

Atualiza um produto - **PUT** `/api/products/{id}`
 -  Body: 
	 ```json
	 { 
	 "name": "Razer Blade Pro" 
	 }`
	 ```
 - Response:  *200 - Object*
	 ```json
	 {
	  "id":  1,
	  "name":  "Razer Blade Pro",
	  "description":  "Gaming laptop",
	  "category_id":  "2",
	  "created_at":  "2020-10-29T16:09:46.000000Z",
	  "updated_at":  "2020-10-29T16:14:21.000000Z"
	}
	 ```

Apaga um produto - **DELETE** `/api/products/{id}`
- Param: `id` 
 - Response:  *200 - Object*
	 ```json
	 {
	  "message":  "Deleted"
	}
	 ```

---

Cria um fornecedor - **POST**  `/api/suppliers`       
 -  Body: 
	 ```json
	 { 
	 "company_name":  "Razer Computadores Ltda",
	 "trading_name":  "Razer",
	 "cnpj": "19.670.492/0001-54",
	 "address_1":  "Av. Industrial Belgraf, 4516. Bairro Medianeira Eldorado do Sul - RS CEP 92990-000",
	 "address_2":  "",
	 "telephone_1": "(16) 91231-6165",
	 "telephone_2":  ""
	 }
	 ```
 - Response: *201 - Object*
	 ```json
	 {
	  "company_name":  "Razer Computadores Ltda",
	  "trading_name":  "Razer",
	  "cnpj":  "72.381.189/0001-20",
	  "address_1":  "Av. Industrial Belgraf, 4516. Bairro Medianeira Eldorado do Sul - RS CEP 92990-000",
	  "address_2":  null,
	  "telephone_1":  "4169411964",
	  "telephone_2":  null,
	  "updated_at":  "2020-10-29T16:17:23.000000Z",
	  "created_at":  "2020-10-29T16:17:23.000000Z",
	  "id":  1
	}
	 ```

Busca todos os fornecedores - **GET** `/api/suppliers`
 - Response:  *200 - Array*
	 ```json
	 [{
	  "company_name":  "Razer Computadores Ltda",
	  "trading_name":  "Razer",
	  "cnpj":  "72.381.189/0001-20",
	  "address_1":  "Av. Industrial Belgraf, 4516. Bairro Medianeira Eldorado do Sul - RS CEP 92990-000",
	  "address_2":  null,
	  "telephone_1":  "4169411964",
	  "telephone_2":  null,
	  "updated_at":  "2020-10-29T16:17:23.000000Z",
	  "created_at":  "2020-10-29T16:17:23.000000Z",
	  "id":  1
	}]
	 ```

Busca um fornecedor - **GET** `/api/suppliers/{id}`
- Param: `id` 
 - Response:  *200 - Object*
	 ```json
	 {
	  "company_name":  "Razer Computadores Ltda",
	  "trading_name":  "Razer",
	  "cnpj":  "72.381.189/0001-20",
	  "address_1":  "Av. Industrial Belgraf, 4516. Bairro Medianeira Eldorado do Sul - RS CEP 92990-000",
	  "address_2":  null,
	  "telephone_1":  "4169411964",
	  "telephone_2":  null,
	  "updated_at":  "2020-10-29T16:17:23.000000Z",
	  "created_at":  "2020-10-29T16:17:23.000000Z",
	  "id":  1
	}
	 ```

Atualiza um fornecedor - **PUT** `/api/suppliers/{id}`
 -  Body: 
	 ```json
	 { 
	  "trading_name":  "Razer Gaming"
	 }
	 ```
 - Response:  *200 - Object*
	 ```json
	 {
	  "company_name":  "Razer Computadores Ltda",
	  "trading_name":  "Razer Gaming",
	  "cnpj":  "72.381.189/0001-20",
	  "address_1":  "Av. Industrial Belgraf, 4516. Bairro Medianeira Eldorado do Sul - RS CEP 92990-000",
	  "address_2":  null,
	  "telephone_1":  "4169411964",
	  "telephone_2":  null,
	  "updated_at":  "2020-10-29T16:17:23.000000Z",
	  "created_at":  "2020-10-29T16:17:23.000000Z",
	  "id":  1
	}
	 ```

Apaga um fornecedor - **DELETE** `/api/suppliers/{id}`
- Param: `id` 
 - Response:  *200 - Object*
	 ```json
	 {
	  "message":  "Deleted"
	}
	 ```

---

Cria um fornecedor-produto - **POST**  `/api/suppliers-products`       
 -  Body: 
	 ```json
	 { 
	 "product_id":  2,
	 "supplier_id":  2,
	 "price":  2500
	 }
	 ```
 - Response: *201 - Object*
	 ```json
	 { 
	 "product_id":  2,
	 "supplier_id":  2,
	 "price":  2500,
	 "updated_at":  "2020-10-29T16:24:30.000000Z",
	 "created_at":  "2020-10-29T16:24:30.000000Z",
	 "id":  1
	 }
	 ```

Busca todos os fornecedores-produtos - **GET** `/api/suppliers-products`
 - Response:  *200 - Array*
	 ```json
	 [{ 
	 "product_id":  2,
	 "supplier_id":  2,
	 "price":  2500,
	 "updated_at":  "2020-10-29T16:24:30.000000Z",
	 "created_at":  "2020-10-29T16:24:30.000000Z",
	 "id":  1
	 }]
	 ```

Busca um fornecedor-produto - **GET** `/api/suppliers-products/{id}`
- Param: `id` 
 - Response:  *200 - Object*
	 ```json
	 { 
	 "product_id":  2,
	 "supplier_id":  2,
	 "price":  2500,
	 "updated_at":  "2020-10-29T16:24:30.000000Z",
	 "created_at":  "2020-10-29T16:24:30.000000Z",
	 "id":  1
	 }
	 ```

Atualiza um fornecedor-produto - **PUT** `/api/suppliers-products/{id}`
 -  Body: 
	 ```json
	 { 
	  "price": 3500
	 }`
	 ```
 - Response:  *200 - Object*
	 ```json
	 { 
	 "product_id":  2,
	 "supplier_id":  2,
	 "price":  3500,
	 "updated_at":  "2020-10-29T16:27:46.000000Z",
	 "created_at":  "2020-10-29T16:24:30.000000Z",
	 "id":  1
	 }
	 ```

Apaga um fornecedor-produto - **DELETE** `/api/suppliers-products/{id}`
- Param: `id` 
 - Response:  *200 - Object*
	 ```json
	 {
	  "message":  "Deleted"
	}
	 ```
