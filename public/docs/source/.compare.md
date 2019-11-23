---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_3f7086ce44114e85e7300612d543bd0b -->
## v1/api/test
> Example request:

```bash
curl -X GET -G "http://localhost/v1/api/test" 
```

```javascript
const url = new URL("http://localhost/v1/api/test");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET v1/api/test`


<!-- END_3f7086ce44114e85e7300612d543bd0b -->

<!-- START_8c0e48cd8efa861b308fc45872ff0837 -->
## api/v1/login
> Example request:

```bash
curl -X POST "http://localhost/api/v1/login" 
```

```javascript
const url = new URL("http://localhost/api/v1/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/login`


<!-- END_8c0e48cd8efa861b308fc45872ff0837 -->

<!-- START_7fef01e7235c89049ebe3685de4bff17 -->
## api/v1/user/register
> Example request:

```bash
curl -X POST "http://localhost/api/v1/user/register" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/register");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/user/register`


<!-- END_7fef01e7235c89049ebe3685de4bff17 -->

<!-- START_ffcf281e3b440105c3ec4baa18ba8d01 -->
## api/v1/user/reset-password
> Example request:

```bash
curl -X POST "http://localhost/api/v1/user/reset-password" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/reset-password");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/user/reset-password`


<!-- END_ffcf281e3b440105c3ec4baa18ba8d01 -->

<!-- START_3ab4d7754472397e018957fa8110ac8c -->
## api/v1/logout
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/logout" 
```

```javascript
const url = new URL("http://localhost/api/v1/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/v1/logout`


<!-- END_3ab4d7754472397e018957fa8110ac8c -->

<!-- START_50c0a334d57bffdf48ce568bad023ce0 -->
## api/test
> Example request:

```bash
curl -X POST "http://localhost/api/test" 
```

```javascript
const url = new URL("http://localhost/api/test");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/test`


<!-- END_50c0a334d57bffdf48ce568bad023ce0 -->

<!-- START_83764a2de1a941a0a3cbae52bba9776e -->
## api/companies
> Example request:

```bash
curl -X GET -G "http://localhost/api/companies" 
```

```javascript
const url = new URL("http://localhost/api/companies");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/companies`


<!-- END_83764a2de1a941a0a3cbae52bba9776e -->

<!-- START_a242a34f0abd359a9196226970606774 -->
## api/companies
> Example request:

```bash
curl -X POST "http://localhost/api/companies" 
```

```javascript
const url = new URL("http://localhost/api/companies");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/companies`


<!-- END_a242a34f0abd359a9196226970606774 -->

<!-- START_b4015228dd0e0c0b6a959ebaf0865a05 -->
## api/companies/{company}
> Example request:

```bash
curl -X GET -G "http://localhost/api/companies/1" 
```

```javascript
const url = new URL("http://localhost/api/companies/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/companies/{company}`


<!-- END_b4015228dd0e0c0b6a959ebaf0865a05 -->

<!-- START_1e6a34851b0689db52677b43727419b5 -->
## api/companies/{company}
> Example request:

```bash
curl -X PUT "http://localhost/api/companies/1" 
```

```javascript
const url = new URL("http://localhost/api/companies/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/companies/{company}`

`PATCH api/companies/{company}`


<!-- END_1e6a34851b0689db52677b43727419b5 -->

<!-- START_72de66eabebc78e1d0e514081409da3a -->
## api/companies/{company}
> Example request:

```bash
curl -X DELETE "http://localhost/api/companies/1" 
```

```javascript
const url = new URL("http://localhost/api/companies/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/companies/{company}`


<!-- END_72de66eabebc78e1d0e514081409da3a -->

<!-- START_543b0b80e8dc51d2d3ad7e2a327eed26 -->
## api/contacts
> Example request:

```bash
curl -X GET -G "http://localhost/api/contacts" 
```

```javascript
const url = new URL("http://localhost/api/contacts");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/contacts`


<!-- END_543b0b80e8dc51d2d3ad7e2a327eed26 -->

<!-- START_e1625404aaf762aa591c10b259222b07 -->
## api/contacts
> Example request:

```bash
curl -X POST "http://localhost/api/contacts" 
```

```javascript
const url = new URL("http://localhost/api/contacts");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/contacts`


<!-- END_e1625404aaf762aa591c10b259222b07 -->

<!-- START_a44483465b9aa8cdb47a73e922b4dd91 -->
## api/contacts/{contact}
> Example request:

```bash
curl -X GET -G "http://localhost/api/contacts/1" 
```

```javascript
const url = new URL("http://localhost/api/contacts/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/contacts/{contact}`


<!-- END_a44483465b9aa8cdb47a73e922b4dd91 -->

<!-- START_6855fa612757e2be32b2250d88260a29 -->
## api/contacts/{contact}
> Example request:

```bash
curl -X PUT "http://localhost/api/contacts/1" 
```

```javascript
const url = new URL("http://localhost/api/contacts/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/contacts/{contact}`

`PATCH api/contacts/{contact}`


<!-- END_6855fa612757e2be32b2250d88260a29 -->

<!-- START_1143a8051a00b1611603a8cda0683f09 -->
## api/contacts/{contact}
> Example request:

```bash
curl -X DELETE "http://localhost/api/contacts/1" 
```

```javascript
const url = new URL("http://localhost/api/contacts/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/contacts/{contact}`


<!-- END_1143a8051a00b1611603a8cda0683f09 -->

<!-- START_6b7b271c81ccb5d86a477317b4c7c08d -->
## api/serviceCategories
> Example request:

```bash
curl -X GET -G "http://localhost/api/serviceCategories" 
```

```javascript
const url = new URL("http://localhost/api/serviceCategories");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/serviceCategories`


<!-- END_6b7b271c81ccb5d86a477317b4c7c08d -->

<!-- START_364be510834a536907c46b209ed4dbcc -->
## api/serviceCategories
> Example request:

```bash
curl -X POST "http://localhost/api/serviceCategories" 
```

```javascript
const url = new URL("http://localhost/api/serviceCategories");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/serviceCategories`


<!-- END_364be510834a536907c46b209ed4dbcc -->

<!-- START_dc145a906da894301db6327fc185c952 -->
## api/serviceCategories/{serviceCategory}
> Example request:

```bash
curl -X GET -G "http://localhost/api/serviceCategories/1" 
```

```javascript
const url = new URL("http://localhost/api/serviceCategories/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/serviceCategories/{serviceCategory}`


<!-- END_dc145a906da894301db6327fc185c952 -->

<!-- START_896a8b3670103e2c1263be78eb2ae74e -->
## api/serviceCategories/{serviceCategory}
> Example request:

```bash
curl -X PUT "http://localhost/api/serviceCategories/1" 
```

```javascript
const url = new URL("http://localhost/api/serviceCategories/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/serviceCategories/{serviceCategory}`

`PATCH api/serviceCategories/{serviceCategory}`


<!-- END_896a8b3670103e2c1263be78eb2ae74e -->

<!-- START_88b847f41ebd20dfd7c9eac850f864ea -->
## api/serviceCategories/{serviceCategory}
> Example request:

```bash
curl -X DELETE "http://localhost/api/serviceCategories/1" 
```

```javascript
const url = new URL("http://localhost/api/serviceCategories/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/serviceCategories/{serviceCategory}`


<!-- END_88b847f41ebd20dfd7c9eac850f864ea -->

<!-- START_ea84a78219560615c4ff37e1fa296629 -->
## api/services
> Example request:

```bash
curl -X GET -G "http://localhost/api/services" 
```

```javascript
const url = new URL("http://localhost/api/services");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/services`


<!-- END_ea84a78219560615c4ff37e1fa296629 -->

<!-- START_8bfc14d193e92d543a0784b5f6d0ed5c -->
## api/services
> Example request:

```bash
curl -X POST "http://localhost/api/services" 
```

```javascript
const url = new URL("http://localhost/api/services");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/services`


<!-- END_8bfc14d193e92d543a0784b5f6d0ed5c -->

<!-- START_801a92ef65179289ff8517eda2335be7 -->
## api/services/{service}
> Example request:

```bash
curl -X GET -G "http://localhost/api/services/1" 
```

```javascript
const url = new URL("http://localhost/api/services/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/services/{service}`


<!-- END_801a92ef65179289ff8517eda2335be7 -->

<!-- START_9ec03a54d47a6c8a5548081841160aed -->
## api/services/{service}
> Example request:

```bash
curl -X PUT "http://localhost/api/services/1" 
```

```javascript
const url = new URL("http://localhost/api/services/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/services/{service}`

`PATCH api/services/{service}`


<!-- END_9ec03a54d47a6c8a5548081841160aed -->

<!-- START_54d05102548371f477ac36a6e49c0924 -->
## api/services/{service}
> Example request:

```bash
curl -X DELETE "http://localhost/api/services/1" 
```

```javascript
const url = new URL("http://localhost/api/services/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/services/{service}`


<!-- END_54d05102548371f477ac36a6e49c0924 -->

<!-- START_a2fd23a894f3cd718dbc9189403cf445 -->
## api/persons
> Example request:

```bash
curl -X GET -G "http://localhost/api/persons" 
```

```javascript
const url = new URL("http://localhost/api/persons");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/persons`


<!-- END_a2fd23a894f3cd718dbc9189403cf445 -->

<!-- START_676fdd40f8a1d91a0b544b4e8be21465 -->
## api/persons
> Example request:

```bash
curl -X POST "http://localhost/api/persons" \
    -H "Content-Type: application/json" \
    -d '{"name":"ut","email":"laboriosam","mobile":"minus","password":"qui","image":"in","family":"ea","description":"ut","min_time":"laborum","score":"quia","star":"optio","type":"totam","state":"beatae"}'

```

```javascript
const url = new URL("http://localhost/api/persons");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "ut",
    "email": "laboriosam",
    "mobile": "minus",
    "password": "qui",
    "image": "in",
    "family": "ea",
    "description": "ut",
    "min_time": "laborum",
    "score": "quia",
    "star": "optio",
    "type": "totam",
    "state": "beatae"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`POST api/persons`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | [] |  required  | 
    email | [&#039;string&#039;,&#039;email&#039;,&#039;max:255&#039;,&#039;unique:users&#039;] |  required  | 
    mobile | [&#039;string&#039;,&#039;max:255&#039;,&#039;unique:users&#039;] |  required  | 
    password | [&#039;string&#039;,&#039;min:8&#039;] |  required  | 
    image | [&#039;nullable&#039;,&#039;image&#039;] |  optional  | 
    family | [] |  required  | 
    description | [] |  optional  | 
    min_time | [] |  optional  | 
    score | [] |  optional  | 
    star | [] |  optional  | 
    type | [] |  optional  | 
    state | [] |  optional  | 

<!-- END_676fdd40f8a1d91a0b544b4e8be21465 -->

<!-- START_db6467be8dfb1400641d46c034511452 -->
## api/persons/{person}
> Example request:

```bash
curl -X GET -G "http://localhost/api/persons/1" 
```

```javascript
const url = new URL("http://localhost/api/persons/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/persons/{person}`


<!-- END_db6467be8dfb1400641d46c034511452 -->

<!-- START_7a784d1207c59180bd9a377afd5ad4a8 -->
## api/persons/{person}
> Example request:

```bash
curl -X PUT "http://localhost/api/persons/1?user_id=me" \
    -H "Content-Type: application/json" \
    -d '{"title":"tempora","body":"eligendi","type":"provident","author_id":2,"thumbnail":"ea"}'

```

```javascript
const url = new URL("http://localhost/api/persons/1");

    let params = {
            "user_id": "me",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "title": "tempora",
    "body": "eligendi",
    "type": "provident",
    "author_id": 2,
    "thumbnail": "ea"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 4,
    "name": "Jessica Jones",
    "roles": [
        "admin"
    ]
}
```
> Example response (404):

```json
null
```

### HTTP Request
`PUT api/persons/{person}`

`PATCH api/persons/{person}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | The title of the post.
    body | string |  required  | The content of the post.
    type | string |  optional  | The type of post to create. Defaults to 'textophonious'.
    author_id | integer |  optional  | the ID of the author.
    thumbnail | image |  optional  | This is required if the post type is 'imagelicious'.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    user_id |  required  | The id of the user.

<!-- END_7a784d1207c59180bd9a377afd5ad4a8 -->

<!-- START_9c579744ea761a5f631331530f651e83 -->
## api/persons/{person}
> Example request:

```bash
curl -X DELETE "http://localhost/api/persons/1" 
```

```javascript
const url = new URL("http://localhost/api/persons/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/persons/{person}`


<!-- END_9c579744ea761a5f631331530f651e83 -->

<!-- START_f9301c03a9281c0847565f96e6f723de -->
## api/orders
> Example request:

```bash
curl -X GET -G "http://localhost/api/orders" 
```

```javascript
const url = new URL("http://localhost/api/orders");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/orders`


<!-- END_f9301c03a9281c0847565f96e6f723de -->

<!-- START_7e6be1b9dd04564a7b1298dd260f3183 -->
## api/orders/{order}
> Example request:

```bash
curl -X GET -G "http://localhost/api/orders/1" 
```

```javascript
const url = new URL("http://localhost/api/orders/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/orders/{order}`


<!-- END_7e6be1b9dd04564a7b1298dd260f3183 -->

<!-- START_37f7b8cec13991c44b134bb2186e9d1e -->
## api/orders/{order}
> Example request:

```bash
curl -X PUT "http://localhost/api/orders/1" 
```

```javascript
const url = new URL("http://localhost/api/orders/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/orders/{order}`

`PATCH api/orders/{order}`


<!-- END_37f7b8cec13991c44b134bb2186e9d1e -->

<!-- START_c280b55cf267ef09fc12c6b09ac78ede -->
## api/orders/{order}
> Example request:

```bash
curl -X DELETE "http://localhost/api/orders/1" 
```

```javascript
const url = new URL("http://localhost/api/orders/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/orders/{order}`


<!-- END_c280b55cf267ef09fc12c6b09ac78ede -->

<!-- START_aaaea4274bd6b046b19f2ac971e26ef7 -->
## api/orders/add/step1
> Example request:

```bash
curl -X POST "http://localhost/api/orders/add/step1" 
```

```javascript
const url = new URL("http://localhost/api/orders/add/step1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/orders/add/step1`


<!-- END_aaaea4274bd6b046b19f2ac971e26ef7 -->

<!-- START_8089e9740d774cfb5122b2e10784c7bb -->
## api/orders/add/{id}
> Example request:

```bash
curl -X GET -G "http://localhost/api/orders/add/1" 
```

```javascript
const url = new URL("http://localhost/api/orders/add/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/orders/add/{id}`


<!-- END_8089e9740d774cfb5122b2e10784c7bb -->

<!-- START_806aa59e477ee8f06b478fefc1b2075a -->
## api/orders/add/{id}
> Example request:

```bash
curl -X POST "http://localhost/api/orders/add/1" 
```

```javascript
const url = new URL("http://localhost/api/orders/add/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/orders/add/{id}`


<!-- END_806aa59e477ee8f06b478fefc1b2075a -->

<!-- START_ffc0032d22601b3ccdf0d46324c48462 -->
## api/person/{person_id}/timing
> Example request:

```bash
curl -X GET -G "http://localhost/api/person/1/timing" 
```

```javascript
const url = new URL("http://localhost/api/person/1/timing");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/person/{person_id}/timing`


<!-- END_ffc0032d22601b3ccdf0d46324c48462 -->

<!-- START_15406f73ced6ac046e789076857828e9 -->
## api/person/{person_id}/timing
> Example request:

```bash
curl -X POST "http://localhost/api/person/1/timing" 
```

```javascript
const url = new URL("http://localhost/api/person/1/timing");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/person/{person_id}/timing`


<!-- END_15406f73ced6ac046e789076857828e9 -->

<!-- START_9748dc27cc317d1f19034000af92aa29 -->
## api/person/{person_id}/timing/{timing}
> Example request:

```bash
curl -X GET -G "http://localhost/api/person/1/timing/1" 
```

```javascript
const url = new URL("http://localhost/api/person/1/timing/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/person/{person_id}/timing/{timing}`


<!-- END_9748dc27cc317d1f19034000af92aa29 -->

<!-- START_8e6745a70e0137bc0897a619072a1873 -->
## api/person/{person_id}/timing/{timing}
> Example request:

```bash
curl -X PUT "http://localhost/api/person/1/timing/1" 
```

```javascript
const url = new URL("http://localhost/api/person/1/timing/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/person/{person_id}/timing/{timing}`

`PATCH api/person/{person_id}/timing/{timing}`


<!-- END_8e6745a70e0137bc0897a619072a1873 -->

<!-- START_74fe20e1ef1dc75ce1cc08c86ecc52a5 -->
## api/person/{person_id}/timing/{timing}
> Example request:

```bash
curl -X DELETE "http://localhost/api/person/1/timing/1" 
```

```javascript
const url = new URL("http://localhost/api/person/1/timing/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/person/{person_id}/timing/{timing}`


<!-- END_74fe20e1ef1dc75ce1cc08c86ecc52a5 -->

<!-- START_b43c37cc40e0b9e8a52ed6ec14b1e7f3 -->
## api/person/{person_id}/service
> Example request:

```bash
curl -X GET -G "http://localhost/api/person/1/service" 
```

```javascript
const url = new URL("http://localhost/api/person/1/service");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/person/{person_id}/service`


<!-- END_b43c37cc40e0b9e8a52ed6ec14b1e7f3 -->

<!-- START_e5874d4a2aee36d7ef36e2941114df84 -->
## api/person/{person_id}/service
> Example request:

```bash
curl -X POST "http://localhost/api/person/1/service" 
```

```javascript
const url = new URL("http://localhost/api/person/1/service");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/person/{person_id}/service`


<!-- END_e5874d4a2aee36d7ef36e2941114df84 -->

<!-- START_d039f828a1a9cda584a70bc2b61ff9c3 -->
## api/person/{person_id}/service/{service}
> Example request:

```bash
curl -X GET -G "http://localhost/api/person/1/service/1" 
```

```javascript
const url = new URL("http://localhost/api/person/1/service/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/person/{person_id}/service/{service}`


<!-- END_d039f828a1a9cda584a70bc2b61ff9c3 -->

<!-- START_c0861828ad010cd48cf2579c7e6c75d4 -->
## api/person/{person_id}/service/{service}
> Example request:

```bash
curl -X PUT "http://localhost/api/person/1/service/1" 
```

```javascript
const url = new URL("http://localhost/api/person/1/service/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/person/{person_id}/service/{service}`

`PATCH api/person/{person_id}/service/{service}`


<!-- END_c0861828ad010cd48cf2579c7e6c75d4 -->

<!-- START_72ed1b78dd22100895275cc23affb5c4 -->
## api/person/{person_id}/service/{service}
> Example request:

```bash
curl -X DELETE "http://localhost/api/person/1/service/1" 
```

```javascript
const url = new URL("http://localhost/api/person/1/service/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/person/{person_id}/service/{service}`


<!-- END_72ed1b78dd22100895275cc23affb5c4 -->

<!-- START_ac7d35d562d56fbbff0bb8f045b2c028 -->
## api/person/{person_id}/services
> Example request:

```bash
curl -X GET -G "http://localhost/api/person/1/services" 
```

```javascript
const url = new URL("http://localhost/api/person/1/services");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/person/{person_id}/services`


<!-- END_ac7d35d562d56fbbff0bb8f045b2c028 -->

<!-- START_f2a2c6f59d75dc503c25f1d56988959c -->
## api/person/{person_id}/services
> Example request:

```bash
curl -X POST "http://localhost/api/person/1/services" 
```

```javascript
const url = new URL("http://localhost/api/person/1/services");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/person/{person_id}/services`


<!-- END_f2a2c6f59d75dc503c25f1d56988959c -->

<!-- START_ab84710167eb7334d9a0c738d3045ecd -->
## api/contact/notify
> Example request:

```bash
curl -X POST "http://localhost/api/contact/notify" 
```

```javascript
const url = new URL("http://localhost/api/contact/notify");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/contact/notify`


<!-- END_ab84710167eb7334d9a0c738d3045ecd -->

<!-- START_ada5d5aec4765e54e2411f1c9c4f2d02 -->
## api/report
> Example request:

```bash
curl -X GET -G "http://localhost/api/report" 
```

```javascript
const url = new URL("http://localhost/api/report");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/report`


<!-- END_ada5d5aec4765e54e2411f1c9c4f2d02 -->

<!-- START_ed2d6b866c149c1d8857aa4a24b9debb -->
## api/UserReport
> Example request:

```bash
curl -X GET -G "http://localhost/api/UserReport" 
```

```javascript
const url = new URL("http://localhost/api/UserReport");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/UserReport`


<!-- END_ed2d6b866c149c1d8857aa4a24b9debb -->

<!-- START_8e01c64c37a27b80d8d622cf7dfcc217 -->
## api/workCalendar
> Example request:

```bash
curl -X GET -G "http://localhost/api/workCalendar" 
```

```javascript
const url = new URL("http://localhost/api/workCalendar");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": false,
    "error": "Token not provided",
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/workCalendar`


<!-- END_8e01c64c37a27b80d8d622cf7dfcc217 -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Show the application&#039;s login form.

> Example request:

```bash
curl -X GET -G "http://localhost/login" 
```

```javascript
const url = new URL("http://localhost/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Handle a login request to the application.

> Example request:

```bash
curl -X POST "http://localhost/login" 
```

```javascript
const url = new URL("http://localhost/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST "http://localhost/logout" 
```

```javascript
const url = new URL("http://localhost/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```bash
curl -X GET -G "http://localhost/register" 
```

```javascript
const url = new URL("http://localhost/register");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST "http://localhost/register" 
```

```javascript
const url = new URL("http://localhost/register");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET -G "http://localhost/password/reset" 
```

```javascript
const url = new URL("http://localhost/password/reset");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST "http://localhost/password/email" 
```

```javascript
const url = new URL("http://localhost/password/email");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET -G "http://localhost/password/reset/1" 
```

```javascript
const url = new URL("http://localhost/password/reset/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST "http://localhost/password/reset" 
```

```javascript
const url = new URL("http://localhost/password/reset");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_e40bc60a458a9740730202aaec04f818 -->
## admin
> Example request:

```bash
curl -X GET -G "http://localhost/admin" 
```

```javascript
const url = new URL("http://localhost/admin");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin`


<!-- END_e40bc60a458a9740730202aaec04f818 -->

<!-- START_0511cc0034f4feae75bd127e52b2bb79 -->
## province/{id}/cities
> Example request:

```bash
curl -X GET -G "http://localhost/province/1/cities" 
```

```javascript
const url = new URL("http://localhost/province/1/cities");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "آذرشهر"
    },
    {
        "id": 2,
        "name": "تیمورلو"
    },
    {
        "id": 3,
        "name": "گوگان"
    },
    {
        "id": 4,
        "name": "ممقان"
    },
    {
        "id": 5,
        "name": "اسکو"
    },
    {
        "id": 6,
        "name": "ایلخچی"
    },
    {
        "id": 7,
        "name": "سهند"
    },
    {
        "id": 8,
        "name": "اهر"
    },
    {
        "id": 9,
        "name": "هوراند"
    },
    {
        "id": 10,
        "name": "بستان آباد"
    },
    {
        "id": 11,
        "name": "تیکمه داش"
    },
    {
        "id": 12,
        "name": "بناب"
    },
    {
        "id": 13,
        "name": "باسمنج"
    },
    {
        "id": 14,
        "name": "تبریز"
    },
    {
        "id": 15,
        "name": "خسروشاه"
    },
    {
        "id": 16,
        "name": "سردرود"
    },
    {
        "id": 17,
        "name": "جلفا"
    },
    {
        "id": 18,
        "name": "سیه رود"
    },
    {
        "id": 19,
        "name": "هادیشهر"
    },
    {
        "id": 20,
        "name": "قره آغاج"
    },
    {
        "id": 21,
        "name": "خمارلو"
    },
    {
        "id": 22,
        "name": "دوزدوزان"
    },
    {
        "id": 23,
        "name": "سراب"
    },
    {
        "id": 24,
        "name": "شربیان"
    },
    {
        "id": 25,
        "name": "مهربان"
    },
    {
        "id": 26,
        "name": "تسوج"
    },
    {
        "id": 27,
        "name": "خامنه"
    },
    {
        "id": 28,
        "name": "سیس"
    },
    {
        "id": 29,
        "name": "شبستر"
    },
    {
        "id": 30,
        "name": "شرفخانه"
    },
    {
        "id": 31,
        "name": "شندآباد"
    },
    {
        "id": 32,
        "name": "صوفیان"
    },
    {
        "id": 33,
        "name": "کوزه کنان"
    },
    {
        "id": 34,
        "name": "وایقان"
    },
    {
        "id": 35,
        "name": "جوان قلعه"
    },
    {
        "id": 36,
        "name": "عجب شیر"
    },
    {
        "id": 37,
        "name": "آبش احمد"
    },
    {
        "id": 38,
        "name": "کلیبر"
    },
    {
        "id": 39,
        "name": "خداجو(خراجو)"
    },
    {
        "id": 40,
        "name": "مراغه"
    },
    {
        "id": 41,
        "name": "بناب مرند"
    },
    {
        "id": 42,
        "name": "زنوز"
    },
    {
        "id": 43,
        "name": "کشکسرای"
    },
    {
        "id": 44,
        "name": "مرند"
    },
    {
        "id": 45,
        "name": "یامچی"
    },
    {
        "id": 46,
        "name": "لیلان"
    },
    {
        "id": 47,
        "name": "مبارک شهر"
    },
    {
        "id": 48,
        "name": "ملکان"
    },
    {
        "id": 49,
        "name": "آقکند"
    },
    {
        "id": 50,
        "name": "اچاچی"
    },
    {
        "id": 51,
        "name": "ترک"
    },
    {
        "id": 52,
        "name": "ترکمانچای"
    },
    {
        "id": 53,
        "name": "میانه"
    },
    {
        "id": 54,
        "name": "خاروانا"
    },
    {
        "id": 55,
        "name": "ورزقان"
    },
    {
        "id": 56,
        "name": "بخشایش"
    },
    {
        "id": 57,
        "name": "خواجه"
    },
    {
        "id": 58,
        "name": "زرنق"
    },
    {
        "id": 59,
        "name": "کلوانق"
    },
    {
        "id": 60,
        "name": "هریس"
    },
    {
        "id": 61,
        "name": "نظرکهریزی"
    },
    {
        "id": 62,
        "name": "هشترود"
    }
]
```

### HTTP Request
`GET province/{id}/cities`


<!-- END_0511cc0034f4feae75bd127e52b2bb79 -->

<!-- START_63a420e6e81adab13ede0c40a60ee890 -->
## city/find
> Example request:

```bash
curl -X GET -G "http://localhost/city/find" 
```

```javascript
const url = new URL("http://localhost/city/find");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET city/find`


<!-- END_63a420e6e81adab13ede0c40a60ee890 -->

<!-- START_53be1e9e10a08458929a2e0ea70ddb86 -->
## /
> Example request:

```bash
curl -X GET -G "http://localhost/" 
```

```javascript
const url = new URL("http://localhost/");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET /`


<!-- END_53be1e9e10a08458929a2e0ea70ddb86 -->

<!-- START_c7544a4e454618c2949d2ab340d5dab3 -->
## request
> Example request:

```bash
curl -X GET -G "http://localhost/request" 
```

```javascript
const url = new URL("http://localhost/request");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET request`


<!-- END_c7544a4e454618c2949d2ab340d5dab3 -->

<!-- START_e8e6300b2f250645618de3953a49bc65 -->
## payment
> Example request:

```bash
curl -X GET -G "http://localhost/payment" 
```

```javascript
const url = new URL("http://localhost/payment");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET payment`


<!-- END_e8e6300b2f250645618de3953a49bc65 -->

<!-- START_b06168c07000228e21600761ba0f04b4 -->
## client
> Example request:

```bash
curl -X GET -G "http://localhost/client" 
```

```javascript
const url = new URL("http://localhost/client");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET client`


<!-- END_b06168c07000228e21600761ba0f04b4 -->

<!-- START_b43be2659293b26735e8e90db1f1e886 -->
## clientAdd
> Example request:

```bash
curl -X GET -G "http://localhost/clientAdd" 
```

```javascript
const url = new URL("http://localhost/clientAdd");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET clientAdd`


<!-- END_b43be2659293b26735e8e90db1f1e886 -->

<!-- START_c0df7dcf748d0f05177665d0835de51d -->
## clientSelect
> Example request:

```bash
curl -X GET -G "http://localhost/clientSelect" 
```

```javascript
const url = new URL("http://localhost/clientSelect");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET clientSelect`


<!-- END_c0df7dcf748d0f05177665d0835de51d -->

<!-- START_47f7fbb6bf98ef4cdc54b10f03cb3bdd -->
## profile
> Example request:

```bash
curl -X GET -G "http://localhost/profile" 
```

```javascript
const url = new URL("http://localhost/profile");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET profile`


<!-- END_47f7fbb6bf98ef4cdc54b10f03cb3bdd -->

<!-- START_53f9ad0e3a14e8e6936b642d6d1522af -->
## report
> Example request:

```bash
curl -X GET -G "http://localhost/report" 
```

```javascript
const url = new URL("http://localhost/report");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET report`


<!-- END_53f9ad0e3a14e8e6936b642d6d1522af -->

<!-- START_5a2c2b2a7d0664e0be3af7a1efb24ace -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/events" 
```

```javascript
const url = new URL("http://localhost/admin/events");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/events`


<!-- END_5a2c2b2a7d0664e0be3af7a1efb24ace -->

<!-- START_7e79be13fe074e86808945c845119596 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/admin/events/store" 
```

```javascript
const url = new URL("http://localhost/admin/events/store");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/events/store`


<!-- END_7e79be13fe074e86808945c845119596 -->

<!-- START_93dc4ae4c13811b6f2073ce819704c19 -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/events/1/edit" 
```

```javascript
const url = new URL("http://localhost/admin/events/1/edit");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [Modules\\EventModule\\Entities\\Event] 1"
}
```

### HTTP Request
`GET admin/events/{event}/edit`


<!-- END_93dc4ae4c13811b6f2073ce819704c19 -->

<!-- START_5dde3d56584fc1367d0486ea46aeaa35 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/admin/events/1/update" 
```

```javascript
const url = new URL("http://localhost/admin/events/1/update");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/events/{event}/update`


<!-- END_5dde3d56584fc1367d0486ea46aeaa35 -->

<!-- START_de79870bfcb557627c1fde57ad8b9770 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/events/1/delete" 
```

```javascript
const url = new URL("http://localhost/admin/events/1/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [Modules\\EventModule\\Entities\\Event] 1"
}
```

### HTTP Request
`GET admin/events/{event}/delete`


<!-- END_de79870bfcb557627c1fde57ad8b9770 -->

<!-- START_8864446c4b2a4b2962f52b6bdc4b9bfa -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/events/category" 
```

```javascript
const url = new URL("http://localhost/admin/events/category");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/events/category`


<!-- END_8864446c4b2a4b2962f52b6bdc4b9bfa -->

<!-- START_c85c57237df57e4abca4652a39f9857a -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/admin/events/category" 
```

```javascript
const url = new URL("http://localhost/admin/events/category");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/events/category`


<!-- END_c85c57237df57e4abca4652a39f9857a -->

<!-- START_7d661e393c93389346f14ea26e2b91a9 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/admin/events/category/1" 
```

```javascript
const url = new URL("http://localhost/admin/events/category/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/events/category/{id}`


<!-- END_7d661e393c93389346f14ea26e2b91a9 -->

<!-- START_ac1c76774c65f1515aa626b004f4edbc -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/events/category/1/delete" 
```

```javascript
const url = new URL("http://localhost/admin/events/category/1/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/events/category/{id}/delete`


<!-- END_ac1c76774c65f1515aa626b004f4edbc -->

<!-- START_642e378df070d6d13c22bab435d169ff -->
## Show the specified resource.

> Example request:

```bash
curl -X GET -G "http://localhost/event/1" 
```

```javascript
const url = new URL("http://localhost/event/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [Modules\\EventModule\\Entities\\Event] 1"
}
```

### HTTP Request
`GET event/{event}`


<!-- END_642e378df070d6d13c22bab435d169ff -->

<!-- START_d4e8812105d1b4f3166bde264d7ef798 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "http://localhost/event/user/registers" 
```

```javascript
const url = new URL("http://localhost/event/user/registers");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET event/user/registers`


<!-- END_d4e8812105d1b4f3166bde264d7ef798 -->

<!-- START_e718561a335d81903b666c561553878b -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET -G "http://localhost/event/1/register" 
```

```javascript
const url = new URL("http://localhost/event/1/register");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [Modules\\EventModule\\Entities\\Event] 1"
}
```

### HTTP Request
`GET event/{event}/register`


<!-- END_e718561a335d81903b666c561553878b -->

<!-- START_60d17a15a5a200e47f8ac9c2b25666c1 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/event/1/register" 
```

```javascript
const url = new URL("http://localhost/event/1/register");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST event/{event}/register`


<!-- END_60d17a15a5a200e47f8ac9c2b25666c1 -->

<!-- START_3fdb4a7aaea5aca8ef31ef3454e3f8af -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/rolePermission/role" 
```

```javascript
const url = new URL("http://localhost/admin/rolePermission/role");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/rolePermission/role`


<!-- END_3fdb4a7aaea5aca8ef31ef3454e3f8af -->

<!-- START_99cbe2ad25a68dd3a400ab6092734b61 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/admin/rolePermission/role" 
```

```javascript
const url = new URL("http://localhost/admin/rolePermission/role");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/rolePermission/role`


<!-- END_99cbe2ad25a68dd3a400ab6092734b61 -->

<!-- START_64399284d0287fc48f38c6da58c1cf20 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://localhost/admin/rolePermission/role/1" 
```

```javascript
const url = new URL("http://localhost/admin/rolePermission/role/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT admin/rolePermission/role/{role}`

`PATCH admin/rolePermission/role/{role}`


<!-- END_64399284d0287fc48f38c6da58c1cf20 -->

<!-- START_9d7d51afcefb7c00b065e461ec14724c -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost/admin/rolePermission/role/1" 
```

```javascript
const url = new URL("http://localhost/admin/rolePermission/role/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE admin/rolePermission/role/{role}`


<!-- END_9d7d51afcefb7c00b065e461ec14724c -->

<!-- START_26d842db6279dbed383e6c13a3e8562e -->
## admin/rolePermission/admin/role/find
> Example request:

```bash
curl -X GET -G "http://localhost/admin/rolePermission/admin/role/find" 
```

```javascript
const url = new URL("http://localhost/admin/rolePermission/admin/role/find");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/rolePermission/admin/role/find`


<!-- END_26d842db6279dbed383e6c13a3e8562e -->

<!-- START_f68eb9eff0255d75b4b8b1282102bd27 -->
## admin/rolePermission/users
> Example request:

```bash
curl -X GET -G "http://localhost/admin/rolePermission/users" 
```

```javascript
const url = new URL("http://localhost/admin/rolePermission/users");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/rolePermission/users`


<!-- END_f68eb9eff0255d75b4b8b1282102bd27 -->

<!-- START_28e111b546842b5c9bd541b40e9a6868 -->
## admin/rolePermission/users
> Example request:

```bash
curl -X POST "http://localhost/admin/rolePermission/users" 
```

```javascript
const url = new URL("http://localhost/admin/rolePermission/users");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/rolePermission/users`


<!-- END_28e111b546842b5c9bd541b40e9a6868 -->

<!-- START_f2aa33711e4d193d08cee7c6c1aefdb1 -->
## admin/rolePermission/user/update/{id}
> Example request:

```bash
curl -X POST "http://localhost/admin/rolePermission/user/update/1" 
```

```javascript
const url = new URL("http://localhost/admin/rolePermission/user/update/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/rolePermission/user/update/{id}`


<!-- END_f2aa33711e4d193d08cee7c6c1aefdb1 -->

<!-- START_5ff08da0e6d62b09455b6196b18e1ec1 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "http://localhost/rolepermissionmodule" 
```

```javascript
const url = new URL("http://localhost/rolepermissionmodule");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET rolepermissionmodule`


<!-- END_5ff08da0e6d62b09455b6196b18e1ec1 -->

<!-- START_8596c0940b4111dc4127c5722616754b -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/ticketing" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/ticketing`


<!-- END_8596c0940b4111dc4127c5722616754b -->

<!-- START_79011bc5d4fddea9c3f3af3a8c7ae07d -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/admin/ticketing" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/ticketing`


<!-- END_79011bc5d4fddea9c3f3af3a8c7ae07d -->

<!-- START_85503ebdfb95aac43631cfdd56047772 -->
## Show the specified resource.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/ticketing/1/show" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing/1/show");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [Modules\\TicketingModule\\Entities\\Ticket] 1"
}
```

### HTTP Request
`GET admin/ticketing/{ticket}/show`


<!-- END_85503ebdfb95aac43631cfdd56047772 -->

<!-- START_f9c46a7a716fa36b06865036a137c4ac -->
## Reply the specified resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/admin/ticketing/1/reply" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing/1/reply");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/ticketing/{ticket}/reply`


<!-- END_f9c46a7a716fa36b06865036a137c4ac -->

<!-- START_470e6a676fbc75529126725e5a6867e0 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/ticketing/1/delete" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing/1/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [Modules\\TicketingModule\\Entities\\Ticket] 1"
}
```

### HTTP Request
`GET admin/ticketing/{ticket}/delete`


<!-- END_470e6a676fbc75529126725e5a6867e0 -->

<!-- START_98dc96167391f4906026b583e800b22a -->
## admin/ticketing/find/user
> Example request:

```bash
curl -X GET -G "http://localhost/admin/ticketing/find/user" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing/find/user");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/ticketing/find/user`


<!-- END_98dc96167391f4906026b583e800b22a -->

<!-- START_94b2f058450808f11630952f6a07b9d7 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/ticketing/category" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing/category");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/ticketing/category`


<!-- END_94b2f058450808f11630952f6a07b9d7 -->

<!-- START_40c685b94d55f24c3b31b13676171432 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/admin/ticketing/category" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing/category");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/ticketing/category`


<!-- END_40c685b94d55f24c3b31b13676171432 -->

<!-- START_8215d8e027288b52e72c8ed728513592 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/admin/ticketing/category/1" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing/category/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/ticketing/category/{id}`


<!-- END_8215d8e027288b52e72c8ed728513592 -->

<!-- START_5beac9f5243b8a174f5334b6a8ebe68b -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X GET -G "http://localhost/admin/ticketing/category/1/delete" 
```

```javascript
const url = new URL("http://localhost/admin/ticketing/category/1/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": ""
}
```

### HTTP Request
`GET admin/ticketing/category/{id}/delete`


<!-- END_5beac9f5243b8a174f5334b6a8ebe68b -->

<!-- START_0dc6e37a4cde87337d2fb12146c6f2fb -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "http://localhost/ticketing" 
```

```javascript
const url = new URL("http://localhost/ticketing");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET ticketing`


<!-- END_0dc6e37a4cde87337d2fb12146c6f2fb -->

<!-- START_a84b58362c1efcdcb3637a81fffc6430 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/ticketing" 
```

```javascript
const url = new URL("http://localhost/ticketing");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST ticketing`


<!-- END_a84b58362c1efcdcb3637a81fffc6430 -->

<!-- START_72b43c216f780b98ccdc71d08dade550 -->
## Show the specified resource.

> Example request:

```bash
curl -X GET -G "http://localhost/ticketing/1/show" 
```

```javascript
const url = new URL("http://localhost/ticketing/1/show");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET ticketing/{ticket}/show`


<!-- END_72b43c216f780b98ccdc71d08dade550 -->

<!-- START_ed670d98222eff6d480e1bd7f4acac8e -->
## Reply the specified resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/ticketing/1/reply" 
```

```javascript
const url = new URL("http://localhost/ticketing/1/reply");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST ticketing/{ticket}/reply`


<!-- END_ed670d98222eff6d480e1bd7f4acac8e -->

<!-- START_0d16197663a57ae283ee33f3780035cc -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X GET -G "http://localhost/ticketing/1/delete" 
```

```javascript
const url = new URL("http://localhost/ticketing/1/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET ticketing/{ticket}/delete`


<!-- END_0d16197663a57ae283ee33f3780035cc -->

<!-- START_eb2c4b0270a7804b596ad4d79948ace8 -->
## ticketing/find/user
> Example request:

```bash
curl -X GET -G "http://localhost/ticketing/find/user" 
```

```javascript
const url = new URL("http://localhost/ticketing/find/user");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET ticketing/find/user`


<!-- END_eb2c4b0270a7804b596ad4d79948ace8 -->


